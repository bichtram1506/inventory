<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    protected $table = 'podcasts'; // Tên của bảng trong cơ sở dữ liệu

    protected $fillable = ['file_name']; // Các trường có thể được gán giá trị tự động

}
