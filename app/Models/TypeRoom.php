<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'active',
    ];

    public function rooms(){
        return $this->hasMany(Room::class);
    }
}
