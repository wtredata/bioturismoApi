<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'active',
        'price',
        'photo',
        'partner_id',
        'type_service_id',
    ];

    public function getPhotoAttribute($valor)
    {
        return url('storage/'.$valor);
    }

    public function typeService(){
        return $this->belongsTo(TypeService::class);
    }

    public function partner(){
        return $this->belongsTo(Partner::class);
    }

    public function sales(){
        return $this->belongsToMany(Sale::class);
    }

    public function rooms(){
        return $this->belongsToMany(Room::class);
    }

    public function albums(){
        return $this->hasMany(AlbumService::class);
    }

    public function comments(){
        return $this->hasMany(CommentService::class);
    }
}
