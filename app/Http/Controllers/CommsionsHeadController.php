<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
class CommsionsHeadController extends Controller
{
    public function index()
    {
    	$commissions = User::where('role_id', 3)->get();
    	return view('commission-head.index', compact('commissions'));
    }

   public function disable(User $chairman)
    {
		$this->validate(request(), 
        [    'admin_password' => 'required|password',],
         [    'admin_password.password' => 'The admin password is incorrect.',]);

        $chairman->update([
            'disabled' => true,
        ]);
       
        return redirect('/commission-heads')->with('success', 'Commision Head has been disabled!');
    }

    public function enable(User $chairman)
	{
		$this->validate(request(), 
        [    'admin_password' => 'required|password',],
         [    'admin_password.password' => 'The admin password is incorrect.',]);

		$chairman->update([
			'disabled'      	=> '0',
		]);
	
		return redirect('/commission-heads')->with('success', 'Commision Head  has been enabled!');
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

    	$role = Role::where('name' , 'Commission Head')->first();

    	$user = User::create([
    		'role_id'	=> $role->id,
    		'first_name'	=> request('first_name'),
			'last_name'	     => request('last_name'),
    		'contact_no'	=> request('contact_no'),
    		'birthday'	        => request('birthday'),
    		'address'	    => request('address'),
    		'username'	    => request('username'),
    		'password'   	=> bcrypt(request('password')),
    	]);

    	return back()->with('success', 'New user has been successfully created!');
    }

    public function edit(User $commission_head)
    {
    	return view('commission-head.edit', compact('commission_head'));
    }

    public function update(User $commission_head, Request $request)
    {
		$request->merge(['contact_no' => '09'.$request->input('contact_no')]);
		$this->validate(request(), [
            'first_name'   => 'required|regex:/^[a-zA-Z\\x{00F1}\\s]+$/u',
            'last_name'    => 'required|regex:/^[a-zA-Z\\x{00F1}\\s]+$/u',   
			'contact_no'   => 'required|digits:11|numeric',
			'address'      => 'required',
			'age'          => 'required|numeric',
			'username'     => 'required|unique:users,username,'.$commission_head->id.'|min:6',
			'password'     => ['nullable', 'regex:/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/'],
			'password_confirmation'  => ['nullable', 'regex:/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/'],
			'admin_password' => 'required|password',
		],
		[
			'first_name.regex' => 'The first name field must contain only letters.',
			'last_name.regex' => 'The last name field must contain only letters.',
			'password_confirmation.regex' => 'The password confirmation does not match.',
			'username.unique' => 'The username you entered is already taken.',
			'contact_no.regex'=>'Please enter a valid contact number starting with 09.',
			'password.regex'  => 'The password must be at least 8 characters long and contain at least one uppercase and one lowercase letter.',
			'username.min' => 'The username must be at least 6 characters long.',
			'admin_password.password' => 'The admin password is incorrect.'          
		]);
		// check if any changes have been made to the commission_head's details
		if ($commission_head->first_name === $request->first_name &&
        $commission_head->last_name === $request->last_name &&
        $commission_head->contact_no === $request->contact_no &&
        $commission_head->address === $request->address &&
        $commission_head->age === $request->age &&
        $commission_head->username === $request->username &&
        empty($request->password)
    ) {
        return redirect()->back()->with('warning', 'No changes were made to the user details.');
    }

        $commission_head->update([

			'first_name'      	=> $request->first_name,
			'last_name'      	=> $request->last_name,
			'age'      		=> $request->age,
			'contact_no'    => $request->contact_no,
			'address'      	=> $request->address,
			'username'     	=> $request->username,
			'password'      => $request->password ? bcrypt($request->password) : $commission_head->password,
            
        ]);

        return redirect('/commission-heads')->with('info', 'User information has been updated!');

    }

    public function show(User $commission_head)
    {
    	return view('commission-head.show', compact('commission_head'));
    }

    public function destroy(User $commission_head)
    {
    	$commission_head->delete();

    	return back()->with('error', 'Commission Head has been removed!');
    }
}