<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name'    => 'Erron John',
            'last_name' => 'Lapac',
        	'name'		=> 'Administrator',
            'contact_no'      => '1234567891',
            'address'      => 'Philippines',
            'age'      => '24',
        	'username'	=> 'admin',
        	'password' 	=> bcrypt('123456')
        ]); 

      	$role = Role::firstOrCreate([
        	'name'	=> 'Chairman',
        	'label'	=> 'administrator',

        ]);
        
     	$user->role()->associate($role)->save();
 
    }
}
