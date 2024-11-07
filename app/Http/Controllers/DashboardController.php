<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Debt;
use App\Models\Locality;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        Carbon::setLocale('es');

        $authUser = Auth::user();

        return view('dashboard', compact('authUser'));
    }
}
