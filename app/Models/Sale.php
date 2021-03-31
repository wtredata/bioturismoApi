<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date_start',
        'date_end',
        'description',
        'state_sale_id',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function stateSale(){
        return $this->belongsTo(StateSale::class);
    }

    public function services(){
        return $this->belongsToMany(Service::class);
    }
}
