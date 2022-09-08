<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
    protected $fillable = [
        'user_id',
        'title',
        'description',
        "number_episode",
    ];
}
