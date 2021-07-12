<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'conditions',
        'active',
        'service_id',
    ];

    public function Service(){
        return $this->belongsTo(Service::class);
    }
}
