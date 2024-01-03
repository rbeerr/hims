<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeReport;
use App\Events\NumberUpdated4;
use App\Events\NumberRecalled4;
use Illuminate\Support\Facades\Storage;

class EmployeeDashboardController4 extends Controller
{
    public function index(Request $request)
    {
        $table = $request->get('table', 4);  // Default to table 4 if not specified

        // If session doesn't have the current_number, get it from the file
        if (!$request->session()->has('current_number_4')) {
            $currentNumberFromFile = Storage::exists('assets/queue-4.txt')
                ? intval(Storage::get('assets/queue-4.txt'))
                : 1;
            $request->session()->put('current_number_4', $currentNumberFromFile + 1);
        }

        return view('employee.employee-dashboard-4', ['table' => $table]);
    }

    // Store Type of Service for Table 4
    public function storeServiceType4(Request $request)
    {
        $request->validate([
            'service_type' => 'required|string'
        ]);

        // Store the service type for the current employee
        EmployeeReport::create([
            'employee_id' => auth()->id(),
            'service_type' => $request->input('service_type'),
            'table_number' => 'Courtesy/Priority Lane'
        ]);

        return redirect()->back()->with('success', 'Service type stored successfully for Courtesy/Priority Lane!');
    }

    // QUEUE NUMBER for table 4
    public function getNumber4(Request $request)
    {
        $currentNumber4 = $request->session()->get('current_number_4', 1);
        if ($currentNumber4 < 25) {
            $request->session()->put('current_number_4', $currentNumber4 + 1);

            // Write the current number to a text file
            Storage::put('assets/queue-4.txt', $currentNumber4);
        }
        event(new NumberUpdated4($currentNumber4));
        return redirect()->back();
    }

    // RESET QUEUE for table 4
    public function resetNumber4(Request $request)
    {
        $request->session()->put('current_number_4', 1);
        $request->session()->put('initialNumber4', 0);

        // Reset the number in the text file to 0
        Storage::put('assets/queue-4.txt', "0");

        event(new NumberUpdated4(0));
        return redirect()->back();
    }

    // RECALL NUMBER for Queue 4
    public function recallNumber4(Request $request)
    {
        $validatedData = $request->validate([
            'recalled_number_4' => 'required|integer|min:1|max:25'
        ]);

        $recalledNumber4 = $validatedData['recalled_number_4'];

        // If the number is above 25, set it to 25
        if ($recalledNumber4 > 25) {
            $recalledNumber4 = 25;
        }

        $request->session()->put('initialRecallNumber4', $recalledNumber4);

        // Write the recalled number to a text file
        Storage::put('assets/recall-4.txt', $recalledNumber4);

        event(new NumberRecalled4($recalledNumber4));
        return redirect()->back();
    }

    // RESET RECALL NUMBER for Queue 4
    public function resetRecallNumber4(Request $request)
    {
        $request->session()->put('recalled_number_4', 1);
        $request->session()->put('initialRecallNumber4', 0);

        // Reset the recalled number in the text file to 0
        Storage::put('assets/recall-4.txt', "0");

        event(new NumberRecalled4(0));
        return redirect()->back();
    }
}
