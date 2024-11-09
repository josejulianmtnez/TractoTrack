<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\FuelLoad;
use App\Models\FuelPayment;
use App\Models\FuelBalance;


class FuelBalanceController extends Controller
{
    private const INITIAL_BALANCE = 16998.40;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Carbon::setLocale('es');

        $authUser = Auth::user();
        $balances = FuelBalance::all();

        return view('fuelBalances.index', compact('authUser', 'balances'));
    }
    

    public function recalculateAndUpdateBalance()
    {
        $fuelBalance = FuelBalance::first();

        $totalLoads = FuelLoad::sum('total_cost');
        $totalPayments = FuelPayment::sum('amount');

        $balance = self::INITIAL_BALANCE - $totalLoads + $totalPayments;

        $status = $balance >= 0 ? 'in_favor' : 'overdraft';

        $fuelBalance->balance = $balance;
        $fuelBalance->status = $status;
        $fuelBalance->save();

        return response()->json([
            'message' => 'Saldo actualizado exitosamente',
            'balance' => $fuelBalance->balance,
            'status' => $fuelBalance->status,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $balance = FuelBalance::find($id);

        if ($balance) {
            $balance->balance = $request->input('balanceUpdate');
                if ($balance->balance >= 0) {
                    $balance->status = 'in_favor';
                } else {
                    $balance->status = 'overdraft';
                }
            $balance->save();

            return redirect()->route('fuel-balances.index')->with('success', 'Plataforma actualizada correctamente.');
        }

            return redirect()->back()->with('error', 'El Saldo no pudo ser actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
