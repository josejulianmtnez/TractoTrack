<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Truck extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'flatbed_id',
        'license_plate',
        'brand',
        'model',
        'year',
        'color',
    ];

    public function flatbed()
    {
        return $this->belongsTo(Flatbed::class, 'flatbed_id');
    }
    
}
