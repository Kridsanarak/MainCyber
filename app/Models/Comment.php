<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $fillable = [
        'comment_text',
        'comment_pic',
        'users_id',
        'posts_id',
    ];

    // ความสัมพันธ์กับผู้ใช้งาน
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // ความสัมพันธ์กับโพสต์
    public function post()
    {
        return $this->belongsTo(Posts::class, 'posts_id');
    }
}
