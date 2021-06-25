<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateExperience extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'description',
        'active',
        'service_id'
    ];

    public function experiences(){
        return $this->belongsTo(Service::class);
    }
}
