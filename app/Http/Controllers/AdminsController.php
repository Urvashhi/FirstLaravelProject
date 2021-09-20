<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
//use Illuminate\Auth\SessionGuard;
//use Illuminate\Validation\Validator;
//use App\Http\Request;
use App\Models\User;
use App\Models\IssueBook;
use DB;
use Validator;
use Auth;
use Hash;
use Mail;

class AdminsController extends Controller
{
    public function __construct(User $users)
    {
        $this->user = $users;
    }
    
    public function mainpage()
    {
        try {
            if (isset(Auth::user()->email)) {
                return back();
            }
            return view('admin.login');
        } catch (\Exception $e) {
            return redirect('/home')->with('error', "Fail to find admin login page.");
        }
    }
    
    public function checkLogin(Request $request)
    {
        $this->validate($request, [
                'email'          => 'required|email',
                'password'       => 'required|alphaNum|min:8'
            ]);
        try {
            $user_data = array(
                'email'  => $request->get('email'),
                'password' => $request->get('password')
            );
            
           /*  $userInfo = User::where('email', '=', $request->email)->first();
            //DD(id);
            if (!$userInfo) {
                return back()->with('fail', 'We do not recognize your email address');
            } else {
                */
                //check password
                //if (Hash::check($request->password, $userInfo->password)) {
                //  $request->session()->put('LoggedAdmin', $userInfo->is_admin);
                    //$request->session()->put('LoggedAdmin', $userInfo->id);
                   // $request->session()->put('LoggedUserName', $userInfo->first_name);
                    //dd( $userInfo->id);
                //    return redirect('/successlogin');
                
               // $request->session()->put('LoggedAdmin', $request->get('email'));
                //$remember=$request->get('remember')?true:false;
                
                        //Auth::logout();
                    
            if ($this->user->userLogin($user_data)) {
                if ($this->user->checkAdmin()) {
                    return redirect("/successlogin");
                } else {
                    return redirect("/home")->with("error", "You have no right to login in admin panel.");
                }
            } else {
                return back()->with('error', 'Wrong login details');
            }
                /*$user=auth()->user();
                dd($user);*/
                //return redirect('successlogin');
                //return response;
           // }
        } catch (\Exception $e) {
            return back()->with('error', "Fail to login.");
        }
    }
   
    public function successlogin()
    {
        try {
            // $data=['LoggedAdminInfo'=>User::where('id', '=', session('LoggedAdmin'))->first()];
            //dd(session('LoggedUser'));
            return view('admin.successlogin');
           // return view('admin.successlogin');
        } catch (\Exception $e) {
            return back()->with('failLogin', "Fail to find dashboard page.");
        }
    }
    
    public function changePassword($id)
    {
        try {
             //$data=['LoggedAdminInfo'=>User::where('id', '=', session('LoggedAdmin'))->first()];
            return view('admin.changepassword');
        } catch (\Exception $e) {
            return redirect('/successlogin')->with('error', "Fail to find changepassword page.");
        }
    }
    
    public function updatePassword(Request $request)
    {
         
        $this->validate($request, [
           'old_password'           => 'required|alphaNum|min:8',
           'new_password'          => 'required|alphaNum|min:8',
           'confirm_password'      => 'required|alphaNum|same:new_password'
        ]);
        try {
            $newPassword=$request->new_password;
                $oldPassword=$request->old_password;
             $currentUser = auth()->user();
            if ($this->user->changePassword($currentUser, $newPassword, $oldPassword)) {
                //dd($current_user);
                return redirect()->back()->with('success', 'Password successfuly updated.');
            } else {
                return redirect()->back()->with('error', 'Old password does not matched.');
            }
        } catch (\Exception $e) {
            return back()->with('error', "Fail to update password.");
        }
    }
    
    
    public function userProfile(Request $request)
    {
        try {
          //  $data=['LoggedAdminInfo'=>User::where('id', '=', session('LoggedAdmin'))->first()];
            
            $record_per_page = isset($request->record_per_page) ? $request->record_per_page : 3;
            //if ($request->search_user) {
                //return redirect('/search_user');
                $search_text = $request->search_user;
                $user = $this->user->userData($search_text, $record_per_page);
                return view('admin.user_profile', ['users' => $user]);
          /*  } else {
                $users =  $this->user->userData($search_text,$record_per_page);;
                return view('admin.user_profile', compact('users'));
            }*/
        } catch (\Exception $e) {
            return redirect('/user_profile')->with('error', "Fail to show data.");
        }
    }
    
    public function editUser($id)
    {
        try {
           // $data=['LoggedAdminInfo'=>User::where('id', '=', session('LoggedAdmin'))->first()];
            
            $user = $this->user->userEdit($id);//or firstOrFail
            //return view('admin.edit_user','.id not found');
            return view('admin.edit_user', compact('user'));//shows error but not in detail
        } catch (\Exception $e) {
            return back()->with('error', "Fail to edit user.");
        }
    }
    
    public function updateUser(Request $request)
    {
        if ($request->password) {
            $this->validate($request, [
                'first_name'            => 'required',
                'last_name'             => 'required',
                'email'          => 'required|email',
                'password'       => 'alphaNum|min:8',
                'gender'            => 'required',
                'mobile_no'      => 'required|alphaNum',
                'birthdate' => 'required',
                'address'    => 'required',
                'city'       => 'required',
                'state'      => 'required',
                'pincode'    => 'required'
                
            ]);
            try {
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
                $id=$request->id;
                 $this->user->userUpdate($user, $id);
            } catch (\Exception $e) {
                return redirect('user_profile')->with('error', "Fail to update user.");
            }
        } else {
            $this->validate($request, [
            'first_name'            => 'required',
            'last_name'             => 'required',
            'email'          => 'required|email',
            //'password'         => 'alphaNum|min:8',
            'gender'            => 'required',
            'mobile_no'      => 'required|alphaNum',
            'birthdate' => 'required',
            'address'    => 'required',
            'city'       => 'required',
            'state'      => 'required',
            'pincode'    => 'required'
            
            ]);
            try {
                   $user=([
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
                    $id=$request->id;
                    $this->user->userUpdate($user, $id);
            } catch (\Exception $e) {
                return redirect('user_profile')->with('error', "Fail to update user.");
            }
        }
            //return redirect('admin/edit_book');
            return redirect('/user_profile')->with('success', "User data updated successfully");
            //return back()->with('bookupdate',"Book data updated successfully")->with('image',$imageName);
    }
    
    public function deleteUser(Request $request, $id)
    {
        try {
            //$data=['LoggedAdminInfo'=>User::where('id', '=', session('LoggedAdmin'))->first()];
            
            $users = $this->user::find($id);
            $book = $this->user->userDelete($id);
            return back()->with('success', "User deleted successfully");
        } catch (\Exception $e) {
            return back()->with('error', "Fail to delete user.");
        }
    }
    
    
    public function logout()
    {
        try {
           /* if (session()->has('LoggedAdmin')) {
                //Auth::logout();
                session()->pull('LoggedAdmin');
                return redirect('/admin');
            }*/
            $this->user->logoutUser();
            return redirect('/admin');
        } catch (\Exception $e) {
            return redirect('/successlogin')->with('error', "Fail to logout.");
        }
        //return redirect('/admin');
    }
}
