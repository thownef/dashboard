<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TCoreMember extends Model
{
    use HasFactory;
    protected $table = 't_core_members';
    protected $fillable = [
        "core_member_id",
        "member_name",
        "member_position",
        "member_desc",
        "language"
    ];
}
