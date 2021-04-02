<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeService extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'photo',
        'description',
        'active',
    ];

    public function getPhotoAttribute($valor)
    {
        return url('storage/'.$valor);
    }


    public function services(){
        return $this->hasMany(Service::class);
    }
}
