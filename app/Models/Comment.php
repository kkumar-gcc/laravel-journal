<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Comment extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'description',
        'blog_id',
        'user_id'
    ];
    public function id(): int
    {
        return $this->id;
    }
    public function description(): string
    {
        return $this->description;
    }
    public function excerpt(int $limit = 100): string
    {
        return Str::limit(strip_tags($this->description()), $limit);
    }
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentlikes()
    {
        return $this->hasMany(CommentLike::class);
    }
    public function isAuthUserLikedComment()
    {
        return $this->commentlikes()->where(
            [['user_id',"=",auth()->user()->id], ['status', "=", 1]]
        )->exists();
    }
    public function isAuthUserDisLikedComment()
    {
        return $this->commentlikes()->where(
            [['user_id','=',auth()->user()->id], ['status', "=", 0]]
        )->exists();
    }
}
