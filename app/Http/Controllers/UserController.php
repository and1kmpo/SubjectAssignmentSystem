<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $inputs = $request->input();
        $inputs ['password'] = Hash::make(trim($request->password)); 
        $e = User::create($inputs);
        return response()->json(([
            'data' => $e,
            'message' => 'User created successfully'
        ]));
    }


    public function show($id)
    {
        $e = User::find($id);
        if(isset($e)){
         return response()->json([
             'data' => $e,
             'message'=>'User found successfully'
         ]);
        }else{
         return response()->json([
             'error' => true,
             'message'=>'User not found'
         ]);
        }
    }

    public function update(Request $request, $id)
    {
        $e = User::find($id);
        if(isset($e)){
         $e->name = $request->name;
         $e->email = $request->email;
         $e->password = Hash::make(trim($request->password));
         if ($e->save()){
             return response()->json([
                 'data' => $e,
                 'message' => 'User updated successfully'
             ]);
         };
 }else{
     return response()->json([
         'error' => true,
         'message' => 'Not found user'
     ]);
    }
}

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
    
        $user->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
    }
}
