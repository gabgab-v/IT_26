<?php

// app/Http/Controllers/Auth/AdminSessionController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSessionController extends Controller
{
    public function store(Request $request)
    {
        // Authenticate admin
        $request->authenticate();
        $request->session()->regenerate();

        // Redirect to the admin dashboard
        return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

