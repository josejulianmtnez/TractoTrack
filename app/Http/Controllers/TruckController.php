<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Truck;
use App\Models\Flatbed;
use App\Models\User;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authUser = Auth::user();
        $trucks = Truck::all();
        $drivers = User::role('Chofer')->get();
        $flatbeds = Flatbed::all();

        return view('trucks.index', compact('authUser', 'trucks', 'flatbeds', 'drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $truckData = $request->only('license_plate', 'flatbed_id', 'brand', 'model', 'year', 'color');

        $truck = Truck::create($truckData);

        return redirect()->back()->with('success', 'Trailer creado exitosamente');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $truck = Truck::find($id);

        if ($truck) {
            $truck->license_plate = $request->input('licensePlateUpdate');
            $truck->flatbed_id = $request->input('flatbedIdUpdate');
            $truck->brand = $request->input('brandUpdate');
            $truck->model = $request->input('modelUpdate');
            $truck->year = $request->input('yearUpdate');
            $truck->color = $request->input('colorUpdate');

            $truck->save();

            return redirect()->route('trucks.index')->with('success', 'Trailer actualizado correctamente.');
        }

        return redirect()->back()->with('error', 'Trailer no encontrado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Truck $truck)
    {
        try {
            $truck->delete();
            return redirect()->route('trucks.index')->with('success', 'Trailer eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('trucks.index')->with('error', 'Hubo un problema al eliminar el Trailer.');
        }
    }
}
