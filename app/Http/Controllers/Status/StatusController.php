<?php

namespace App\Http\Controllers\Status;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Status;

class StatusController extends Controller
{
    public function getStatus()
    {
        $status = Status::all();
        return response()->json($status);
    }
    public function updateExamStatus(Request $request, $idd)
    {
        // Find the student by student_id
        $status = Status::where('id', $idd)->first();
    
        if (!$status) {
            // Return an error response if the student is not found
            return response()->json(['error' => 'status not found'], 404);
        }
    
        // Update the student's coc
        $status->exam = $request->input('status');
        $status->save();
    
        return response()->json(['message' => 'status set successfully']);
    }
    public function updateComplainStatus(Request $request, $id)
    {
        // Find the student by student_id
        $status = Status::where('id', $id)->first();
    
        if (!$status) {
            // Return an error response if the student is not found
            return response()->json(['error' => 'status not found'], 404);
        }
    
        // Update the student's coc
        $student->cocResult = $request->input('status');
        $student->save();
    
        return response()->json(['message' => 'status set successfully']);
    }
    public function updateDepartmentStatus(Request $request, $id)
    {
        // Find the student by student_id
        $status = Status::where('id', $id)->first();
    
        if (!$status) {
            // Return an error response if the student is not found
            return response()->json(['error' => 'status not found'], 404);
        }
    
        // Update the student's coc
        $student->cocResult = $request->input('status');
        $student->save();
    
        return response()->json(['message' => 'status set successfully']);
    }
}
