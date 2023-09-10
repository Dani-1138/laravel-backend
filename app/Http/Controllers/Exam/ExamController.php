<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExamImport;
use App\Models\Exam;
use App\Imports\ExcelImport;
use App\Imports\UsersImport;

class ExamController extends Controller
{
    public function index()
    {

    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            // try {
            //     $file = $request->file('file');
            //     $import = new UsersImport(); // Create an instance of your import class
            //     Excel::import($import, $file); // Use the import instance
    
            //     return response()->json(['message' => 'File uploaded and data imported successfully.']);
            // } catch (Exception $e) {
            //     return response()->json($e);
            // }
            try {
                $file = $request->file('file');
    
                Excel::import(new ExamImport, $file); // Use the import class
    
                return response()->json(['message' => 'File uploaded and data imported successfully.']);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Error importing data.', 'error' => $e->getMessage()]);
            }
        } else {
            return response()->json(['message' => 'No file uploaded.']);
        }
    }

    public function getExams()
    {
        $exam = Exam::all();
        return response()->json($exam);
    }
    public function getExam($id)
    {
        $exam = Exam::findOrFail($id);
        return response()->json($exam);
    }

    public function updateExam(Request $request, $id)
    {
        $model = Exam::findOrFail($id);
        $model -> department = $request->department;
        $model -> intake = $request -> intake;
        $model -> status = $request -> status;
        
        $model->save();
        return response()->json($request);
    }

    public function deleteExam($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();
        return response()->json($exam);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'question' => 'required',
            'optionA' => 'required',
            'optionB' => 'required',
            'correct' => 'required',
            
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>'422',
                'error'=> $validator->errors()
            ]);
        }else{
            $model = new Exam();
            $model -> question = $request->question;
            $model -> optionA = $request -> optionA;
            $model -> optionB = $request -> optionB;
            $model -> optionC = $request -> optionC;
            $model -> optionD = $request -> optionD;
            $model -> optionE = $request -> optionE ?: "";
            $model -> correct = $request -> correct;
            $model -> year = $request -> year ?: date('Y');
            

            $model -> save();
            return response()->json([
                'status' => '200',
                'msg' => 'exam add successfully'
            ]);
        }
    }
}