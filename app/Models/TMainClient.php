<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMainClient extends Model
{
    use HasFactory;
    protected $table = 't_main_clients';
    protected $fillable = [
        "company_id",
        "client_name",
        "client_url",
        "language"
    ];
}
