<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'category_news_id',
        'title',
        'description',
        'is_active',
        'image',
    ];

    public function categories_news()
    {
        return $this->belongsTo(CategoryNews::class, 'category_news_id');
    }
}
