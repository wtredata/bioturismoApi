<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'description',
        'active',
        'service_id',
    ];

    public function getPhotoAttribute($valor)
    {
        return url('storage/'.$valor);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
