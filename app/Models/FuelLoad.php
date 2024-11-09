<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Controllers\FuelBalanceController;

class FuelLoad extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'truck_id',
        'folio',
        'total_cost',
        'date',
    ];

    public function truck()
    {
        return $this->belongsTo(Truck::class, 'truck_id');
    }

    protected static function booted()
    {
        static::created(function ($fuelLoad) {
            app(FuelBalanceController::class)->recalculateAndUpdateBalance();
        });
    }
}
