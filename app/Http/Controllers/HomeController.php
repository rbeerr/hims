<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Redirect based on user type
        if (Auth::check()) {
            switch (Auth::user()->user_type) {
                case 1: // Admin
                    return redirect()->route('manage-account');
                case 2: // Employee
                    return redirect()->route('employee.table-selection');
                default:
                    return redirect('/dashboard'); // Fallback route
            }
        }

        // If not logged in, redirect to login page
        return redirect('/login');
    }
}
