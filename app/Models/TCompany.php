<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TCompany extends Model
{
    use HasFactory;
    protected $table = 't_companies';
    protected $fillable = [
        'company_id',
        "company_name",
        "address",
        "need",
        "description",
        "language"
    ];
}
