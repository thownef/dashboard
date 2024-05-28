<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = 'areas';
    protected $fillable = [
        'status'
    ]; 
    public function translate()
    {
        return $this->hasMany(TArea::class, 'area_id');
    }
}
