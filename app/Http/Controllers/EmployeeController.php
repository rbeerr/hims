<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function selectTable() {
        return view('employee.employee-table');
    }

    public function dashboard($table) {
        // This is where you can pass data to your employee-dashboard view
        return view('employee.employee-dashboard', ['table' => $table]);
    }
}
