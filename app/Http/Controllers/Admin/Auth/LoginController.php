<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user(); // Get the authenticated admin
    
            // Redirect based on the admin's role
            if ($admin->role === 'warehouse') {
                return redirect()->route('admin.admin.warehouse.orders.list');
            }
    
            // Default redirection for other roles
            return redirect()->route('admin.dashboard');
        }
    
        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }
    
    
    

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}

