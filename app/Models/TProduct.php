<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TProduct extends Model
{
    use HasFactory;
    protected $table = 't_products';
    protected $fillable = [
        "product_id",
        "product_name",
        "product_description",
        "language",
    ];
}
