<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\FuelLoad;

class FuelLoadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Carbon::setLocale('es');

        $authUser = Auth::user();
        $fuelLoads = FuelLoad::all();

        return view('fuelLoads.index', compact('authUser', 'fuelLoads'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FuelLoad $fuelLoad)
    {
        try {
            $fuelLoad->delete();

            app(FuelBalanceController::class)->recalculateAndUpdateBalance();

            return redirect()->route('fuel-loads.index')->with('success', 'Carga de Diésel eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('fuel-loads.index')->with('error', 'Hubo un problema al eliminar la Carga.');
        }
    }
}
