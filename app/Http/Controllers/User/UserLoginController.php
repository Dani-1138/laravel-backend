<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\People;
use Illuminate\Support\Facades\Hash;

class UserLoginController extends Controller
{
    public function index()
    {

    }

    public function getUsers()
    {
        $users = People::all();
        return response()->json($users);
    }

    public function authenticate(Request $request)
{
    // Retrieve user by email
    $user = People::where('user_id', $request->input('user_id'))->first();

    // Check if the user exists and the password matches
    if ($user && Hash::check($request->input('password'), $user->password)) {
        return response()->json($user);

    } else {
        return null;
    }
}

//     public function getUsers()
// {
//     $users = People::select('user_id', 'firstName', 'middleName', 'lastName', 'role')->get();

//     // Add the unhashed password to each user (for demonstration purposes only)
//     foreach ($users as $user) {
//         $user->password = $user->getOriginal('password');
//     }

//     return response()->json($users);
// }

    public function getUser($id)
    {
        $user = People::where('user_id', 'like', '%' . $id . '%')->get();
        
        return response()->json($user);
    }

    public function updateUser(Request $request, $id)
    {
        $model = People::where('user_id', $id)->first();
        // $model -> user_id = $request->user_id;
        // $model -> firstname = $request -> firstName;
        // $model -> middleName = $request -> middleName;
        // $model -> lastName = $request -> lastName;
        // $model -> email = $request -> email;
        $model -> password = Hash::make($request -> password);
        // $model -> role = $request -> role;

        $model->save();
        return response()->json($request);
    }

    public function deleteUser($id)
    {
        $user = People::findOrFail($id);
        $user->delete();
        return response()->json($user);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'firstName' => 'required',
            'middleName' => 'required',
            'lastName' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>'422',
                'error'=> $validator->errors()
            ]);
        }else{
            $model = new People();
            $model -> user_id = $request->user_id;
            $model -> firstname = $request -> firstName;
            $model -> middleName = $request -> middleName;
            $model -> lastName = $request -> lastName;
            $model -> email = $request -> email;
            $model -> password = Hash::make($request -> password);
            $model -> role = $request -> role;

            $model -> save();
            return response()->json([
                'status' => '200',
                'msg' => 'Student add successfully'
            ]);
        }
    }
}
