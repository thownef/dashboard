<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = [
        "company_id",
        "review_img",
        "is_deleted",
    ];
    public function translate()
    {
        return $this->hasMany(TReview::class, 'review_id');
    }
}
