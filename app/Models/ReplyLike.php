<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyLike extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function reply(){
        return $this->belongsTo(Blog::class);
    }

    protected $fillable = [
        'reply_id',
        'user_id',
        'status'
    ];
}
