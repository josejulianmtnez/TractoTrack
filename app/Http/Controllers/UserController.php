<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Models\Truck;

class UserController extends Controller
{
    public function index()
    {
        $currentUserId = Auth::user()->id;
        $roles = Role::all();
        $users = User::where('id', '!=', $currentUserId)->get();
        $trucks = Truck::all();

        return view('users.index', compact('users', 'roles', 'trucks'));
    }

    public function store(Request $request)
    {
        $userData = $request->only('name', 'last_name', 'email', 'phone', 'password', 'truck_id');
        $userData['password'] = bcrypt($userData['password']);

        $user = User::create($userData);

        if ($request->hasFile('photo')) {
            $user->addMediaFromRequest('photo')->toMediaCollection('userGallery');
        }

        $user->roles()->sync($request->roles);

        return redirect()->back()->with('success', 'Usuario creado exitosamente');
    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);
        if ($user) {
            $user->name = $request->input('nameUpdate');
            $user->last_name = $request->input('lastNameUpdate');
            $user->phone = $request->input('phoneUpdate');
            $user->email = $request->input('emailUpdate');
            $user->truck_id = $request->input('truckUpdate');


            $user->save();

            $user->roles()->sync($request->input('roleUpdate'));

            if ($request->hasFile('photo')) {
                $user->clearMediaCollection('userGallery');
                $user->addMediaFromRequest('photo')->toMediaCollection('userGallery');
            }

            return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
        }

        return redirect()->back()->with('error', 'Usuario no encontrado.');
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Hubo un problema al eliminar el usuario.');
        }
    }

    public function edit($encryptedUserId)
    {
        $userId = Crypt::decrypt($encryptedUserId);
        $user = User::findOrFail($userId);
        $roles = Role::all();
        return view('users.assignRole', compact('user', 'roles'));
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::find($id);
        $newPassword = trim($request->input('updatePassword'));
        $confirmPassword = trim($request->input('passwordConfirmation'));

        if ($newPassword !== $confirmPassword) {
            return redirect()->back()->with('error', 'La nueva contraseña y la confirmación no coinciden.');
        }

        $user->password = Hash::make($newPassword);
        $user->save();

        return redirect()->route('users.index')->with('success', 'Contraseña actualizada correctamente.');

    }
}
