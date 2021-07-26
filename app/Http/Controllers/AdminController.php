<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Auth\SessionGuard;
//use Illuminate\Validation\Validator;
//use App\Http\Request;
use App\Models\User;
use DB;
use Validator;
use Auth;
use Hash;

class AdminController extends Controller
{
	 public function mainpage(){
		
		return view('admin.login');
	
	}	
	
	/* public function mainlogin(){
		
		return view('admin/login');
	
	}*/	
    public function check_login(Request $request){
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
			if(auth()->user()->is_admin == 1){
				return redirect("/successlogin");
			}
			else{
				return redirect("/home")->with("visitor","You have no right to login in admin panel.");
			}
			/*$user=auth()->user();
			dd($user);*/
			//return redirect('successlogin');
		}
		else
		{
			return back()->with('error','Wrong login details');
		}
	}	
	
	 public function successlogin(){
		
		return view('admin.successlogin');
	
	}	
	
	 public function change_password(){
		
		return view('admin.changepassword');
	
	}	
	
	 public function update_password(Request $request){
		$this->validate($request,[
			'old_password'			 => 'required|alphaNum|min:8',
			'new_password'		 => 'required|alphaNum|min:8',
			'confirm_password'    => 'required|alphaNum|same:new_password'
		]);
		
		$current_user = auth()->user();
		//dd($current_user);
		if(Hash::check($request->old_password,$current_user->password)){
			//dd($current_user);
			$current_user->update([
			'password'=>bcrypt($request->new_password)
			]);
			//dd($current_user);
			return redirect()->back()->with('success','Password successfuly updated.');
	
		}
		else{
			return redirect()->back()->with('error','Old password does not matched.');
		}
 
	
	}	
	
	
	public function user_profile(Request $request){
		
		$record_per_page = isset($_GET["record_per_page"]) ? $_GET["record_per_page"] : 3; 
			if(isset($_GET['search_user']))
			{
			//return redirect('/search_user');
				$search_text = $_GET['search_user'];
			
				$user = User::where('first_name','LIKE', '%'.$search_text.'%')->sortable()->paginate($record_per_page);
			
				return view('admin.user_profile', ['users' => $user]);
				}
			else
			{
				
				$users = User::sortable()->paginate($record_per_page);
		
				return view('admin.user_profile', compact('users'));
			}
		}
	
	
	/*	public function search_user(Request $request){
    
			$record_per_page = isset($_GET["record_per_page"]) ? $_GET["record_per_page"] : 3; 
			
			if(isset($_GET['search_user'])){
			//echo "zdjbsdkj";
			$search_text = $_GET['search_user'];
			
			$user = DB::table('users')->where('first_name','LIKE', '%'.$search_text.'%')->paginate($record_per_page);
		
			return view('admin.user_profile', ['users' => $user]);
			}
			else
			{
				//echo "dhskd";
					return view('admin.user_profile');
			}
		}*/
	
	public function editUser($id){
		//echo "echo dhskjs";
		$user = DB::table('users')->where('id', $id)->first();
		return view('admin.edit_user', compact('user'));
	}
	
	public function updateUser(Request $request){
		if($request->password){
		$this->validate($request,[
			'first_name' 			=> 'required',
			'last_name' 			=> 'required',
			'email'			 => 'required|email',
			'password'		 => 'alphaNum|min:8',
			'gender' 			=> 'required',
			'mobile_no'		 => 'required|alphaNum',
			'birthdate' => 'required',
			'address'	 => 'required',
			'city'		 => 'required',
			'state'		 => 'required',
			'pincode'	 => 'required'
			
	]);
	
		
		DB::table('users')->where('id', $request->id)->update([
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
		}
		else
		{
			$this->validate($request,[
			'first_name' 			=> 'required',
			'last_name' 			=> 'required',
			'email'			 => 'required|email',
			//'password'		 => 'alphaNum|min:8',
			'gender' 			=> 'required',
			'mobile_no'		 => 'required|alphaNum',
			'birthdate' => 'required',
			'address'	 => 'required',
			'city'		 => 'required',
			'state'		 => 'required',
			'pincode'	 => 'required'
			
		]);
	
		
		DB::table('users')->where('id', $request->id)->update([
			'first_name' => $request->first_name,
			'last_name' => $request->last_name,
			'email' => $request->email,
			//'password' => Hash::make($request->password),
			'gender' => $request->gender,
			'mobile_no' => $request->mobile_no,
			'birthdate' => $request->birthdate,
			'address' => $request->address,
			'city' => $request->city,
			'state' => $request->state,
			'pincode' => $request->pincode,
		]);
		}
		//return redirect('admin/edit_book');
		return redirect('/user_profile')->with('updateUser', "User data updated successfully");
		//return back()->with('bookupdate',"Book data updated successfully")->with('image',$imageName);
	}
	
	public function delete_user(Request $request,$id){
		$users = User::find($id);
		$book = DB::table('users')->where('id', $id)->delete();
		return back()->with('deleteuser',"User deleted successfully");
	}
	
	
	public function logout(){
		Auth::logout();
		return redirect('/admin');
			
	}
}
	