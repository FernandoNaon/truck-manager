<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'speed',
        'fuel_cons',
        'aceleration',
        'has_owner',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
        
    }
    
}
