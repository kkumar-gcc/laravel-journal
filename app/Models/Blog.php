<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Blog extends Model
{
    use HasFactory, SoftDeletes, Sluggable, HasSEO;
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'cover_image',
        'meta_description',
        'meta_title',
        "published",
        'slug'
    ];
    public function title(): string
    {
        return $this->title;
    }
    public function body()
    {
        return $this->body;
    }
    public function excerpt(int $limit = 100): string
    {
        return Str::limit(strip_tags($this->body()), $limit);
    }
    // public function slug() :string
    // {
    //     return $this->slug;
    // }
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
    public function coverImage(){
        return $this->cover_image
        ? Storage::disk('images')->url($this->cover_image)
        : 'https://live.staticflickr.com/65535/52390100407_ac668fab12_h.jpg';
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
    public function scopeFilter($query)
    {
        // if($filters['query'] ?? false){
        $query->published()->with(['user', 'tags', 'bloglikes', 'blogviews']);
        // }

    }
    // public function scopeTag(Builder $query)
    public function scopeFeatured($query): Builder
    {
        return $query->where('featured', true);
    }

    public function scopePublished($query): Builder
    {
        return $query->where('published', 1);
    }
    public function scopeUnPublished($query): Builder
    {
        return $query->where('published', 0);
    }
    // public function scopePublished($query): Builder
    // {
    //      return $query->where([['status','posted'],['access',"!=","private"]]);
    // }
    public function scopeRecentAsc($query): Builder
    {
        return $query->orderBy('title', 'asc');
    }
    public function scopeRecent($query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }
    public function scopePopular($query): Builder
    {
        return $query->withCount(['bloglikes'])->orderByDesc('bloglikes_count');
    }
    public function scopeView($query): Builder
    {
        return $query->withCount('blogviews')->orderByDesc('blogviews_count');
    }

    // public function isPinned()
    // {
    //     return $this->blogpins()->where('user_id','=', auth()->user()->id)->exists();
    // }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->title,
            description: $this->excerpt(),
            author: $this->user->username,
        );
    }
}
