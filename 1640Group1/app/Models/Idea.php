<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    protected $primaryKey = 'ideaId';

    protected $fillable = [
        'userId',
        'categoryId',
        'filePath',
    ];

    // 1. Định nghĩa mối quan hệ với bảng User (Một bài đăng thuộc về một người dùng)
    public function user()
    {
        // 'userId' là khóa ngoại trong bảng ideas
        return $this->belongsTo(User::class, 'userId');
    }

    // 2. Định nghĩa mối quan hệ với bảng Category (Một bài đăng thuộc về một chuyên mục)
    public function category()
    {
        // 'categoryId' là khóa ngoại trong bảng ideas
        return $this->belongsTo(Category::class, 'categoryId');
    }
}
