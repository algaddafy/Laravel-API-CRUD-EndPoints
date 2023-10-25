<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $array = User::all();
        
        return response()->json([
            'message'=> count($array).' data found',
            'data'=> $array,
            'status'=> true
        ],200);
    }

    public function show($id){
        $user = User::find($id);
        if($user != null){
            return response()->json([
                'message'=> 'Data found',
                'data'=> $user,
                'status'=> true
            ],200);
        }else{
            return response()->json([
                'message'=> 'Data Not found',
                'data'=> [],
                'status'=> true
            ],200);
        }
        
    }

    public function store(Request $request){
        $Validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if($Validator->fails()){
            return response()->json([
                'message'=> 'Validate your input.',
                'error'=> $Validator->errors(),
                'status'=> false
            ],200);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return response()->json([
            'message'=> 'Data inserted.',
            'data'=> $user,
            'status'=> true
        ],200);
        
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        if($user == null){
            return response()->json([
                'message'=> 'User not found.',
                'status'=> false
            ],200);
        }

        $Validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email'
            // 'password'=>'required',
        ]);
        if($Validator->fails()){
            return response()->json([
                'message'=> 'Validate your input.',
                'error'=> $Validator->errors(),
                'status'=> false
            ],200);
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        // $user->password = $request->password;
        $user->save();

        return response()->json([
            'message'=> 'Data Updated.',
            'data'=> $user,
            'status'=> true
        ],200);
        
    }

    public function destroy($id){
        $user = User::find($id);
        if($user == null){
            return response()->json([
                'message'=> 'User not found.',
                'status'=> false
            ],200);
        }

        $user->delete();

        return response()->json([
            'message'=> 'Data Deleted.',
            'status'=> true
        ],200);
        
    }
    
}
