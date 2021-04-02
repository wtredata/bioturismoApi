<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'photo',
        'acronym',
        'active',
        'state_id'
    ];

    public function getPhotoAttribute($valor)
    {
        return url('storage/'.$valor);
    }

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function partners(){
        return $this->hasMany(Partner::class);
    }


}
