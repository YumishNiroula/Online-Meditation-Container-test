<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Log;

class LogsController extends Controller
{
    public function startMeditation()
    {
        $user = auth()->user();

        $lastLog = Log::where('user_id', $user->id)->latest('created_at')->first();

        if ($lastLog) {
            $lastLog->update([
                'meditation_time' => now()->toTimeString(),
            ]);

            return response()->json(['message' => 'Meditation start time recorded successfully']);
        } else {
            return response()->json(['message' => 'No log record found for the user'], 404);
        }
    }

    public function recordStressLevels(Request $request)
    {
        $request->validate([
            'stressLevelBefore' => 'required|integer|between:0,2',
            'stressLevelAfter' => 'required|integer|between:0,2',
        ]);

        $user = auth()->user();

        $lastLog = Log::where('user_id', $user->id)->latest('created_at')->first();

        if ($lastLog) {
            $lastLog->update([
                'feelings_before' => $request->input('stressLevelBefore') == 0 ? 'No Stress' : ($request->input('stressLevelBefore') == 1 ? 'Some Stress' : 'A Lot of Stress'),
                'feelings_after' => $request->input('stressLevelAfter') == 0 ? 'No Stress' : ($request->input('stressLevelAfter') == 1 ? 'Some Stress' : 'A Lot of Stress'),
            ]);

            return response()->json(['message' => 'Stress levels recorded successfully']);
        } else {
            return response()->json(['message' => 'No log record found for the user'], 404);
        }
    }
}
