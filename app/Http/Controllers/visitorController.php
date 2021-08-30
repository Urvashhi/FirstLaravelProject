<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;
use Hash;
use DB;

class VisitorController extends Controller
{
    public function index()
    {
        try {
            return view('visitor.mainpage');
        } catch (\Exception $e) {
            return redirect('/home')->with('failLogin', "Fail to get mainpage page.");
        }
    }
    
    public function login()
    {
        try {
            ///if (Auth::check()) {
           // return redirect('/login');
            if (session()->has('LoggedUser') && ($request->path() == '/login' || $request->path() == '/registration' )) {
                return back();
            }
     
                return view('visitor.login');
            //}
        } catch (\Exception $e) {
            return redirect('/home')->with('failLogin', "Fail to get login page.");
        }
    }
    
    public function dashboard()
    {
        try {
            $data=['LoggedUserInfo'=>User::where('id', '=', session('LoggedUser'))->first()];
            
            //dd(session('LoggedUser'));
            return view('visitor.dashboard');
        } catch (\Exception $e) {
            return redirect('/home')->with('failLogin', "Fail to get dashboard page.");
        }
    }
    
    public function checkUserLogin(Request $request)
    {
         //ksdjhjhhjh
        //dd($_POST);
       // return $request=input();
                $this->validate($request, [
                    'email'          => 'required|email',
                    'password'       => 'required|alphaNum|min:8'
                ]);
        try {
            //  $user=Users::where('email',$request->input('email'))->get();
            //if(Crypt::decrypt($user[0]->password)==
            $user_data = array(
                'email'  => $request->get('email'),
                'password' => $request->get('password')
            );
            
            $userInfo = User::where('email', '=', $request->email)->first();
            //DD(id);
            if (!$userInfo) {
                return back()->with('fail', 'We do not recognize your email address');
            } else {
                //check password
                if (Hash::check($request->password, $userInfo->password)) {
                    $request->session()->put('LoggedUser', $userInfo->id);
                    $request->session()->put('LoggedUserName', $userInfo->first_name);
                    //dd( $userInfo->id);
                    return redirect('/dashboard');
                }//else{
            //$request->session()->put('users',$data['users']);
            //$remember=$request->get('remember')?true:false;
            /*if (Auth::attempt($user_data)) {
                $remember = $request->remember;
                    //echo $remember; die();

                if (!empty($remember)) {
                    setcookie('email', $request->get('email'), time()+60*60*24*15);
                    setcookie('password', $request->get('password'), time()+60*60*24*15);
                    //Auth::login(Auth::user()->id,true);
                }
                /*$user=auth()->user();
                dd($user);*/
               // return redirect('dashboard');
            //}
                else {
                    return back()->with('error', 'Wrong login details');
                }
            }
        } catch (\Exception $e) {
            return back()->with('failtologin', "Fail to login.");
        }
    }
    
    
    public function registration()
    {
        try {
            return view('visitor.Registration');
        } catch (\Exception $e) {
            return redirect('/home')->with('failLogin', "Fail to get registration form.");
        }
    }
    
    public function saveData(Request $request)
    {
        
                $this->validate($request, [
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
                    
                ]);
                
        try {
            DB::table('users')->insert([
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
                
            return redirect('/login')->with('success', "Your account has been created successfully.");
        } catch (\Exception $e) {
            return back()->with('failtores', "Fail to registration.");
        }
    }
    
    public function editProfile($id)
    {
        try {
             $data=['LoggedUserInfo'=>User::where('id', '=', session('LoggedUser'))->first()];
            $user = DB::table('users')->where('id', $id)->first();//or firstOrFail
            return view('visitor.edit_profile', compact('user'));//shows error but not in detail
        } catch (\Exception $e) {
            return redirect('dashboard')->with('failtoedit', "Fail to edit data.");
        }
    }
    
    public function updateUserData(Request $request)
    {
        
        /*if($request->password)
        {
            $this->validate($request,[
                'first_name'     => 'required',
                'last_name'      => 'required',
                'email'          => 'required|email',
                'password'       => 'alphaNum|min:8',
                'gender'         => 'required',
                'mobile_no'      => 'required|alphaNum',
                'birthdate'      => 'required',
                'address'        => 'required',
                'city'           => 'required',
                'state'          => 'required',
                'pincode'        => 'required'

            ]);
            try{
                    DB::table('users')->where('id', $request->id)->update([
                        'first_name'     => $request->first_name,
                        'last_name'      => $request->last_name,
                        'email'          => $request->email,
                        'password'       => Hash::make($request->password),
                        'gender'         => $request->gender,
                        'mobile_no'      => $request->mobile_no,
                        'birthdate'      => $request->birthdate,
                        'address'        => $request->address,
                        'city'           => $request->city,
                        'state'          => $request->state,
                        'pincode'       => $request->pincode,
                    ]);
                }
                catch(\Exception $e)
                {
                    return redirect('/dashboard')->with('failtoupdate',"Fail to update data.");
                }
        }
        else
        {*/
                    $this->validate($request, [
                    'first_name'        => 'required',
                    'last_name'         => 'required',
                    'email'             => 'required|email',
                    //'password'         => 'alphaNum|min:8',
                    'gender'            => 'required',
                    'mobile_no'         => 'required|alphaNum',
                    'birthdate'         => 'required',
                    'address'           => 'required',
                    'city'              => 'required',
                    'state'             => 'required',
                    'pincode'           => 'required'
                    
                    ]);
        try {
            DB::table('users')->where('id', $request->id)->update([
                'first_name'     => $request->first_name,
                'last_name'      => $request->last_name,
                'email'          => $request->email,
                //'password' => Hash::make($request->password),
                'gender'        => $request->gender,
                'mobile_no'  => $request->mobile_no,
                'birthdate' => $request->birthdate,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'pincode' => $request->pincode,
            ]);
        } catch (\Exception $e) {
            return redirect('/dashboard')->with('failtoupdate', "Fail to update data.");
        }
        //}
                    //return redirect('admin/edit_book');
                    return redirect('/dashboard')->with('updateUser', "Your profile has been updated successfully");
                    //return back()->with('bookupdate',"Book data updated successfully")->with('image',$imageName);
    }
    
    public function changeUserPassword()
    {
        try {
             $data=['LoggedUserInfo'=>User::where('id', '=', session('LoggedUser'))->first()];
            return view('visitor.chage_user_pass');
        } catch (\Exception $e) {
            return redirect('/dashboard')->with('failtoupdate', "Fail to find changepassword page.");
        }
    }
    
    public function logout()
    {
        try {
            if (session()->has('LoggedUser')) {
                //Auth::logout();
                session()->pull('LoggedUser');
                return redirect('/home');
            }
           // Auth::logout();
            //return redirect('/home');
        } catch (\Exception $e) {
            return redirect('/dashboard')->with('failtoupdate', "Fail to logout.");
        }
    }
}
