<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'description',
        'service_id',
    ];

    public function Service(){
        return $this->belongsTo(Service::class);
    }
}
