<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        "company_id",
        "product_img",
        "type",
        'is_deleted',
    ];
    public function translate()
    {
        return $this->hasMany(TProduct::class, 'product_id');
    }
}
