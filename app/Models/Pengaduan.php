<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengaduan extends Model
{
    use HasFactory;

    protected $casts = [
        'photo' => 'array',
    ];
    protected $fillable = [
        'photo',
        'title',
        'description',
        'category_id',
        'user_id',
        'status',
        'notes'
    ];

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
