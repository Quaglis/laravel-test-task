<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
    ];

    public static function userViewPost(int $userId, int $postId) 
    {
        $view = View::where('user_id', '=', $userId)->where('post_id', '=', $postId)->first();
        
        if (!$view)
        {
            View::create(['user_id' => $userId, 'post_id' => $postId]);
        }
    }
}
