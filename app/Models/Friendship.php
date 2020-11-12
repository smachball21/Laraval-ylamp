<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'target_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id','id');
    }

    public function target()
    {
        return $this->belongsTo(User::class, 'traget_id','id');
    }
}
