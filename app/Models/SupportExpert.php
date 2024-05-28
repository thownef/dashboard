<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportExpert extends Model
{
    use HasFactory;
    protected $table = 'support_experts';
    protected $fillable = [
        "user_id",
        "expert_img",
        "languages",
        "status",
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function translate()
    {
        return $this->hasMany(TSupportExpert::class, 'expert_id');
    }
}
