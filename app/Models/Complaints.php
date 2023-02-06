<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    use HasFactory;

    protected $table = 'complaints';

    protected $casts = [
        'location' => 'object',
        'images' => 'array',
    ];

    protected $fillable = [
        'category_complaint_id',
        'user_id',

        'images',
        'title',
        'description',
        'status',
        'notes',
        'location',

    ];

    public function categories()
    {
        return $this->belongsTo(CategoryComplaints::class, 'category_complaint_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
