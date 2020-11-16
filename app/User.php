<?php

namespace App;

use App\Board;
use App\Post;
use App\UserProfile;
use App\UserSocial;
use Carbon\Carbon;
use Cog\Contracts\Love\Reactable\Models\Reactable as ReactableContract;
use Cog\Contracts\Love\Reacterable\Models\Reacterable as ReacterableContract;
use Cog\Laravel\Love\Reactable\Models\Traits\Reactable;
use Cog\Laravel\Love\Reacterable\Models\Traits\Reacterable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use Overtrue\LaravelFollow\Followable;
use Overtrue\LaravelSubscribe\Traits\Subscriber;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\ModelStatus\HasStatuses;

class User extends Authenticatable implements ReacterableContract, ReactableContract, MustVerifyEmail, HasMedia
{
    use HasFactory;
    use SoftDeletes,
        Notifiable,
        HasApiTokens,
        HasStatuses,
        InteractsWithMedia,
        Searchable,
        LogsActivity,
        Reacterable,
        Reactable,
        Followable,
        Subscriber;

    protected $guarded = []; // YOLO

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'username', 'first_name', 'last_name', 'email', 'password', 'locale_code', 'active', 'email_varified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'email_verified_at', 'password', 'remember_token', 'activation_token',
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // MUTATORS
    // Only accept a valid password and
    // hash a password before saving
    public function setPasswordAttribute($password)
    {
        if ($password !== null & $password !== '') {
            $hashed = Hash::make($password);
            //\Log::debug(['password' => $password, 'Hashed' => $hashed]);
            $this->attributes['password'] = $hashed;
        }
    }

    // ACCESSORS
    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'].' '.$this->attributes['last_name'];
    }

    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    /*
    public static function create(array $attributes = [])
    {
        if (array_key_exists('password', $attributes)) {
            $attributes['password'] = Hash::make($attributes['password']);
        }
        $model = static::query()->create($attributes);
        return $model;
    }
*/

    /**
     * Update the specified resource in storage.
     * @group Users
     * @param  int $id
     * @return Response
     */
    public function updateVarifyEmailAt(int $id)
    {
        $user = self::findOrFail($id);
        $datetime = Carbon::now();
        $user->email_verified_at = $datetime->toDateTimeString();
        $user->save();

        return response()->json(202);
    }

    /**
     * Gets the users that are ownabed by this user.
     * @return [collection] [description]
     */
    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function children()
    {
        return $this->hasMany(self::class);
    }

    public function logins()
    {
        return $this->hasMany(UserLogin::class);
    }

    /**
     * Gets the list of boards that are owned by this user.
     * @return [type] [description]
     */
    public function boards()
    {
        return $this->hasMany(Board::class);
    }

    /**
     * Gets the list of posts that are ownable by this user.
     * @return [type] [description]
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * [profile description].
     * @return [type] [description]
     */
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * [socials description].
     * @return [type] [description]
     */
    public function socials()
    {
        return $this->hasMany(UserSocial::class);
    }

    // Setup Algolia
    public function searchableAs()
    {
        return 'users_index';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        //$array['avatar'] = $this->profile['avatar'];

        return $array;
    }

    public function getScoutKey()
    {
        return $this->id;
    }

    public function getScoutKeyName()
    {
        return 'id';
    }

    /**
     * Check if a comment for a specific model needs to be approved.
     * @param mixed $model
     * @return bool
     */
    public function needsCommentApproval($model): bool
    {
        return false;
    }

    /**
     * [getJWTIdentifier description].
     * @return [type] [description]
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * [getJWTCustomClaims description].
     * @return [type] [description]
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    protected function setFirstNameAttribute($value)
    {
        $value = trim($value);
        $pos = strpos($value, ' ');
        $this->attributes['first_name'] = $pos ? strstr($value, ' ', true) : $value;
    }

    protected function setLastNameAttribute($value)
    {
        $value = trim($value);
        $pos = strpos($value, ' ');

        $this->attributes['last_name'] = $pos ? strstr($value, ' ', false) : $value;
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('x-small')
            ->width(config('platform.media.posts.x-small.width'))
            ->height(config('platform.media.posts.x-small.height'))
            ->quality(80)
            ->performOnCollections('image')
            ->nonQueued();

        $this->addMediaConversion('small')
            ->width(config('platform.media.posts.small.width'))
            ->height(config('platform.media.posts.small.height'))
            ->quality(80)
            ->performOnCollections('image')
            ->nonQueued();

        $this->addMediaConversion('medium')
            ->width(config('platform.media.posts.medium.width'))
            ->height(config('platform.media.posts.medium.height'))
            ->quality(80)
            ->performOnCollections('image', 'cover')
            ->nonQueued();

        $this->addMediaConversion('large')
            ->width(config('platform.media.posts.large.width'))
            ->height(config('platform.media.posts.large.height'))
            ->quality(80)
            ->performOnCollections('cover')
            ->nonQueued();

        $this->addMediaConversion('x-large')
            ->width(config('platform.media.posts.x-large.width'))
            ->height(config('platform.media.posts.x-large.height'))
            ->quality(80)
            ->performOnCollections('cover')
            ->nonQueued();
    }
}
