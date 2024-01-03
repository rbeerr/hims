<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeReport;
use App\Events\NumberUpdated3;
use App\Events\NumberRecalled3;
use Illuminate\Support\Facades\Storage;

class EmployeeDashboardController3 extends Controller
{
    public function index(Request $request)
    {
        $table = $request->get('table', 3);  // Default to table 3 if not specified

        // If session doesn't have the current_number, get it from the file
        if (!$request->session()->has('current_number_3')) {
            $currentNumberFromFile = Storage::exists('assets/queue-3.txt')
                ? intval(Storage::get('assets/queue-3.txt'))
                : 1;
            $request->session()->put('current_number_3', $currentNumberFromFile + 1);
        }

        return view('employee.employee-dashboard-3', ['table' => $table]);
    }

    // Store Type of Service for Table 3
    public function storeServiceType3(Request $request)
    {
        $request->validate([
            'service_type' => 'required|string'
        ]);

        // Store the service type for the current employee
        EmployeeReport::create([
            'employee_id' => auth()->id(),
            'service_type' => $request->input('service_type'),
            'table_number' => 'Table 3'
        ]);

        return redirect()->back()->with('success', 'Service type stored successfully for Table 3!');
    }

    // QUEUE NUMBER for table 3
    public function getNumber3(Request $request)
    {
        $currentNumber3 = $request->session()->get('current_number_3', 1);
        if ($currentNumber3 < 25) {
            $request->session()->put('current_number_3', $currentNumber3 + 1);

            // Write the current number to a text file
            Storage::put('assets/queue-3.txt', $currentNumber3);
        }
        event(new NumberUpdated3($currentNumber3));
        return redirect()->back();
    }

    // RESET QUEUE for table 3
    public function resetNumber3(Request $request)
    {
        $request->session()->put('current_number_3', 1);
        $request->session()->put('initialNumber3', 0);

        // Reset the number in the text file to 0
        Storage::put('assets/queue-3.txt', "0");

        event(new NumberUpdated3(0));
        return redirect()->back();
    }

    // RECALL NUMBER for Queue 3
    public function recallNumber3(Request $request)
    {
        $validatedData = $request->validate([
            'recalled_number_3' => 'required|integer|min:1|max:25'
        ]);

        $recalledNumber3 = $validatedData['recalled_number_3'];

        // If the number is above 25, set it to 25
        if ($recalledNumber3 > 25) {
            $recalledNumber3 = 25;
        }

        $request->session()->put('initialRecallNumber3', $recalledNumber3);

        // Write the recalled number to a text file
        Storage::put('assets/recall-3.txt', $recalledNumber3);

        event(new NumberRecalled3($recalledNumber3));
        return redirect()->back();
    }

    // RESET RECALL NUMBER for Queue 3
    public function resetRecallNumber3(Request $request)
    {
        $request->session()->put('recalled_number_3', 1);
        $request->session()->put('initialRecallNumber3', 0);

        // Reset the recalled number in the text file to 0
        Storage::put('assets/recall-3.txt', "0");

        event(new NumberRecalled3(0));
        return redirect()->back();
    }
}
