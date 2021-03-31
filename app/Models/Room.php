<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'photo',
        'description',
        'active',
        'price',
        'type_room_id',
    ];

    public function typeRoom(){
        return $this->belongsTo(TypeRoom::class);
    }

    public function services(){
        return $this->belongsToMany(Service::class);
    }

    public function albums(){
        return $this->hasMany(AlbumRoom::class);
    }
}
