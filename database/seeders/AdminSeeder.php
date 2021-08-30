<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Hash;
use Hash;
use Illuminate\Support\Str;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
            'first_name' => 'ashi',
            'last_name' => 'milonee',
            'email' => 'ashi@gmail.com',
            //'password' => '6763746
            'password' => Hash::make('12345678'),
            'birthdate'  => '27-05-2000',
            'address' => 'abc complex,Mnainagar',
            'city'   => 'Ahemedad',
            'state' => 'Gujarat',
            'pincode' => '380080',
            'mobile_no' => '9668768351',
            'gender' => 'female'
            
            ]
        );
    }
}
