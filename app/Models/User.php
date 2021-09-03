<?php

namespace App;

namespace App\Models;

//use Sortable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Auth;
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use Sortable;
   
    // public $timestamps= false;
 //public $fillable = ['id','first_name','last_name','email', 'birthdate','city','state'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'id','first_name','last_name','email','password','gender','mobile_no', 'birthdate','city','state','pincode','address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public $sortable = ['id','first_name','email', 'mobile_no','birthdate','city','state'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
	public function userLogin($user_data){
			  if (Auth::attempt($user_data)) {
               /* $remember = $request->remember;
                    //echo $remember; die();

                if (!empty($remember)) {
                    setcookie('email', $request->get('email'), time()+60*60*24*15);
                    setcookie('password', $request->get('password'), time()+60*60*24*15);
                    Auth::login(Auth::user()->id, true);
                }*/ 
				return Auth::attempt($user_data);
				   }
	}
	public function checkAdmin()
	{
		
		return auth()->user()->is_admin == 1;
	}
	
	public function show($search,$record_per_page)
	{
		if (isset($search)) {
               
                $search_text = $search;
               
				 $record_per_page = isset($record_per_page) ? $record_per_page: 3;
					
				$books = book::where('title', 'LIKE', '%'.$search_text.'%')
                                    ->orWhere('description', 'LIKE', '%'.$search_text.'%')
                                    ->orWhere('id', 'LIKE', '%'.$search_text.'%')
                                    ->orWhere('category', 'LIKE', '%'.$search_text.'%')
                                    ->sortable()
                                    ->paginate($record_per_page);
                return $books;
            } else {
                $record_per_page = isset($record_per_page) ? $record_per_page: 3;
                $books = book::sortable()->paginate($record_per_page);
               return $books;
            }
	}
	
	public function userCreate($user){
		//dd($user);
		$this->create($user);
	}
	
	public function userData($search_text,$record_per_page){
		 $users=$this->where('first_name', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('email', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('mobile_no', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('birthdate', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('city', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('state', 'LIKE', '%'.$search_text.'%')
                                ->sortable()
                                ->paginate($record_per_page);
		return $users;
	}
	
	public function userEdit($id){
		return $this->where('id', $id)->first();
	}
	
	public function userUpdate($user,$id){
		 $this->where('id', $id)->update($user);
	}
	public function userDelete($id){
		$this->where('id', $id)->delete();
	}
	
	
}
