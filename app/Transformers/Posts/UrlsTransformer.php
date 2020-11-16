<?php

namespace App\Transformers\Posts;

use App\Helpers\CuriousPeople\CuriousStr;
use League\Fractal\TransformerAbstract;

class UrlsTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include.
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include.
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($model)
    {
        $data = [];
        foreach ($model as $item) {
            $url = CuriousStr::getUrlArray($item->url);
            $shortUrl = CuriousStr::truncateStringFromCenter($url['domainname'].@$url['filename'], config('platform.presets.grid.url_text_length'));
            $data[] = [
                //'id' => (int) $item->id,
                'url' => $item->url,
                'short_url' => $shortUrl,
                'site' => (string) $item->site ?: null,
                'title' => (string) $item->title ?: null,
                'body' => (string) $item->title ?: null,
                'image' => (string) $item->image ?: null,
                'alt' => (string) $item->alt ?: null,
                'locale' => (string) $item->locale ?: null,
                'opengraph' => $item->opengraph ?: null,
                //'created_at' => $item->created_at->toIso8601String(),
                //'updated_at' => $item->updated_at->toIso8601String(),
            ];
        }

        return $data;
    }
}
