<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Blog extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image',
        "status",
    ];
    public function id(): int
    {
        return $this->id;
    }
    public function title(): string
    {
        return $this->title;
    }
    public function body()
    {
        return $this->description;
    }
    public function excerpt(int $limit = 100): string
    {
        return Str::limit(strip_tags($this->body()), $limit);
    }

    public function createdAt(): ?Carbon
    {
        return $this->created_at;
    }
    public function isUpdated(): bool
    {
        return $this->updated_at->get($this->createdAt());
    }
    public function isLikedBy(): bool
    {
        return $this->isLikedBy(Auth::user());
    }

    public function isPinned(): bool
    {
        return (bool) $this->is_pinned;
    }
    public function readTime()
    {
        $minutes = round(str_word_count($this->body()) / 200);
        return $minutes == 0 ? 1 : $minutes;
    }
    // public function toFeedItem():FeedItem{
    //     return FeedItem::create()
    //     ->id($this->id())
    //     ->title($this->title())
    //     ->summary($this->updatedAt())
    //     ->link(route('articles.show',$this->slug()))
    //     ->authorName($this->author()->name());
    // }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tag', 'blog_id', 'tag_id');
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
    public function blogpins()
    {
        return $this->hasMany(BlogPin::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function bloglikes()
    {
        return $this->hasMany(BlogLike::class);
    }
    public function blogviews()
    {
        return $this->hasMany(BlogView::class);
    }
    public function isBookmarked()
    {
        return $this->bookmarks()->where('user_id', '=', auth()->user()->id)->exists();
    }
    public function scopeFilter($query){
        // if($filters['query'] ?? false){
            $query->where("status", "=", "posted")->with(['user','tags','bloglikes','blogviews']);
        // }

    }
    // public function isPinned()
    // {
    //     return $this->blogpins()->where('user_id','=', auth()->user()->id)->exists();
    // }
}
