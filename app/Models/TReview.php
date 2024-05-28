<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TReview extends Model
{
    use HasFactory;
    protected $table = 't_reviews';
    protected $fillable = [
        "review_id",
        "content", 
        "language", 
    ];
}
