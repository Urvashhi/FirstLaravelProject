<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Hash;

use Validator;

use Auth;

class UsersApiController extends Controller
{
    
    public function index()
    {
        return User::all();
    }
    
   
    
    public function resval(Request $request)
    {
        
        $rules=array(
             'first_name'            => 'required',
                    'last_name'             => 'required',
                    'email'                 => 'required|email|unique:users',
                    'password'              => 'required|alphaNum|min:8',
                    'confirm_password'      => 'required|alphaNum|same:password',
                    'gender'                => 'required',
                    'mobile_no'             => 'required|alphaNum',
                    'birthdate'             => 'required',
                    'address'               => 'required',
                    'city'                  => 'required',
                    'state'                 => 'required',
                    'pincode'               => 'required'
        );
    
        $validator=Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $users=new User;
            $users->first_name=$request->first_name;
            $users->last_name=$request->last_name;
            $users->email=$request->email;
            $users->password=Hash::make($request->password);
            $users->gender=$request->gender;
            $users->mobile_no=$request->mobile_no;
            $users->birthdate=$request->birthdate;
            $users->address=$request->address;
            $users->city=$request->city;
            $users->state=$request->state;
            $users->pincode=$request->pincode;
        
            $result=$users->save();
            if ($result) {
                return ["result"=>"User Registration successfully."];
            } else {
                return ["result"=>"Fail to registration."];
            }
        }
    }

    public function login(Request $request)
    {
             $rules=array(
                    'email'          => 'required|email',
                    'password'       => 'required|alphaNum|min:8'
                );
             $user_data = array(
                'email'  => $request->get('email'),
                'password' => $request->get('password')
             );
             $validator=Validator::make($request->all(), $rules);
             if ($validator->fails()) {
                 return response()->json($validator->errors(), 401);
             } else {
                 if (Auth::attempt($user_data)) {
                     return ["result"=>"Login Successful."];
                 } else {
                     return ["result"=>"Fail to login."];
                 }
             }
    }
    
    public function edit($id)
    {
        return User::all()->where('id', $id)->first();//or firstOrFail
    }
    
    public function update(Request $request)
    {
        
        $rules=array(
            'first_name'            => 'required',
                   'last_name'             => 'required',
                   'email'                 => 'required|email|unique:users',
                   'password'              => 'required|alphaNum|min:8',
                   'confirm_password'      => 'required|alphaNum|same:password',
                   'gender'                => 'required',
                   'mobile_no'             => 'required|alphaNum',
                   'birthdate'             => 'required',
                   'address'               => 'required',
                   'city'                  => 'required',
                   'state'                 => 'required',
                   'pincode'               => 'required'
        );
    
        $validator=Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $users=User::find($request->id);
        //$users=new User;
            $users->first_name=$request->first_name;
            $users->last_name=$request->last_name;
            $users->email=$request->email;
            $users->password=Hash::make($request->password);
            $users->gender=$request->gender;
            $users->mobile_no=$request->mobile_no;
            $users->birthdate=$request->birthdate;
            $users->address=$request->address;
            $users->city=$request->city;
            $users->state=$request->state;
            $users->pincode=$request->pincode;
    
            $result=$users->save();
            if ($result) {
                return ["result"=>"Data has been updated."];
            } else {
                return ["result"=>"Fail to update data."];
            }
        }
    }
    
    public function search($name)
    {
		$result= User::where("first_name", "like", "%".$name."%")->get();
    
        if (count($result)) {
            return $result;
        } else {
            return array('Result', 'No records found');
        }
    }
    
    public function delete($id)
    {
        
     //return array('result'=> 'Record has been deleted'.$id);
        $users=User::find($id);
        //return array('result'=> 'Record has been deleted'.$users);
        $result=$users->delete();
    
        if ($result) {
            return array('result', 'Record has been deleted.');
        } else {
            return array('result', 'Delete Operation failed.');
        }
    }
    
    
    public function updateUserPassword(Request $request)
    {
         
        $rules=array(
        'old_password'           => 'required|alphaNum|min:8',
        'new_password'       => 'required|alphaNum|min:8',
        'confirm_password'    => 'required|alphaNum|same:new_password'
          );
     
          $validator=Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $current_user = auth()->user();
            if (Hash::check($request->old_password, $current_user->password)) {
                  //dd($user->password);
                  $current_user->update([
                  'password'=>bcrypt($request->new_password)
                  ]);
               
                        return ["result"=>"Password updated Successful."];
            } else {
                return ["result"=>"Fail to update password ."];
            }
        }
    }
}
