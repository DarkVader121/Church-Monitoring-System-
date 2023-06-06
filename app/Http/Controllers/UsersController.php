<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
//Temporary
use Notification;
use App\Notifications\EmailNotification;


class UsersController extends Controller
{
    public function index()
    {
    	$chairmans = User::where('role_id', 1)->get();
    	return view('users.index', compact('chairmans'));
    }

   
    public function disable(User $chairman)
    {   
        $this->validate(request(), 
        [    'admin_password' => 'required|password',],
         [    'admin_password.password' => 'The admin password is incorrect.',]);

        $chairman->update([
            'disabled' => true,
        ]);
        return redirect('/chairmans')->with('success', 'Chairman has been disabled!');
    }

    public function enable(User $chairman)
    {
    $this->validate(request(), 
    [    'admin_password' => 'required|password',],
     [    'admin_password.password' => 'The admin password is incorrect.',]);

    $chairman->update([
        'disabled'      	=> false,
    ]);
   
    return redirect('/chairmans')->with('success', 'Chairman has been enabled!');
    }
    
    public function store(Request $request)
    {
        $request->merge(['contact_no' => '09'.$request->input('contact_no')]);
    
        $this->validate(request(), [
            'first_name'   => 'required|regex:/^[a-zA-Z\\x{00F1}\\s]+$/u',
            'last_name'    => 'required|regex:/^[a-zA-Z\\x{00F1}\\s]+$/u',                     
            'contact_no' => ['required', 'digits:11', 'numeric','regex:/^09/'],
            'address'      => 'required',
            'birthday'          => 'required',
            'email'             => 'required',
            'username' => 'required|unique:users|min:6',
            'password'     => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/'],
            'password_confirmation'  => ['nullable', 'regex:/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/'],
    
        ],    
        [
            'password_confirmation.regex' => 'The password confirmation does not match.',
            'contact_no.regex'=>'Please enter a valid contact number starting with 09.',
            'password.regex'    => 'The password must be at least 8 characters long and contain at least one uppercase and one lowercase letter.',
            'username.min' => 'The username must be at least 6 characters.',
            'first_name.alpha'   => 'The first name may only contain letters.',
            'last_name.alpha'    => 'The last name may only contain letters.',
        ]);
    
        $role = Role::where('name' , 'Chairman')->first();
    
        $user = User::create([
            'role_id'	    => $role->id,
            'first_name'	=> request('first_name'),
            'last_name'  	=> request('last_name'),
            'contact_no'	=> request('contact_no'),
            'birthday'	     => request('birthday'),
            'address'	    => request('address'),
            'username'	    => request('username'),
            'email'	        => request('email'),
            'password'	    => bcrypt(request('password')),
        ]);
        
        return back()->with('success', 'New user has been successfully created!'); 
        
    }
    
    public function edit(User $chairman)
    {
        return view('users.edit', compact('chairman'));
    }
    
    public function show(User $chairman )
    {
        return view('users.show', compact('chairman'));
    }
    
    public function update(User $chairman, Request $request)
    {
        $request->merge(['contact_no' => '09'.$request->input('contact_no')]);
        $this->validate(request(), [
            'first_name'   => 'required|regex:/^[a-zA-Z\\x{00F1}\\s]+$/u',
            'last_name'    => 'required|regex:/^[a-zA-Z\\x{00F1}\\s]+$/u',           
            'contact_no'   => 'required|digits:11|numeric',
            'address'      => 'required',
            'birthday'          => 'required',
            'username'     => 'required|unique:users,username,'.$chairman->id.'|min:6',
            'password'     => ['nullable', 'regex:/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/'],
            'password_confirmation'  => ['nullable', 'regex:/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/'],
            'admin_password' => 'required|password',
        ],
        [
            'first_name.regex' => 'The first name field must contain only letters.',
            'last_name.regex' => 'The last name field must contain only letters.',
            'password_confirmation.regex' => 'The password confirmation does not match.',
            'contact_no.regex'=>'Please enter a valid contact number starting with 09.',
            'username.unique' => 'The username you entered is already taken.',
            'password.regex'  => 'The password must be at least 8 characters long and contain at least one uppercase and one lowercase letter.',
            'username.min' => 'The username must be at least 6 characters long.',
            'admin_password.password' => 'The admin password is incorrect.'          
        ]);
    
        // check if any changes have been made to the chairman's details
        if ($chairman->first_name === $request->first_name &&
            $chairman->last_name === $request->last_name &&
            $chairman->contact_no === $request->contact_no &&
            $chairman->address === $request->address &&
            $chairman->birthday === $request->birthday &&
            $chairman->email === $request->email &&
            $chairman->username === $request->username &&
            empty($request->password)
        ) {
            return redirect()->back()->with('warning', 'No changes were made to the user details.');
        }
    
        $chairman->update([
            'first_name'      	=> $request->first_name,
            'last_name'      	=> $request->last_name,
            'birthday'      		=> $request->birthday,
            'contact_no'    => $request->contact_no,
            'address'      	=> $request->address,
            'email' => $request->email,
            'username'     	=> $request->username,
            'password'      => $request->password ? bcrypt($request->password) : $chairman->password,
        ]);
    
        return redirect('/chairmans')->with('success', 'User information has been updated!');
    }
    
        public function destroy(User $chairman)
        {
    
            if ($chairman->id == 1 ) {
                return back()->with('warning', 'Doesnt removed!');
            }
    
            $chairman->delete();
            return back()->with('error', 'Chairman has been removed!');
        }

        public function send($chairmanId)
        {
            $chairman = User::find($chairmanId);
            $project = [
                'greeting' => 'Hi '.$chairman->first_name.',',
                'body' => 'Your account has been created successfully. Please login to your account based on these credentials 
                            Username: '.$chairman->username.'
                            Password: '.$chairman->password,
                'thanks' => 'Thank you, this is from Church Monitoring System Family',
                'actionText' => 'Log in to Your Profile',
                'actionURL' => url('/login'),
            ];
        
            Notification::route('mail', $chairman->email)->notify(new EmailNotification($project));
            
            dd('Notification sent!');
        }
        
    
}