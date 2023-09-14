<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\Exam\ExamController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\Complain\ComplainController;
use App\Http\Controllers\Status\StatusController;
use App\Http\Controllers\Post\UserPostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/createpost',[UserPostController::class, 'create']);
Route::get('/get-notification',[UserPostController::class, 'getNotification']);
Route::post('/deletepost/{id}', [UserPostController::class, 'deleteNotification']);
Route::post('/addStudent',[StudentController::class, 'create']);
Route::get('/getstudent', [StudentController::class, 'getStudents']);
Route::get('/get-student/{id}', [StudentController::class, 'getStudent']);
Route::put('/updatestudent/{id}', [StudentController::class, 'updateStudent']);
Route::post('/deletestudent/{id}', [StudentController::class, 'deleteStudent']);
Route::put('/updateCOC/{id}', [StudentController::class, 'updateStudentCOC']);
Route::put('/students/{id}', [StudentController::class, 'updateStudentCOC']);
Route::put('/students/{id}', [StudentController::class, 'updateDepartment']);

Route::put('/update-department/{id}', [StudentController::class, 'updateStudentDepartment']);

Route::post('/login', [UserLoginController::class, 'authenticate']);

//user
Route::post('/addUser',[UserLoginController::class, 'create']);
Route::get('/getuser', [UserLoginController::class, 'getusers']);
Route::get('/singleuser/{id}', [UserLoginController::class, 'getUser']);
Route::put('/updateuser/{id}', [UserLoginController::class, 'updateUser']);
Route::delete('/deleteuser/{id}', [UserLoginController::class, 'deleteUser']);

// department
Route::post('/addDepartment',[DepartmentController::class, 'create']);
Route::get('/getdepartment', [DepartmentController::class, 'getDepartments']);
Route::get('/singledept/{id}', [DepartmentController::class, 'getDepartment']);
Route::put('/updatedepartment/{id}', [DepartmentController::class, 'updateDepartment']);
Route::delete('/deletedepartment/{id}', [DepartmentController::class, 'deleteDepartment']);

//exam

Route::post('/addExam',[ExamController::class, 'create']);
Route::get('/getExam', [ExamController::class, 'getExams']);
Route::get('/singleExam/{id}', [ExamController::class, 'getExam']);
Route::post('/updateExam/{id}', [ExamController::class, 'updateExam']);
Route::delete('/deleteexam/{id}', [ExamController::class, 'deleteExam']);

Route::post('/addComplain',[ComplainController::class, 'create']);
Route::get('/getcomplain', [ComplainController::class, 'getComplains']);
Route::get('/get-complain/{id}', [ComplainController::class, 'getComplain']);
Route::put('/updatecomplain/{id}', [ComplainController::class, 'updateComplainResponse']);
Route::delete('/deletestudent/{id}', [ComplainController::class, 'deleteComplain']);

Route::put('/complain/{id}', [ComplainController::class, 'updateComplainResponse']);

Route::put('/update-exam-status/{idd}',[StatusController::class, 'updateExamStatus']);
Route::post('/update-complain-status',[StatusController::class, 'updateComplainStatus']);
Route::post('/update-department-status',[StatusController::class, 'updateDepartmentStatus']);
Route::get('/getstatus', [StatusController::class, 'getStatus']);

Route::post('/upload', [ExamController::class, 'upload']);