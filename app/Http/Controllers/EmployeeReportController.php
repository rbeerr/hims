<?php

namespace App\Http\Controllers;

use App\Models\EmployeeReport;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmployeeReportController extends Controller
{
    public function index()
    {
        $reports = collect();  // an empty collection for initial load
        return view('employee.employee-report', compact('reports'));
    }

    public function generateReport(Request $request)
    {
        // Validate the request first
        // $request->validate([
        //     'recordDisplayType' => 'required',
        // ], [
        //     'recordDisplayType.required' => 'Please select a record display type.',
        // ]);

        // If this is a POST request, store filters in session
        if ($request->isMethod('post')) {
            $request->session()->put('filters', $request->all());
        }

        // Retrieve filters from session if not in request
        $filters = $request->all() + $request->session()->get('filters', []);

        $table = $filters['table'] ?? null;
        $serviceType = $filters['service_type'] ?? null;
        $startDate = $filters['startDate'] ?? null;
        $endDate = $filters['endDate'] ?? null;
        $recordDisplayType = $filters['recordDisplayType'] ?? null;

        if ($startDate) {
            $startDate = Carbon::createFromFormat('Y-m-d', $startDate, 'Asia/Manila')->startOfDay();
        }

        if ($endDate) {
            $endDate = Carbon::createFromFormat('Y-m-d', $endDate, 'Asia/Manila')->endOfDay();
        }

        // Retrieve the reports based on filters (if provided) and paginate
        $query = EmployeeReport::query();
        $userId = auth()->id();  // get the ID of the currently authenticated user
        $query->where('employee_id', $userId);

        if ($table) {
            $query->where('table_number', $table);
        }

        if ($serviceType) {
            $query->where('service_type', $serviceType);
        }

        // If both dates are provided, filter the reports by date range
        if ($startDate && $endDate) {
            $query->whereBetween('operation_timestamp', [$startDate, $endDate]);
        }

        $reports = $query->paginate(5); // for instance, 10 reports per page

        // If "Total of Records (By services)" is selected, modify the query
        if ($recordDisplayType === 'total') {
            $reports = $query
                ->select('service_type', \DB::raw('count(*) as total'))
                ->groupBy('service_type')
                ->paginate(5);
        } else {
            $reports = $query->paginate(5);
        }

        return view('employee.employee-report', compact('table', 'serviceType', 'reports', 'recordDisplayType'));
    }
}
