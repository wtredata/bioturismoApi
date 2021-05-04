<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'surname',
        'enterprise',
        'phone',
        'email',
        'direction',
        'description',
        'city_id',
    ];

    public function city(){
        return $this->belongsTo(City::class);
    }
}
