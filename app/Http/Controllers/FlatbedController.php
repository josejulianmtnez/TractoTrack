<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Flatbed;

class FlatbedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authUser = Auth::user();
        $flatbeds = Flatbed::all();

        return view('flatbeds.index', compact('authUser', 'flatbeds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $flatbedData = $request->only('license_plate', 'brand', 'model');

        $flatbed = Flatbed::create($flatbedData);

        return redirect()->back()->with('success', 'Plataforma creada exitosamente');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $flatbed = Flatbed::find($id);

        if ($flatbed) {
            $flatbed->license_plate = $request->input('licensePlateUpdate');
            $flatbed->brand = $request->input('brandUpdate');
            $flatbed->model = $request->input('modelUpdate');

            $flatbed->save();

            return redirect()->route('flatbeds.index')->with('success', 'Plataforma actualizada correctamente.');
        }

        return redirect()->back()->with('error', 'Plataforma no encontrado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flatbed $flatbed)
    {
        try {
            $flatbed->delete();
            return redirect()->route('flatbeds.index')->with('success', 'Plataforma eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('flatbeds.index')->with('error', 'Hubo un problema al eliminar la Plataforma.');
        }
    }
}
