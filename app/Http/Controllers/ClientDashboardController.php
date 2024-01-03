<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get the values from the session or default to 0
        // Queue and Recall 1
        $initialNumber = Storage::exists('assets/queue.txt') ? Storage::get('assets/queue.txt') : 0;
        $initialRecallNumber = Storage::exists('assets/recall.txt') ? Storage::get('assets/recall.txt') : 0;

        // Get the values from the session or default to 0 for Queue 2 only
        // If the file doesn't exist, default to 0
        $initialNumber2 = Storage::exists('assets/queue-2.txt') ? Storage::get('assets/queue-2.txt') : 0;
        $initialRecallNumber2 = Storage::exists('assets/recall-2.txt') ? Storage::get('assets/recall-2.txt') : 0;

        // Get the values from the session or default to 0 for Queue 3 only
        // If the file doesn't exist, default to 0
        $initialNumber3 = Storage::exists('assets/queue-3.txt') ? Storage::get('assets/queue-3.txt') : 0;
        $initialRecallNumber3 = Storage::exists('assets/recall-3.txt') ? Storage::get('assets/recall-3.txt') : 0;

        // Get the values from the session or default to 0 for Queue 4 only
        // If the file doesn't exist, default to 0
        $initialNumber4 = Storage::exists('assets/queue-4.txt') ? Storage::get('assets/queue-4.txt') : 0;
        $initialRecallNumber4 = Storage::exists('assets/recall-4.txt') ? Storage::get('assets/recall-4.txt') : 0;

        return view('client.client-dashboard', [
            // Queue and Recall 1
            'initialNumber' => $initialNumber,
            'initialRecallNumber' => $initialRecallNumber,

            // Queue and Recall 2
            'initialNumber2' => $initialNumber2,
            'initialRecallNumber2' => $initialRecallNumber2,

            // Queue and Recall 3
            'initialNumber3' => $initialNumber3,
            'initialRecallNumber3' => $initialRecallNumber3,

            // Queue and Recall 4
            'initialNumber4' => $initialNumber4,
            'initialRecallNumber4' => $initialRecallNumber4,

        ]);
    }
}
