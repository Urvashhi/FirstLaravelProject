<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Auth;
use Hash;
use DB;

class visitorController extends Controller
{
    public function index(){
		return view('visitor.mainpage');
	}
	
	 public function login(){
		return view('visitor.login');
	}
	
	 public function dashboard(){
		return view('visitor.dashboard');
	}
	
	public function check_userlogin(Request $request){
		 //ksdjhjhhjh
		//dd($_POST);
		$this->validate($request,[
			'email'			 => 'required|email',
			'password'		 => 'required|alphaNum|min:8'
		]);
		$user_data = array(
			'email'  => $request->get('email'),
			'password' => $request->get('password')
		);
		
		//$remember=$request->get('remember')?true:false;
		if(Auth::attempt($user_data))
		{
			$remember = $request->remember;
			//echo $remember; die();
			
			if(!empty($remember))
			{
				setcookie('email',$request->get('email'),time()+60*60*24*15);
			    setcookie('password',$request->get('password'),time()+60*60*24*15);
				//Auth::login(Auth::user()->id,true);
			}
			/*$user=auth()->user();
			dd($user);*/
			return redirect('dashboard');
		}
		else
		{
			return back()->with('error','Wrong login details');
		}
	}	
	public function registration(){
		return view('visitor.Registration');
	}
	
	public function saveData(Request $request){
		
		$this->validate($request,[
			'first_name' 			=> 'required',
			'last_name' 			=> 'required',
			'email'			 => 'required|email|unique:users',
			'password'		 => 'required|alphaNum|min:8',
			'confirm_password'    => 'required|alphaNum|same:password',
			'gender' 			=> 'required',
			'mobile_no'		 => 'required|alphaNum',
			'birthdate' => 'required',
			'address'	 => 'required',
			'city'		 => 'required',
			'state'		 => 'required',
			'pincode'	 => 'required'
			
	]);
		
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
		
		return redirect('/login')->with('success',"Your account has been created successfully."); 
	}
	
	
	public function logout(){
		Auth::logout();
		return redirect('/home');
	
	}
}
