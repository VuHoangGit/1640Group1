<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // BÁO CHO LARAVEL BIẾT: Khóa chính của tôi là categoryId, không phải id
    protected $primaryKey = 'categoryId';

    protected $fillable = ['name'];
}
