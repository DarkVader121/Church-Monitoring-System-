<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Role;
class PfcController extends Controller
{
    public function index()
    {
    	$pfcs = User::where('role_id', 5)->get();
    	return view('pfc.index', compact('pfcs'));
    }
	public function disable(User $pfc)
    {
		$this->validate(request(), 
        [    'admin_password' => 'required|password',],
         [    'admin_password.password' => 'The admin password is incorrect.',]);

        $pfc->update([
            'disabled' => true,
        ]);
       
        return redirect('/pfc')->with('success', 'PFC has been disabled!');
    }

    public function enable(User $pfc)
	{
		$this->validate(request(), 
        [    'admin_password' => 'required|password',],
         [    'admin_password.password' => 'The admin password is incorrect.',]);

		$pfc->update([
			'disabled'      	=> '0',
		]);
	
		return redirect('/pfc')->with('success', 'PFC  has been enabled!');
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

    	$role = Role::where('name' , 'PFC')->first();

    	$user = User::create([
    		'role_id'	=> $role->id,
    		'first_name'	=> request('first_name'),
			'last_name'	=> request('last_name'),
    		'contact_no'	=> request('contact_no'),
    		'birthday'	=> request('birthday'),
    		'address'	=> request('address'),
    		'username'	=> request('username'),
    		'password'	=> bcrypt(request('password')),
    	]);

    	return back()->with('success', 'New user has been added!');
    }


    public function edit(User $pfc)
    {
    	return view('pfc.edit', compact('pfc'));
    }


   public function update(User $pfc , Request $request)
    {
		$request->merge(['contact_no' => '09'.$request->input('contact_no')]);
		$this->validate(request(), [
            'first_name'   => 'required|regex:/^[a-zA-Z\\x{00F1}\\s]+$/u',
            'last_name'    => 'required|regex:/^[a-zA-Z\\x{00F1}\\s]+$/u',   
			'contact_no'   => 'required|digits:11|numeric',
			'address'      => 'required',
			'age'          => 'required|numeric',
			'username'     => 'required|unique:users,username,'.$pfc->id.'|min:6',
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
		if ($pfc->first_name === $request->first_name &&
			$pfc->last_name === $request->last_name &&
			$pfc->contact_no === $request->contact_no &&
			$pfc->address === $request->address &&
			$pfc->age === $request->age &&
			$pfc->username === $request->username &&
			empty($request->password)
		) {
			return redirect()->back()->with('warning', 'No changes were made to the user details.');
		}
		$role = Role::where('name' , 'PFC')->first();


    	$pfc->update([
    		'role_id'	    => $role->id,
    		'first_name'		    => request('first_name'),
			'last_name'		    => request('last_name'),
    		'contact_no'	=> request('contact_no'),
    		'address'		=> request('address'),
    		'age'		    => request('age'),
    		'username'	    => request('username'),
    	]);

    	return redirect('/pfc')->with('info', 'PFC has been added!');

    }

    public function show(User $pfc)
    {
    	return view('pfc.show', compact('pfc'));
    }

    public function destroy(User $pfc)
    {
    	$pfc->delete();

    	return back()->with('error', 'PFC has been removed!');
    }
}