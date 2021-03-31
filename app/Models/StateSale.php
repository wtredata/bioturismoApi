<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'active',
    ];

    public function sales(){
        return $this->hasMany(Sale::class);
    }
}
