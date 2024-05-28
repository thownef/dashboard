<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainClient extends Model
{
    use HasFactory;
    protected $table = 'main_clients';
    protected $fillable = [
        "company_id",
        "client_img",
        "is_deleted",
    ];
    public function translate()
    {
        return $this->hasMany(TMainClient::class, 'main_client_id');
    }
}
