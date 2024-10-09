<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessERPUpdate;

class ERPController extends Controller
{
    
    public function update(Request $request)
    {
        // Validate the request data
        $request->validate([
            'data' => 'required|array',
        ]);

        // Dispatch a job to process the ERP update
        ProcessERPUpdate::dispatch($request->data);

        return response()->json(['message' => 'Data received and queued for processing.'], 200);
    }
}
