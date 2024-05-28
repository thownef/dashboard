<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $table = 'assignments';
    protected $fillable = [
        "company_id",
        "consultant_id",
        "is_deleted",
    ];
}
