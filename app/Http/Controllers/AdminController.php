<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
//use Illuminate\Auth\SessionGuard;
//use Illuminate\Validation\Validator;
//use App\Http\Request;
use App\Models\User;
use DB;
use Validator;
use Auth;
use Hash;
use Mail;

class AdminController extends Controller
{
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
                    
            if (Auth::attempt($user_data)) {
                  $remember = $request->remember;
                 //echo $remember; die();
                if (!empty($remember)) {
                    setcookie('email', $request->get('email'), time()+60*60*24*15);
                    setcookie('password', $request->get('password'), time()+60*60*24*15);
                    //Auth::login(Auth::user()->id,true);
                }
                  //$minute=15;
                  /*$response=new Response("hello");
                  //$email=$request->cookie('email');
                  //$password=$request->cookie('password');
                  $response->withCookie(cookie('email',$request->email,$minute));

                  $response->withCookie(cookie('password',$request->password,$minute));
                  */
                if (auth()->user()->is_admin == 1) {
                    //$request->session()->put('LoggedAdmin', $userInfo->id);
                        
                    //$request->session()->put('LoggedAdminName', $userInfo->first_name);
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
                $current_user = auth()->user();
                //dd($current_user);
            if (Hash::check($request->old_password, $current_user->password)) {
                //dd($current_user);
                $current_user->update([
                'password'=>bcrypt($request->new_password)
                ]);
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
            $data=['LoggedAdminInfo'=>User::where('id', '=', session('LoggedAdmin'))->first()];
            
            $record_per_page = isset($request->record_per_page) ? $request->record_per_page : 3;
            if ($request->search_user) {
                //return redirect('/search_user');
                $search_text = $request->search_user;
                $user = User::where('first_name', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('email', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('mobile_no', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('birthdate', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('city', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('state', 'LIKE', '%'.$search_text.'%')
                                ->sortable()
                                ->paginate($record_per_page);
                return view('admin.user_profile', ['users' => $user], $data);
            } else {
                $users = User::sortable()->paginate($record_per_page);
                return view('admin.user_profile', compact('users'));
            }
        } catch (\Exception $e) {
            return redirect('/user_profile')->with('error', "Fail to show data.");
        }
    }
    
    public function editUser($id)
    {
        try {
           // $data=['LoggedAdminInfo'=>User::where('id', '=', session('LoggedAdmin'))->first()];
            
            $user = DB::table('users')->where('id', $id)->first();//or firstOrFail
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
            } catch (\Exception $e) {
                return redirect('user_profile')->with('failtouseredit', "Fail to update user.");
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
            } catch (\Exception $e) {
                return redirect('user_profile')->with('failtouseredit', "Fail to update user.");
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
            
            $users = User::find($id);
            $book = DB::table('users')->where('id', $id)->delete();
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
            Auth::logout();
            return redirect('/admin');
        } catch (\Exception $e) {
            return redirect('/successlogin')->with('error', "Fail to logout.");
        }
        //return redirect('/admin');
    }
    
    public function requestBook()
    {
        try {
               $books=DB::table('issue_book')
               ->join('books', 'issue_book.book_id', '=', 'books.id')
               ->join('users', 'issue_book.user_id', '=', 'users.id')
               ->where('issue_book.approve', "pending")
               // ->select( 'issue_book.*', 'users.id AS u_id', 'book.*' ,'issue_book.*' )
               ->get();
              /*foreach($books as $bk)
               {

                    //   session('bookid', $bk->b_id);

                    session()->put('userId', $bk->id);
                    //session('userid', $bk->id);
               }*/
              
            return view('books.requestBook', ['issue_book'=>$books]);
        } catch (\Exception $e) {
            return back()->with('faildelete', "Fail to get request Book.");
        }
    }
    
    
    public function borrowBookList()
    {
        try {
               $books=DB::table('issue_book')
               ->join('books', 'issue_book.book_id', '=', 'books.id')
               ->join('users', 'issue_book.user_id', '=', 'users.id')
               ->where('issue_book.approve', "yes")
               // ->select( 'issue_book.*', 'users.id AS u_id', 'book.*' ,'issue_book.*' )
               ->get();
              /*foreach($books as $bk)
               {

                    //   session('bookid', $bk->b_id);

                    session()->put('userId', $bk->id);
                    //session('userid', $bk->id);
               }*/
              
            return view('books.borrowBook', ['issue_book'=>$books]);
        } catch (\Exception $e) {
            return back()->with('faildelete', "Fail to get request Book.");
        }
    }
    
    public function returnBookList()
    {
        try {
               $books=DB::table('issue_book')
               ->join('books', 'issue_book.book_id', '=', 'books.id')
               ->join('users', 'issue_book.user_id', '=', 'users.id')
               ->where('issue_book.approve', "return")
               // ->select( 'issue_book.*', 'users.id AS u_id', 'book.*' ,'issue_book.*' )
               ->get();
              /*foreach($books as $bk)
               {

                    //   session('bookid', $bk->b_id);

                    session()->put('userId', $bk->id);
                    //session('userid', $bk->id);
               }*/
              
            return view('books.returnBook', ['issue_book'=>$books]);
        } catch (\Exception $e) {
            return redirect('successlogin')->with('error', "Fail to get return Book.");
        }
    }
        
    /*public function issue_id($id)
    {
        try {
            $books = DB::table('issue_book')->where('id', $id)->first();//too see exception write firstOrFail
              return view('books.approve', compact('books'));
      } catch (\Exception $e) {
            return back()->with('editid', "id not found ");
        }

    }*/
    
    public function approvePage($id, $id2)
    {
        try {
        //dd($request->session()->put('bookId', $request->b_id));
                            $book1 = DB::table('books')->where('id', $id2)->first();//or firstOrFail
                     $book = DB::table('users')->where('id', $id)->first();//or firstOrFail
            //return view('admin.edit_user','.id not found');
            return view('books.approve', compact('book1'), compact('book'));
            
            ///$books = DB::table('issue_book')->where('id', $id)->first();//too see exception write firstOrFail
            //return view('books.approve');
           // $request->session()->put('userId', $book->id);
            //$request->session()->put('bookid', $book->b_id);
                            /*
                                $books=DB::table('issue_book')
               ->join('books', 'issue_book.book_id', '=', 'books.b_id')
               ->join('users', 'issue_book.user_id', '=', 'users.id')
               // ->select( 'issue_book.*', 'users.id AS u_id', 'book.*' ,'issue_book.*' )
               ->get();
            /*  foreach($books as $bk)
               {

                   // session('bookid', $bk->b_id);

                    session()->put('userId', $bk->id);
                    //session('userid', $bk->id);
               }*/
            //return view('books.approve');
        } catch (\Exception $e) {
            return back()->with('error', "Error to get approve page.");
        }
    }
    
    public function approveRequest(Request $request)
    {
        try {
            //dd($request->id);
         //   $request->session()->put('userId', $book->id);
                        //  $request->session()->put('bookid', $book->b_id);
         //$bk=Session('bookId');
         //dd($bk);
            //$id=$request->b_id;
            //dd($b_id);
            //$bk=Session('bookId');
           //dd($bk);
           //$ui=Session::get('userId');
            //   dd($ui);
            //dd($_GET['book_id']);
            //dd(request('book_id'));;
            //$id=GET[id];
            //dd($id);
             $this->validate($request, [
                'approve'       => 'required',
                'issue_date'      => 'required',
                'return_date'    => 'required',
                
             ]);
                    //dd(Session::get('bookId'));
             //  $ui=Session::get('userId');
                //dd($ui);
                //$bk=6;
                //$ui=4;
                // dd($request->id2);
              DB::table('issue_book')->where('user_id', $request->id)->where('book_id', $request->id2)->update([
                    'approve' => $request->approve,
                    'issue_date' => $request->issue_date,
                    'return_date' => $request->return_date,
                ]);
                /*$query= DB::table('books')->where('id','=',Session::get('bookId'));
                 $query->decrement('quantity', 1);
                  */
                // DB::table('books')->join('issue_book','issue_book.book_id','=','books.id') ->select('books.*','cart.id as cart_id');
                
			 /*              $data = array('name'=>"Ashi milonee");

				 //$pdf = PDF::loadView('Books.test', $data);
				   Mail::send(['text'=>'mail'], $data, function($message) {
					  $message->to('urvashi2705@gmail.com', "Ashi's book")->subject
						 ('Laravel Basic Testing Mail')->attach('borrowBook.pdf');
					  $message->from('urvashi.hiranandani@brainvire.com','ashi milonee');
				   });*/
      
                    $mpdf = new \Mpdf\Mpdf();
                    //$pdf=\App::make('dompdf.wrapper');
            $data["email"]=$request->email;
            $data["client_name"]=$request->first_name;
            $data["subject"]="Borrow Book";
         // Write some HTML code:
          /*$books=DB::table('issue_book')
               ->join('books', 'issue_book.book_id', '=', 'books.id')
               ->where('issue_book.user_id', $userId)
               ->get();*/
             $userId=$request->id;
             $bookId=$request->id2;
             // dd($userId);
            
                $p=DB::table('issue_book')
               ->join('books', 'issue_book.book_id', '=', 'books.id')
               ->join('users', 'issue_book.user_id', '=', 'users.id')
              // ->where("issue_book.approve",'=',"pending")->where('user_id',$userId)
               ->where("issue_book.approve", '=', "yes")->where('user_id', $userId)->where('book_id', $bookId)
               // ->select( 'issue_book.*', 'users.id AS u_id', 'book.*' ,'issue_book.*' )
               ->get();
            $book= view()->share('p', $p);
     //dd($book);
       // $book= view()->share('p', $p);
       //$image= asset('upload/'.$bk->image) ;
         // $pdf= PDF::loadview('check_pdf');
     //  ob_start();
        
            $output = '
			 <h3 align="center">Borrow Book Data</h3>
			 <table width="100%" style="border-collapse: collapse; border: 0px;">
			  <tr>
			<th style="border: 1px solid; padding:12px;" width="30%">User Name</th>
			 <th style="border: 1px solid; padding:12px;" width="30%">Image</th>
			<th style="border: 1px solid; padding:12px;" width="30%">Title</th>
			<th style="border: 1px solid; padding:12px;" width="15%">Author</th>
			<th style="border: 1px solid; padding:12px;" width="15%">Category</th>
			 <th style="border: 1px solid; padding:12px;" width="20%">IssueDate</th>
			  <th style="border: 1px solid; padding:12px;" width="20%">Return Date</th>
		   </tr>
			 ';
            foreach ($book as $bk) {
                   $output .= '
      <tr>
		  <td style="border: 1px solid; padding:12px;">'.$bk->first_name.'</td>
	   <td style="border: 1px solid; padding:12px;">'.$bk->image.'</td>
	   
       <td style="border: 1px solid; padding:12px;">'.$bk->title.'</td>
       <td style="border: 1px solid; padding:12px;">'.$bk->author.'</td>
       <td style="border: 1px solid; padding:12px;">'.$bk->category.'</td>
       <td style="border: 1px solid; padding:12px;">'.$bk->issue_date.'</td>
	   <td style="border: 1px solid; padding:12px;">'.$bk->return_date.'</td>
      </tr>
      ';
            }
            $output .= '</table>';
            $mpdf->WriteHTML("$output");
       
         // Output a PDF file directly to the browser
         //$mpdf->Output('book.pdf', 'D');

            Mail::send('Books.test', $data, function ($message) use ($data, $mpdf) {
                $message->to($data["email"], $data["client_name"])
                ->subject($data["subject"])
                ->attachData($mpdf->output('invoice.pdf', 'S'), "invoice.pdf");
            });
       // $mpdf->SendHTML("$output");
       
         // Output a PDF file directly to the browser
         //$mpdf->Output('book.pdf', 'D');
                 return redirect('request_book')->with('success', "Request accepted successfully");
        } catch (\Exception $e) {
            return redirect('request_book')->with('error', "Fail to approve data.");
        }
    }
    
    public function returnBook($id, $id2)
    {
        try {
               // dd($id2);
              //$userId=auth()->user()->id;
             // dd($userId);
             $borrow= DB::table('issue_book')->where('user_id', $id)->where('book_id', $id2)->update([
            'approve'=>"return"
        //'issue_date'=>$request->issue_date,
        //'return_date'=>$request->return_date
             ]);
            $query=DB::table('books')->where('id', '=', $id);
            $query->increment('quantity', 1);
        
             //ModelName::where(['id'=>1,'user'=>'admin'])->update(['column_name'=>'value',.....]);
               /*$books=DB::table('issue_book')->where('user_id',$userId)->where('book_id',$id)->update([
                    approve=>"return"
               ]);

			*/            //return view('books.borrowList', ['issue_book'=>$books]);
            return back()->with('success', "Book return successfully.");
        } catch (\Exception $e) {
            return back()->with('error', "Fail to return book list.");
        }
    }
    public function returnBookPage()
    {
        try {
             $books=DB::table('issue_book')
               ->join('books', 'issue_book.book_id', '=', 'books.id')
               ->join('users', 'issue_book.user_id', '=', 'users.id')
               ->where('issue_book.approve', "return")
               // ->select( 'issue_book.*', 'users.id AS u_id', 'book.*' ,'issue_book.*' )
               ->get();
              /*foreach($books as $bk)
               {

                    //   session('bookid', $bk->b_id);

                    session()->put('userId', $bk->id);
                    //session('userid', $bk->id);
               }*/
              
            return view('Books.ReturnBookDetail', ['issue_book'=>$books]);
             //return view('Books.ReturnBookDetail');
        } catch (\Exception $e) {
            return back()->with('error', "Fail to return book list.");
        }
    }
}
