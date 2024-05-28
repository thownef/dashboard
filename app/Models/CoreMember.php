<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreMember extends Model
{
    use HasFactory;
    protected $table = 'core_members';
    protected $fillable = [
        "company_id",
        "member_img",
        "is_deleted",
    ];
    public function translate()
    {
        return $this->hasMany(TCoreMember::class, 'core_member_id');
    }
}
