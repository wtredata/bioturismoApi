<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'photo',
        'description',
        'room_id',
    ];

    public function getPhotoAttribute($valor)
    {
        return url('storage/'.$valor);
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }


}
