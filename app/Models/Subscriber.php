<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    // public function follower(){
    //     return $this->belongsTo(User::class);
    // }
    protected $fillable=[
        'user_id',
        "subscriber_id",
        "status",
    ];
}
