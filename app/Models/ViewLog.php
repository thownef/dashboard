<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewLog extends Model
{
    use HasFactory;
    protected $table = 'view_logs';
    protected $fillable = [
        "company_id",
        "company_seen_id"
    ];
}
