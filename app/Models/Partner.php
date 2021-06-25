<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'logo',
        'phone',
        'direction',
        'neighbor',
        'email',
        'description',
        'available',
        'active',
        'user_id',
        'city_id',
    ];

    public function getLogoAttribute($valor)
    {
        return url('storage/'.$valor);
    }


    public function client(){
        return $this->belongsTo(User::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function services(){
        return $this->hasMany(Service::class);
    }

}
