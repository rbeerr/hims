<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeReport;
use App\Events\NumberUpdated;
use App\Events\NumberRecalled;
use Illuminate\Support\Facades\Storage;

class EmployeeDashboardController extends Controller
{
    public function index(Request $request)
    {
        $table = $request->get('table', 1);

        // If session doesn't have the current_number, get it from the file
        if (!$request->session()->has('current_number')) {
            $currentNumberFromFile = Storage::exists('assets/queue.txt')
                ? intval(Storage::get('assets/queue.txt'))
                : 1;
            $request->session()->put('current_number', $currentNumberFromFile + 1);
        }

        return view('employee.employee-dashboard', ['table' => $table]);
    }

    // Store Type of Service
    public function storeServiceType(Request $request)
    {
        $request->validate([
            'service_type' => 'required|string'
        ]);

        // Store the service type for the current employee
        EmployeeReport::create([
            'employee_id' => auth()->id(),
            'service_type' => $request->input('service_type'),
            'table_number' => 'Table 1'
        ]);

        return redirect()->back()->with('success', 'Service type stored successfully!');
    }

    // QUEUE NUMBER for table 1
    public function getNumber(Request $request)
    {
        $currentNumber = $request->session()->get('current_number', 1);
        if ($currentNumber < 25) {
            $request->session()->put('current_number', $currentNumber + 1);
            Storage::put('assets/queue.txt', $currentNumber);  // Update the .txt file
        }
        event(new NumberUpdated($currentNumber));
        return redirect()->back();
    }


    // RESET QUEUE for table 1
    public function resetNumber(Request $request)
    {
        $request->session()->put('current_number', 1);
        $request->session()->put('initialNumber', 0);

        // Reset the number in the text file to 0
        Storage::put('assets/queue.txt', "0");

        event(new NumberUpdated(0));
        return redirect()->back();
    }

    // RECALL NUMBER for table 1
    public function recallNumber(Request $request)
    {
        $validatedData = $request->validate([
            'recalled_number' => 'required|integer|min:1|max:25'
        ]);

        $recalledNumber = $validatedData['recalled_number'];

        // If the number is above 25, set it to 25
        if ($recalledNumber > 25) {
            $recalledNumber = 25;
        }

        $request->session()->put('initialRecallNumber', $recalledNumber);

        // Write the recalled number to a text file
        Storage::put('assets/recall.txt', $recalledNumber);

        event(new NumberRecalled($recalledNumber));
        return redirect()->back();
    }

    // RESET RECALL NUMBER for table 1
    public function resetRecallNumber(Request $request)
    {
        $request->session()->put('recalled_number', 1);
        $request->session()->put('initialRecallNumber', 0);

        // Reset the recalled number in the text file to 0
        Storage::put('assets/recall.txt', "0");

        event(new NumberRecalled(0));
        return redirect()->back();
    }
}
