<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'status_id'
    ];

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    public function status()
    {
        return $this->belongsTo(StatusPengaduan::class);
    }
}
