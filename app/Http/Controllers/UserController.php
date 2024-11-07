<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $currentUserId = Auth::user()->id;
        $roles = Role::all();
        $users = User::where('id', '!=', $currentUserId)->get();
        return view('users.index', compact('users', 'roles'));
    }
}
