<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TCategory extends Model
{
    use HasFactory;
    protected $table = 't_categories';
    protected $fillable = [
        'category_id',
        'name',
        "language"
    ];
}
