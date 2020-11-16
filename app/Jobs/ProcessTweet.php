<?php

namespace App\Jobs;

use App\Board;
use App\Helpers\CuriousPeople\CuriousArr;
use App\Helpers\CuriousPeople\CuriousImg;
use App\Helpers\CuriousPeople\CuriousStr;
use App\Helpers\CuriousPeople\CuriousUrl;
use App\Jobs\SendDmTweet;
use App\Jobs\SendTweet;
use App\Post;
use App\PostMedia;
use App\PostMentions;
use App\PostRemoteMedia;
use App\PostUrls;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use Lang;
use Log;
use OpenGraph;
use Spatie\Tags\Tag;
use Storage;
use Twitter;

class ProcessTweet implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $reponse;
    protected $notify;
    protected $tweet;
    protected $metadata;
    protected $listener_id;
    protected $listener_screen_name;
    protected $listener_handle;
    protected $user_social;
    protected $destroy_tweet;
    protected $platform_tags;
    protected $hash;
    protected $urls;
    protected $media;
    protected $user_mentions;
    protected $hashtags;
    protected $categories;
    protected $tags;
    protected $text;
    protected $title;
    protected $posted_at;

    /**
     * Create a new job instance.
     *
     * @param [array] $tweet [The initial tweet]
     *
     * @return void
     */
    public function __construct($tweet)
    {
        $this->response = false;
        $this->notify = [];
        $this->tweet = $tweet;
        $this->metadata = [];
        $this->listener_id = config('platform.twitter.listener_id');
        $this->listener_handle = config('platform.twitter.listener_handle');
        $this->listener_screen_name = ltrim($this->listener_handle, '@');
        $this->media = [];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::channel('json_tweet')->info(['json_tweet' => (json_encode($this->tweet))]);
        Log::channel('tweet')->info(['tweet' => ($this->tweet)]);
        $this->metadata = $this->getMetaData($this->tweet);
        Log::channel('tweet')->info(['METADATA' => $this->metadata]);

        // IS PUBLISHABLE?
        $isReply = $this->listener_screen_name == $this->tweet['in_reply_to_screen_name'] ? true : false;
        if ($isReply != true) {
            return false;
        }

        // IS CURATOR
        $this->user = $this->getUserOrFail($this->metadata['user_id'], 'twitter') ?: null;
        $this->user_social = $this->user->socials->where('service', 'twitter')->first() ?: null;
        $this->destroy_tweet = $this->user_social['destroy'] ?? false;

        // GET TWEET DATA
        $text_tweet = $this->metadata['text']['tweet'];
        $text_retweet = $this->metadata['text']['retweet'];

        // GET PLATFORM TAGS
        $platform_tags_tweet = CuriousStr::getPlatformTags($text_tweet);
        $platform_tags_retweet = CuriousStr::getPlatformTags($text_retweet);
        $this->platform_tags = CuriousArr::flattenPlatformTags($platform_tags_tweet) + CuriousArr::flattenPlatformTags($platform_tags_retweet);

        //Log::channel('test')->info(['platform_tags'=> $this->platform_tags]);
        if (! empty($this->platform_tags['test']) && $this->tweet['user']['id'] == config('platform.twitter.test_account_id')) {
            $ext = '.json';
            $filename = '';
            $filename .= ! empty($this->tweet['quoted_status_id']) ? 'retweet_' : 'tweet_';
            if ($this->platform_tags['test'] !== true) {
                $filename .= preg_replace('/\s+/', '_', $this->platform_tags['test'].'_');
            }

            //CONENT

            $filename .= ! empty($this->metadata['mentions'] && $this->metadata['mentions'][0]['id'] != config('platform.twitter.listener_id')) ? 'men_' : '';
            $filename .= ! empty($this->metadata['type']) ? $this->metadata['type'].'_' : '';
            $filename .= ! empty($this->metadata['media']) ? count($this->metadata['media']).'fls_' : '';
            $filename .= ! empty($this->metadata['hashtags']) ? count($this->metadata['hashtags']).'hsh_' : '';
            $filename .= ! empty($this->metadata['urls']) ? count($this->metadata['url']).'url_' : '';
            //TAGS
            $filename .= ! empty($this->platform_tags['b']) ? 'b' : '';
            $filename .= ! empty($this->platform_tags['c']) ? 'c' : '';
            $filename .= ! empty($this->platform_tags['t']) ? 't' : '';
            $filename .= ! empty($this->platform_tags['p']) ? 'p' : '';
            $filename .= ! empty($this->platform_tags['s']) ? 's' : '';
            $filename .= ! empty($this->platform_tags['a']) ? 'a' : '';
            $filename .= ! empty($this->platform_tags['q']) ? 'q' : '';
            $filename .= ! empty($this->platform_tags['f']) ? 'f' : '';
            $filename .= ! empty($this->platform_tags['1']) ? '1' : '';
            $filename = preg_replace('/(_)$/m', '', $filename).$ext;

            $text = CuriousStr::stripPlatformTag($this->tweet['text']);

            $this->tweet['text'] = $text;
            $contents = json_encode($this->tweet, JSON_PRETTY_PRINT);
            $path = base_path('tests/data/');
            \File::put($path.$filename, $contents);
        }
        // GET CLEAN TWEET TEXT
        $text_tweet = Str::replaceFirst($this->listener_handle, '', $text_tweet);
        $text_tweet = CuriousStr::replacePlatformTags($text_tweet);
        $text_tweet = CuriousStr::replaceUrls($text_tweet);
        $text_tweet = curiousStr::autoLinkText($text_tweet);
        $text_tweet = CuriousStr::replaceExtraSpaces($text_tweet);
        $text_tweet = CuriousStr::replaceExtraLines($text_tweet);
        $text_tweet = trim($text_tweet);
        $this->text = $text_tweet;

        // GET CLEAN RETWEET TEXT (if...)
        if (empty($text_tweet) && ! empty($text_retweet)) {
            $text_retweet = Str::replaceFirst($this->listener_handle, '', $text_retweet);
            $text_retweet = CuriousStr::replacePlatformTags($text_retweet);
            $text_retweet = CuriousStr::replaceUrls($text_retweet);
            $text_retweet = curiousStr::autoLinkText($text_retweet);
            $text_retweet = CuriousStr::replaceExtraSpaces($text_retweet);
            $text_retweet = CuriousStr::replaceExtraLines($text_retweet);
            $text_retweet = trim($text_retweet);
            $this->text = $text_retweet;
        }
        //Log::channel('dev')->info(['PLATFORM TAGS2' => $this->platform_tags, 'IN TEXT' => $this->text]);

        // CREATE TITLE FROM TEXT
        $title_length = config('platform.presets.post.title_length');
        $split_text = CuriousStr::splitTitleText($this->text, $title_length);
        Log::channel('dev')->info(['THIS TEXT' => $this->text, 'SPLIT TEXT' => $split_text]);

        $this->title = $split_text['title'] ?? '';
        $this->text = $split_text['text'] ?? '';

        // USER MENTIONS
        $this->user_mentions = Arr::pluck(
            $this->metadata['mentions'],
            'screen_name',
            'id'
        );

        // HASHTAGS
        $this->hashtags = CuriousStr::getHashtags($this->text) ?: null;
        //Log::channel('dev')->info(['PLATFORM HASHTAGS' => $this->hashtags]);

        // REMOTE MEDIA
        $this->media = $this->metadata['media'];

        // IS PUBLISHABLE - PROCESS POST
        $this->data = [
            'user_id' => $this->user['id'],
            'source_id' => $this->tweet['quoted_status']['id'] ?? null,
            'source_permalink' => $this->tweet['quoted_status_permalink']['expanded'] ?? null,
            'source_platform_id' => CuriousStr::getTextFromTag($this->tweet['source']),
            'source_user_id' => $this->tweet['quoted_status']['user']['id'] ?? null,
            'posted_at' => Carbon::parse($this->tweet['created_at'])->toDateTimeString(),
            'lang' => $this->tweet['quoted_status']['lang'] ?? $this->tweet['lang'],
            'title' => $this->title,
            'text' => $this->text,
            'type' => $this->metadata['type'] ?? null,
            'notes' => $this->platform_tags['n'] ?? null,
        ];
        //Log::channel('dev')->info(['THIS_DATA' => $this->data]);

        // CREATE POST OR POST PER URL
        $this->urls = Arr::pluck($this->metadata['urls'], 'expanded_url') ?? null;
        //Log::channel('dev')->info(['ALL URLS' => $this->urls]);

        // BAIL ON EMPTY CURIO
        Log::channel('dev')->info(['BAILABLE_TWEET' => $this->data]);
        if (empty($this->data['title']) && empty($this->data['text']) && empty($this->urls) && empty($this->media)) {
            Log::channel('dev')->info(['BAIL_TWEET' => $this->data]);
            $this->notify['status'] = Lang::get('tweets.empty');

            return $this->sendResponseTweet();
        }

        // MAKE URL DATA
        if (! empty($this->urls)) {
            foreach ($this->urls as $uri) {
                // resolve url to final destination

                $url = CuriousUrl::resolveUrl($uri) ?? null;
                $og = $this->GetOGdata($url);
                //Log::channel('dev')->info(['SOURCE URI' => $uri,'RESOLVED URL' => $url,'OG URL' => $og['url'] ?? null]);
                $og['url'] = $og['url'] ?? $url;

                // create data from tweet or url
                if (empty($this->data['title']) && empty($this->data['text'])) {
                    $this->title = $og['title'];
                    $this->text = $og['text'];
                } elseif (empty($this->data['title']) && ! empty($this->data['text'])) {
                    $this->title = $this->data['text'] ?? $og['title'];
                    $this->text = $og['text'] ?? '';
                }
                $this->data['title'] = $this->title;
                $this->data['text'] = $this->text;
                $this->data['image'] = $og['image'] ?? null;
                // HASH
                $hashData = [$uri, $this->tweet['id'], $this->data['source_id']];
                $this->data['hash'] = CuriousStr::makeChecksum($hashData);

                $this->createPost($this->data);

                $model = PostUrls::updateOrCreate(['url' => $url], $og);
                $models[] = $model->id;
            }
            if (! empty($models)) {
                $this->post->urls()->attach($models);
            }
        } else {
            $hashData = [$this->tweet['id'], $this->data['source_id']];
            $this->data['hash'] = CuriousStr::makeChecksum($hashData);
            $this->createPost($this->data);
        }

        // SEND MESSAGES
        $this->sendResponseTweet();

        return $this->response;
    }

    /**
     *  Process platform tags.
     *
     * @param [string] $social_id [the social id of the postee]
     * @param [string] $service   [the id of the service originating this post]
     *
     * @return [array] $user [the member who created this post]
     */
    public function getUserOrFail($social_id, $service)
    {
        $user = User::with('socials')->whereHas('socials', function (Builder $query) use ($social_id, $service) {
            $query->where([
            ['social_id', '=', $social_id],
            ['service', '=', $service],
            ]);
        })->first();

        if (empty($user)) {
            // send reply to invite to join
            $this->notify['status'] = Lang::get('tweets.no_member');

            return $this->sendResponseTweet();
        }

        return $user;
    }

    /**
     *  Create post.
     *
     * @return void
     */
    public function createPost()
    {
        //Log::channel('dev')->info(['CREATE_DATA' => $this->data]);
        $this->post = Post::updateOrCreate(['hash' => $this->data['hash']], $this->data);
        //Log::channel('posted')->info(['data' => $this->data, 'post' => $this->post]);

        if (! empty($this->hashtags)) {
            $this->post->syncTagsWithType($this->hashtags, 'hashtag');
        }
        if (! empty($this->platform_tags['c'])) {
            $tags = explode(',', $this->platform_tags['c']);
            $this->post->syncTagsWithType($tags, 'cat');
        }
        if (! empty($this->platform_tags['t'])) {
            $tags = explode(',', $this->platform_tags['t']);
            $this->post->syncTagsWithType($tags, 'tag');
        }

        $this->attachMentions();

        if (! empty($this->platform_tags['b'])) {
            $this->attachBoard();
        }

        //set status
        $status = $this->user_social['status'];
        if (! empty($this->platform_tags['p'])) {
            switch ($status) {
                case 'public':
                    $status = 'private';
                    break;
                case 'private':
                    $status = 'public';
                    break;
            }
        }
        $this->post->setStatus($status, 'tweet');
        $this->attachMedia();
        $this->response = $this->post;
    }

    /**
     * Attach mentions.
     *
     * @return void
     */
    public function attachMentions()
    {
        $listener_id = config('platform.twitter.listener_id');
        unset($this->user_mentions[$listener_id]);

        $arr = [];
        foreach ($this->user_mentions as $k => $v) {
            $model = PostMentions::firstOrCreate(['social_id' => $k, 'handle' => $v]);
            $arr[] = $model->id;
        }
        $this->post->mentions()->sync($arr);
    }

    /**
     * Attach mentions.
     *
     * @return void
     */
    public function attachMedia()
    {
        $models = [];
        $model_items = [];
        foreach ($this->media as $item) {
            $model = PostRemoteMedia::firstOrCreate([
                'url' => $item['url'] ?? null,
                'type' => $item['type'] ?? null,
            ], $item);
            $model_items[] = $model;
            $models[] = $model->id;
        }
        //Log::channel('dev')->info(['MEDIA_ITEMS' => $model_items]);
        $this->post->remoteMedia()->sync($models);
    }

    /**
     * Attach board.
     *
     * @return void
     */
    public function attachBoard()
    {
        // get board by exact title
        $board = Board::where(
            [
                ['user_id', '=', $this->user['id']],
                ['title', '=', $this->platform_tags['b']],
            ]
        )->first();
        // a board exists, attach post to it
        if (! empty($board)) {
            $board->posts()->attach($this->post->id);
        } else {
            $this->notify['status'] = Lang::get('tweets.no_board', ['title' => $this->platform_tags['b']]);
        }
    }

    /**
     * [GetOGdata description].
     * @param  [type] $urls [description]
     * @return [type]      [description]
    //  */
    public function GetOGdata(string $url): array
    {
        if (CuriousUrl::getHttpResponseCode($url) != 200) {
            return [];
        }
        try {
            $ogdata = OpenGraph::fetch($url, true);
        } catch (shweshi\OpenGraph\Exceptions\FetchException $e) {
            $message = $e->getMessage();
            $ogdata = $e->getData();
        }
        //Log::channel('opengraph')->info(['RAW_OG' => $ogdata]);
        $og = [
            'url' => $ogdata['url'] ?? null,
            'title' => trim($ogdata['twitter:title'] ?? ($ogdata['title'] ?? null)),
            'text' => trim($ogdata['twitter:description'] ?? ($ogdata['description'] ?? null)),
            'type' => $ogdata['type'] ?? null,
            'site' => $ogdata['site_name'] ?? null,
            'locale' => $ogdata['locale'] ?? null,
            'image' => $ogdata['twitter:image'] ?? ($ogdata['image'] ?? null),
            'alt' => $ogdata['image:alt'] ?? null,
            'opengraph' => json_encode($ogdata) ?? null,
        ];

        //Log::channel('opengraph')->info(['URL' => $url, 'OUT_DATA' => $og]);
        return $og;
    }

    /**
     * [getMediaData description].
     * @param  array  $mergedmedia [description]
     * @return [type]              [description]
     */
    public function getMediaData(array $array): array
    {
        $items = [];
        foreach ($array as $element => $item) {
            $br = 0;
            if (! empty($item)) {
                if (! empty($item['video_info']) && ! empty($item['video_info']['variants'])) {
                    foreach ($item['video_info']['variants'] as $variant) {
                        $nbr = $variant['bitrate'] ?? 0;
                        if ($nbr >= $br) {
                            $video = [
                                'type' => $item['type'] ?? null,
                                'content_type' => $variant['content_type'] ?? null,
                                'url' => $variant['url'] ?? null,
                                'image' => $item['media_url_https'] ?? null,
                                'title' => $item['additional_media_info']['title'] ?? null,
                                'description' => $item['additional_media_info']['description'] ?? null,
                            ];
                        }
                    }
                    $items[] = $video;
                } else {
                    $fileExists = CuriousUrl::checkRemoteFile($item['media_url_https']);
                    if (! $fileExists) {
                        Log::channel('media')->info(['broken image' => $item['media_url_https'], 'Response Code' => $fileExists]);
                        continue;
                    }

                    $img = CuriousImg::makeImgGrid($item['media_url_https']);
                    $gridImageFile = $img[1];
                    $brightness = CuriousImg::getImgPixelBrightnessRow($img[0]);
                    $color = CuriousImg::getAverageColor($img[0]);

                    $items[] = [
                        'url' => $item['media_url_https'] ?? null,
                        'image' => $item['media_url_https'] ?? null,
                        'type' => $item['type'] ?? null,
                        'content_type' => 'photo',
                        'alt' => $item['description'] ?? null,
                        'grid_image' => $gridImageFile ?? null,
                        'brightness' => $brightness ?? null,
                        'color' => $color ?? null,
                    ];
                }
            }
        }

        return $items;
    }

    /**
     * [getMetaData description].
     * @param  [type] $tweet [description]
     * @return [type]        [description]
     */
    public function getMetaData($tweet)
    {
        //ENTITIES
        $entities1 = $tweet['entities'] ?? [];
        $entities2 = $tweet['extended_entities'] ?? [];
        $entities3 = $tweet['extended_tweet']['entities'] ?? [];
        $entities4 = $tweet['extended_tweet']['extended_entities'] ?? [];
        $entities5 = $tweet['quoted_status']['entities'] ?? [];
        $entities6 = $tweet['quoted_status']['extended_entities'] ?? [];
        $entities7 = $tweet['quoted_status']['extended_tweet']['entities'] ?? [];
        $entities8 = $tweet['quoted_status']['extended_tweet']['extended_entities'] ?? [];
        //MEDIA
        $media1 = $entities2['media'] ?? ($entities1['media'] ?? []);
        $media2 = $entities4['media'] ?? ($entities3['media'] ?? []);
        $media3 = $entities6['media'] ?? ($entities5['media'] ?? []);
        $media4 = $entities8['media'] ?? ($entities7['media'] ?? []);

        $media = array_merge_recursive(
            $media1,
            $media2,
            $media3,
            $media4
        );

        $type = Arr::flatten(
            Arr::pluck($media, 'type')
        );
        $type = ! empty($type) ? $type[0] : 'text';

        // URLS
        $url1 = $entities2['urls'] ?? ($entities1['urls'] ?? []);
        $url2 = $entities4['urls'] ?? ($entities3['urls'] ?? []);
        $url3 = $entities6['urls'] ?? ($entities5['urls'] ?? []);
        $url4 = $entities8['urls'] ?? ($entities7['urls'] ?? []);

        $urls = array_merge_recursive(
            $url1,
            $url2,
            $url3,
            $url4
        );

        // REMOVE TWEET URLs FROM URL ARRAY
        $og = [];
        foreach ($urls as $key => $url) {
            $id = strval($tweet['quoted_status']['id'] ?? $tweet['id']);
            $url = strval($url['expanded_url'] ?? '');
            if (! empty($url) && (strpos($url, $id))) {
                unset($urls[$key]);
            } else {
                $og[$url] = $this->GetOGdata($url) ?? $url;
            }
        }

        // TEXT
        $retweet_text = htmlspecialchars_decode($tweet['quoted_status']['extended_tweet']['full_text'] ?? ($tweet['quoted_status']['text'] ?? ''));
        $tweet_text = htmlspecialchars_decode($tweet['extended_tweet']['full_text'] ?? ($tweet['text'] ?? ''));
        // REMOVES SOURCE URL FROM TEXT
        $url_array = $this->urls = Arr::pluck($urls, 'url');
        $text['retweet'] = curiousStr::removeSourceUrls($retweet_text, $url_array);
        $text['tweet'] = curiousStr::removeSourceUrls($tweet_text, $url_array);

        // MENTIONS
        $mentions1 = $entities2['user_mentions'] ?? ($entities1['user_mentions'] ?? []);
        $mentions2 = $entities4['user_mentions'] ?? ($entities3['user_mentions'] ?? []);
        $mentions3 = $entities6['user_mentions'] ?? ($entities5['user_mentions'] ?? []);
        $mentions4 = $entities8['user_mentions'] ?? ($entities7['user_mentions'] ?? []);

        $mentions = array_merge_recursive(
            $mentions1,
            $mentions2,
            $mentions3,
            $mentions4
        );

        // COLLATE DATA
        $data['source_id'] = $tweet['quoted_status']['id'] ?? null;
        $data['source_permalink'] = $tweet['quoted_status_permalink']['expanded'] ?? null;
        $data['user_id'] = $tweet['user']['id'];
        $data['text'] = $text;
        $data['media'] = $this->getMediaData($media);
        $data['type'] = $type;
        $data['urls'] = $urls;
        $data['og'] = $og;
        $data['mentions'] = $mentions;
        $data['source_payload'] = json_encode($tweet);

        Log::channel('dev')->info(['DATA' => $data]);

        return $data;
    }

    /**
     * [sendResponseTweet destroy this tweet after processing].
     * @return [type] [description]
     */
    public function sendResponseTweet()
    {
        return true;
        // DELETE OR REPLY TO TWEET IF HAS STATUS
        if ($this->destroy_tweet == true) {
            // DELETE TWEET
            $delete['id'] = $this->tweet['id'];
            $delete['config'] = [
            'id' => $this->tweet['id'],
            'token' => $this->user_social->token,
            'secret' => $this->user_social->token_secret,
            ];
            dispatch(new DestroyTweet($delete))->onQueue('tweet_destroy');
        } else {
            // ADD REPLY DATA
            $this->notify['auto_populate_reply_metadata'] = true;
            $this->notify['in_reply_to_status_id'] = $this->tweet['id'];
        }

        if (! empty($this->notify['status'])) {
            $screen_name = $this->tweet['user']['screen_name'];
            $this->notify['status'] = '@'.$screen_name.' '.$this->notify['status'];
            dispatch(new SendTweet($this->notify))->onQueue('tweet_response');
        }

        if (! empty($this->notify['status'])) {
            $user_id = $this->tweet['user']['id_str'];
            $this->notify['target'] = $user_id;
            $this->notify['text'] = $this->notify['status'];
            $this->notify['target_auth'] = [
                'token' => $this->user_social->token,
                'secret' => $this->user_social->token_secret,
            ];
            dispatch(new SendDmTweet($this->notify))->onQueue('tweet_response');
        }
    }
}
