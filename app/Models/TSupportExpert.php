<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TSupportExpert extends Model
{
    use HasFactory;
    protected $table = 't_support_experts';
    protected $fillable = [
        "expert_id",
        "name",
        "specialize",
        "experience",
        "education",
        "advisory_field",
        "working_process",
        "price",
        "url_info",
        "language"
    ];
}
