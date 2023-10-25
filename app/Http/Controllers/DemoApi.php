<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoApi extends Controller
{
    public function Demo(){
        $array = [
            [
                'name'=> 'Nirob',
                'email'=> 'nirob@gmail.com'
            ],
            [
                'name'=> 'Atik',
                'email'=> 'atik@gmail.com'
            ]
        ];
        return response()->json([
            'message'=>'2 data found',
            'data'=> $array,
            'status'=> true
        ],200);
    }
}
