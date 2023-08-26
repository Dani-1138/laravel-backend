<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {

    }

    public function getDepartments()
    {
        $dept = Department::all();
        return response()->json($dept);
    }
    public function getDepartment($id)
    {
        $dept = Department::findOrFail($id);
        return response()->json($dept);
    }

    public function updateDepartment(Request $request, $id)
    {
        $model = Department::findOrFail($id);
        $model -> department = $request->department;
        $model -> intake = $request -> intake;
        $model -> status = $request -> status;
        
        $model->save();
        return response()->json($request);
    }

    public function deleteDepartment($id)
    {
        $dept = Department::findOrFail($id);
        $dept->delete();
        return response()->json($dept);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'department' => 'required',
            
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>'422',
                'error'=> $validator->errors()
            ]);
        }else{
            $model = new Department();
            $model -> department = $request->department;
            $model -> intake = $request -> intake;
            $model -> status = $request -> status;
            

            $model -> save();
            return response()->json([
                'status' => '200',
                'msg' => 'depatment add successfully'
            ]);
        }
    }
}
