<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryComplaints extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
}
