<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TArea extends Model
{
    use HasFactory;
    protected $table = 't_areas';
    protected $fillable = [
        'area_id',
        'name',
        "language"
    ];
}
