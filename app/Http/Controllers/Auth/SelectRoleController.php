<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SelectRoleController extends Controller
{
    /**
     * Show the role selection page
     */
    public function create()
    {
        return view('auth.select-role');
    }

    /**
     * Handle role selection and redirect to registration
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|in:cashier,manager',
        ]);

        // Store role in session for registration page
        session(['role' => $request->role]);

        return redirect()->route('register');
    }
}