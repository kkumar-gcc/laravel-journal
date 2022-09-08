<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Reply extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable=[
        'description',
        'comment_id',
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
    public function comment(){
        return $this->belongsTo(Comment::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function replylikes(){
        return $this->hasMany(ReplyLike::class);
    }

    public function isAuthUserLikedReply()
    {
        return $this->replylikes()->where(
            [['user_id',  auth()->user()->id], ['status', "=", 1]]
        )->exists();
    }
    public function isAuthUserDisLikedReply()
    {
        return $this->replylikes()->where(
            [['user_id',  auth()->user()->id], ['status', "=", 0]]
        )->exists();
    }
}
