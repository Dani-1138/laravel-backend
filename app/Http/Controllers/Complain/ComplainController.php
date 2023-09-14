<?php

namespace App\Http\Controllers\Complain;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Complain;

class ComplainController extends Controller
{
    public function index()
    {

    }

    public function getComplains()
    {
        $complain = Complain::all();
        return response()->json($complain);
    }
    public function getComplain($id)
    {
        $complain = Complain::where('student_id', 'like', '%' . $id . '%')->get();
        
        return response()->json($complain);
    }

    public function updateComplain(Request $request, $id)
    {
        $model = Complain::where('id', $id)->first();
        $model -> student_id = $request->student_id;
        $model -> student_first_name = $request -> student_first_name;
        $model -> student_middle_name = $request -> student_middle_name;
        $model -> student_last_name = $request -> student_last_name;
        $model -> complain_type = $request -> complain_type;
        $model -> complain = $request -> complain;
        $model -> response = $request -> response;
        $model->save();
        return response()->json($request);
    }

    public function updateComplainResponse(Request $request, $id)
    {
        // Find the student by student_id
        $complain = Complain::where('id', $id)->first();
    
        if (!$complain) {
            // Return an error response if the student is not found
            return response()->json(['error' => 'Complain not found'], 404);
        }
    
        // Update the student's chosen_department
        $complain->response = $request->input('response');
        $complain->save();
    
        return response()->json(['message' => 'complain response successfully']);
    }
    

    public function deleteComplain($id)
    {
        $complain = Complain::findOrFail($id);
        $complain->delete();
        return response()->json($complain);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'student_first_name' => 'required',
            'student_middle_name' => 'required',
            'student_last_name' => 'required',
            'complain_type' => 'required',
            'complain' => 'required',
            
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>'422',
                'error'=> $validator->errors()
            ]);
        }else{
            $model = new Complain();
            $model -> student_id = $request->student_id;
            $model -> student_first_name = $request -> student_first_name;
            $model -> student_middle_name = $request -> student_middle_name;
            $model -> student_last_name = $request -> student_last_name;
            $model -> complain_type = $request -> complain_type;
            $model -> complain = $request -> complain;
            $model -> response = $request -> response;
            
            $model -> save();
            return response()->json([
                'status' => '200',
                'msg' => 'Complain Submmited successfully'
            ]);
        }
    }
}
