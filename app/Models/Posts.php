<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'topic',
        'details',
        'post_pic',
        'users_id',
        'users_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_name', 'name');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'posts_id');
    }
}
