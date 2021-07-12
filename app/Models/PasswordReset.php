<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = [
        'email',
        'token',
    ];
}
