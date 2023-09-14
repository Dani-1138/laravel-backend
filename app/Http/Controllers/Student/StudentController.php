<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {

    }

    public function getStudents()
    {
        $students = Student::all();
        return response()->json($students);
    }
    public function getStudent($id)
    {
        $student = Student::where('student_id', 'like', '%' . $id . '%')->get();
        
        return response()->json($student);
    }

    public function updateStudent(Request $request, $id)
    {
        $model = Student::findOrFail($id);
        $model -> student_id = $request->studentId;
        $model -> firstname = $request -> firstName;
        $model -> middleName = $request -> middleName;
        $model -> lastName = $request -> lastName;
        $model -> email = $request -> email;
        $model -> password = $request -> password;
        $model -> sex = $request -> sex;
        $model -> age = $request -> age;
        $model -> phone = $request -> phone;
        $model -> entranceResult = $request -> entranceResult;
        $model -> cgpa = $request -> cgpa;
        $model -> cocResult = $request -> cocResult;
        $model -> department = $request -> department;
        $model -> batch = $request -> batch;
        $model -> status = $request -> status;
        $model -> total_point = $request ->entranceResult + $request -> cgpa + $request -> cocResult;
        $model->save();
        return response()->json($request);
    }

    public function updateStudentCOC(Request $request, $id)
    {
        // Find the student by student_id
        $student = Student::where('student_id', $id)->first();
    
        if (!$student) {
            // Return an error response if the student is not found
            return response()->json(['error' => 'Student not found'], 404);
        }
    
        // Update the student's coc
        $student->cocResult = $request->input('result');
        $student -> total_point = $student ->entranceResult + $student -> cgpa + $request->input('result');
        $student->save();
    
        return response()->json(['message' => 'Result set successfully']);
    }

    public function updateDepartment(Request $request, $id)
    {
        // Find the student by student_id
        $student = Student::where('student_id', $id)->first();
    
        if (!$student) {
            // Return an error response if the student is not found
            return response()->json(['error' => 'Student not found'], 404);
        }
    
        // Update the student's chosen_department
        $student->choosen_department = $request->input('department');
        $student->save();
    
        return response()->json(['message' => 'Department selected successfully']);
    }

    public function updateStudentDepartment(Request $request, $id)
    {
        // Find the student by student_id
        $student = Student::where('student_id', $id)->first();
    
        if (!$student) {
            // Return an error response if the student is not found
            return response()->json(['error' => 'Student not found'], 404);
        }
    
        // Update the student's chosen_department
        $student->department = $request->input('department');
        $student->save();
    
        return response()->json(['message' => 'Department assigned successfully']);
    }
    public function deleteStudent($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return response()->json($student);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|unique:students',
            'firstName' => 'required',
            'middleName' => 'required',
            'lastName' => 'required',
            'password' => 'required',
            'sex' => 'required',
            'age'=> 'required',
            
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>'422',
                'error'=> $validator->errors()
            ]);
        }else{
            $model = new Student();
            $model -> student_id = $request->student_id;
            $model -> firstname = $request -> firstName;
            $model -> middleName = $request -> middleName;
            $model -> lastName = $request -> lastName;
            $model -> email = $request -> email;
            $model -> password = Hash::make($request -> password);
            $model -> sex = $request -> sex;
            $model -> age = $request -> age;
            $model -> phone = $request -> phone;
            $model -> entranceResult = $request -> entranceResult;
            $model -> cgpa = $request -> cgpa;
            $model -> cocResult = $request -> cocResult;
            $model -> department = "fresh";
            $model -> batch = $request -> batch;
            $model -> status = $request -> status;
            $model -> role = "student";
         
            $model -> total_point = $request ->entranceResult + $request -> cgpa + $request -> cocResult;


            $model -> save();
            return response()->json([
                'status' => '200',
                'msg' => 'Student add successfully'
            ]);
        }
    }



    // public function store(Request $request)
    // {
    //     $request->validate([
    //         // Add validation rules for each attribute here
    //     ]);

    //     Student::create($request->all());

    //     return redirect()->route('students.index')->with('success', 'Student created successfully!');
    // }

    // public function edit(Student $student)
    // {
    //     return view('students.edit', compact('student'));
    // }

    // public function update(Request $request, Student $student)
    // {
    //     $request->validate([
    //         // Add validation rules for each attribute here
    //     ]);

    //     $student->update($request->all());

    //     return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    // }

    // public function destroy(Student $student)
    // {
    //     $student->delete();

    //     return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    // }
}
