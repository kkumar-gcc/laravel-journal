<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'username',
        'name',
        'first_name',
        'last_name',
        'password',
        'about_me',
        'short_bio',
        'profile_image',
        'background_image',
        "website_url",
        'twitter_url',
        'github_url',
        'facebook_url'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function id(): int
    {
       return $this->id;
    }
    public function emailAddress(): string
    {
        return $this->email;
    }
    public function firstName(): string
    {
       return $this->first_name;
    }
    public function lastName(): string
    {
       return $this->last_name;
    }

    public function username(): string
    {
       return $this->username;
    }
    public function shortBio(): string
    {
       return $this->short_bio;
    }
    public function aboutMe()
    {
       return $this->about_me;
    }
    public function location(): string
    {
       return $this->location;
    }
    public function twitterUrl(): ?string
    {
       return $this->twitter_url;
    }
    public function isBanned(): bool
    {
        return ! is_null($this->banned_at);
    }
    public function isLoggedInUser(): bool
    {
        return $this->id() === Auth::id();
    }
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
    public function funs()
    {
        return $this->hasMany(Fun::class);
    }
    public function videos()
    {
        return $this->hasMany(Video::class);
    }
    public function podcasts()
    {
        return $this->hasMany(Podcast::class);
    }
    // public function friendships()
    // {
    //     return $this->hasMany(Friendship::class);
    // }
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
    public function pins()
    {
        return $this->hasMany(BlogPin::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    public function commentlikes()
    {
        return $this->hasMany(CommentLike::class);
    }
    public function replylikes()
    {
        return $this->hasMany(ReplyLike::class);
    }
    public function bloglikes()
    {
        return $this->hasMany(BlogLike::class);
    }

    // public function followings()
    // {
    //     return $this->belongsToMany(User::class, 'friendships', 'follower_id', 'following_id');
    // }
    // users that follow this user
    // public function followers()
    // {
    //     return $this->belongsToMany(User::class, 'friendships', 'following_id', 'follower_id');
    // }
    // public function isFollowing()
    // {
    //     return $this->followers()->where('follower_id', '=', auth()->user()->id)->exists();
    // }
    public function followings()
    {
        return $this->belongsToMany(User::class, 'subscribers', 'subscriber_id','user_id');
    }
    // users that follow this user
    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'subscribers','user_id', 'subscriber_id');
    }
    public function isSubscriber()
    {
        return $this->subscribers()->where('user_id', '=', auth()->user()->id)->exists();
    }
    public function avatarUrl():string
    {
        return 'https://www.gravatar.com/avatar/'.md5(Str::lower(trim($this->email)));
    }

}
