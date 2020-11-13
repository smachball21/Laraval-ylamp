<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function friendonlysent()
    {
        return $this->belongsTo(Friendship::class, 'user_id', 'target_id');
    }

    public function friendonlyreceived()
    {
        return $this->belongsTo(Friendship::class, 'user_id', 'target_id');
    }

}
