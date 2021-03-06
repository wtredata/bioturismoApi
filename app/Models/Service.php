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
        'recommended',
        'inclusive',
        'quota_max',
        'quota_min',
        'price',
        'time',
        'difficulty',
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

    public function experiences(){
        return $this->hasMany(Experience::class);
    }

    public function albums(){
        return $this->hasMany(AlbumService::class);
    }

    public function comments(){
        return $this->hasMany(CommentService::class);
    }

    public function typeExperiences(){
        return $this->belongsToMany(TypeExperience::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    
    public function itineraries(){
        return $this->hasMany(Itinerary::class);
    }

    public function packages(){
        return $this->hasMany(Package::class);
    }

    public function dateExperience(){
        return $this->hasMany(DateExperience::class);
    }
}
