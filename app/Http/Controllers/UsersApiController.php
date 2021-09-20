<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Hash;

use Validator;

use Auth;

class UsersApiController extends Controller
{
    public function __construct(User $users)
    {
        $this->user = $users;
    }
   
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
           /* $users=new User;
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

            $result=$users->save();*/
            $user=([
              'first_name' => $request->first_name,
              'last_name' => $request->last_name,
              'email' => $request->email,
              'password' => Hash::make($request->password),
              'gender' => $request->gender,
              'mobile_no' => $request->mobile_no,
              'birthdate' => $request->birthdate,
              'address' => $request->address,
              'city' => $request->city,
              'state' => $request->state,
              'pincode' => $request->pincode,
                    
                    
            ]);
            $result=$this->user->userCreate($user);
            if ($result) {
                return ["result"=>"User Registration successfully."];
            } else {
                return ["result"=>"Fail to registration."];
            }
        }
    }

    public function login(Request $request)
    {
        //print("jdbsjfbs");
             $rules=array(
                    'email'          => 'required|email',
                    'password'       => 'required|alphaNum|min:8'
                );
                //print_r($rules);
             $user_data = array(
                'email'  => $request->get('email'),
                'password' => $request->get('password')
             );
             $validator=Validator::make($request->all(), $rules);
             if ($validator->fails()) {
                 return response()->json($validator->errors(), 401);
             } else {
                 $result=$this->user->userLogin($user_data);
                 if ($result) {
                     $auth=Auth::user();
                     $token=$auth->createToken('auth-token')->plainTextToken;
                     return ["result"=>"Login Successful.","Token"=>$token];
                 } else {
                     return ["result"=>"Incorrect email or password to login."];
                 }
             }
             
            /*  $user_data = array(
                'email'  => $request->get('email'),
                'password' => $request->get('password')
             );
              $validator=Validator::make($request->all(),[
                    'email'          => 'required|email',
                    'password'       => 'required|alphaNum|min:8'
            ]);

        if ($validator->fails()) {
            return response()->json([
            'message'=>'validations fails',
            'errors'=>$validator->errors()
            ],422);
        }

        $user=$this->user->userLogin($validator);
        print_r($user);
        if($user){
            $token=$user->createToken('auth-token')->plainTextToken;
             return response()->json([
            'message'=>'Login successfull',
            'token'=>$token,
            'data'=>$user
            ],200);
        }
        else
        {
             return response()->json([
            'message'=>'Incorrect details',
            'errors'=>$validator->errors()
            ],400);
        }*/
    }
    
    public function edit($id)
    {
        return $this->user->userEdit($id);//or firstOrFail
    }
    
    public function update(Request $request)
    {
        
        $rules=array(
            'first_name'            => 'required',
                   'last_name'             => 'required',
                   'email'                 => 'required|email',
                   //'password'              => 'required|alphaNum|min:8',
                   //'confirm_password'      => 'required|alphaNum|same:password',
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
           /* $users=User::find($request->id);
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
            */
             $user=([
                        'first_name'     => $request->first_name,
                        'last_name'      => $request->last_name,
                        'email'          => $request->email,
                      //  'password'       => Hash::make($request->password),
                        'gender'         => $request->gender,
                        'mobile_no'      => $request->mobile_no,
                        'birthdate'      => $request->birthdate,
                        'address'        => $request->address,
                        'city'           => $request->city,
                        'state'          => $request->state,
                        'pincode'       => $request->pincode,
                    ]);
                       // $id=$request->id;
                $id=Auth::user()->id;
              $result=$this->user->userUpdate($user, $id);
            if ($result) {
                return ["result"=>"Data has been updated."];
            } else {
                return ["result"=>"Fail to update data."];
            }
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
            return response()->json($validator->errors(), 401);
        } else {
            $newPassword=$request->new_password;
            $oldPassword=$request->old_password;
            $currentUser = Auth::user();
            // print($currentUser);
            if ($this->user->changePassword($currentUser, $newPassword, $oldPassword)) {
                return  ('Password successfuly updated.');
            } else {
                    return ('Old password does not matched.');
            }
        }
    }
    
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ('User Logout successfully.');
    }
    
     /* public function search($name)
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
    }*/
}
