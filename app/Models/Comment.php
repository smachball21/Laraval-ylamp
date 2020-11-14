<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment', 'post_id', 'author_id'/* 'parent_id' */
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * Return comment's post
     **/
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    /**
     * Return comment's author
     **/
    public function user()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    /* Scope query to order comments by latests
    public function latest(){
        return $this->orderBy('created_at', 'desc');
    }*/
    /* Handles many relationships between comments
    public function replies(){
        return $this->hasMany(Comment::class, 'parent_id');
    }*/
}
