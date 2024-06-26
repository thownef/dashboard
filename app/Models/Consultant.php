<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultant extends Model
{
    use HasFactory;
    protected $table = 'consultants';
    protected $fillable = [
        "user_id",
        "email_consultant",
        "status"
    ];
}
