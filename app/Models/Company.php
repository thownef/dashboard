<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $fillable = [
        'user_id',
        'category_id',
        'area_id',
        'country',
        'company_logo',
        'establishment',
        'employer',
        'capital',
        'languages',
        'referral code',
        'highlight',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function area()
    {
        return $this->hasOne(Area::class, "id", 'area_id');
    }
    public function translate()
    {
        return $this->hasMany(TCompany::class, "company_id");
    }
}

