<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeReport;
use App\Events\NumberUpdated2;
use App\Events\NumberRecalled2;
use Illuminate\Support\Facades\Storage;

class EmployeeDashboardController2 extends Controller
{
    public function index(Request $request)
    {
        $table = $request->get('table', 2);  // Default to table 2 if not specified

        // If session doesn't have the current_number, get it from the file
        if (!$request->session()->has('current_number_2')) {
            $currentNumberFromFile = Storage::exists('assets/queue-2.txt')
                ? intval(Storage::get('assets/queue-2.txt'))
                : 1;
            $request->session()->put('current_number_2', $currentNumberFromFile + 1);
        }

        return view('employee.employee-dashboard-2', ['table' => $table]);
    }

    // Store Type of Service for Table 2
    public function storeServiceType2(Request $request)
    {
        $request->validate([
            'service_type' => 'required|string'
        ]);

        // Store the service type for the current employee
        EmployeeReport::create([
            'employee_id' => auth()->id(),
            'service_type' => $request->input('service_type'),
            'table_number' => 'Table 2'
        ]);

        return redirect()->back()->with('success', 'Service type stored successfully for Table 2!');
    }

    // QUEUE NUMBER for table 2
    public function getNumber2(Request $request)
    {
        $currentNumber2 = $request->session()->get('current_number_2', 1);
        if ($currentNumber2 < 25) {
            $request->session()->put('current_number_2', $currentNumber2 + 1);

            // Write the current number to a text file
            Storage::put('assets/queue-2.txt', $currentNumber2);
        }
        event(new NumberUpdated2($currentNumber2));
        return redirect()->back();
    }

    // RESET QUEUE for table 2
    public function resetNumber2(Request $request)
    {
        $request->session()->put('current_number_2', 1);
        $request->session()->put('initialNumber2', 0);

        // Reset the number in the text file to 0
        Storage::put('assets/queue-2.txt', "0");

        event(new NumberUpdated2(0));
        return redirect()->back();
    }

    // RECALL NUMBER for Queue 2
    public function recallNumber2(Request $request)
    {
        $validatedData = $request->validate([
            'recalled_number_2' => 'required|integer|min:1|max:25'
        ]);

        $recalledNumber2 = $validatedData['recalled_number_2'];

        // If the number is above 25, set it to 25
        if ($recalledNumber2 > 25) {
            $recalledNumber2 = 25;
        }

        $request->session()->put('initialRecallNumber2', $recalledNumber2);

        // Write the recalled number to a text file
        Storage::put('assets/recall-2.txt', $recalledNumber2);

        event(new NumberRecalled2($recalledNumber2));
        return redirect()->back();
    }


    // RESET RECALL NUMBER for Queue 2
    public function resetRecallNumber2(Request $request)
    {
        $request->session()->put('recalled_number_2', 1);
        $request->session()->put('initialRecallNumber2', 0);

        // Reset the recalled number in the text file to 0
        Storage::put('assets/recall-2.txt', "0");

        event(new NumberRecalled2(0));
        return redirect()->back();
    }
}
