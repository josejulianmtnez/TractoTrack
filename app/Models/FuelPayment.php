<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Controllers\FuelBalanceController;

class FuelPayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'amount',
        'payment_method',
        'reference',
        'date',
    ];

    protected static function booted()
    {
        static::created(function ($fuelPayment) {
            app(FuelBalanceController::class)->recalculateAndUpdateBalance();
        });
    }
}
