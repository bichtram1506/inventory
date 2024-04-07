<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name']; // Các trường có thể điền tự động

    // Các phương thức hoặc quan hệ khác có thể được thêm vào đây
}
