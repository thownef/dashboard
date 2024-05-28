<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestConnection extends Model
{
    use HasFactory;
    protected $table = 'request_connections';
    protected $fillable = [
        "from_id",
        "to_id",
        "fullname",
        "position",
        "phone",
        "content",
        "relation",
        "status"
    ];
}
