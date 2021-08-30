<?php

namespace App\Http\Api\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserApiController extends Controller
{
    public function res(Request $request)
    {
        $books=new User;
        $books->first_name=$request->first_name;
        $books->last_name=$request->last_name;
        $books->email=$request->email;
        $books->password=$request->password;
        $books->gender=$request->gender;
        $books->mobile_no=$request->mobile_no;
        $books->birthdate=$request->birthdate;
        $books->address=$request->address;
        $books->city=$request->city;
        $books->state=$request->state;
        $books->pincode=$request->pincode;
    
        $result=$books->save();
        if ($result) {
            return ["result"=>"Data has been saved."];
        } else {
            return ["result"=>"Op Fail."];
        }
    }
}
