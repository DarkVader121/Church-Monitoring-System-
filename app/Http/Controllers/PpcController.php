<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class PpcController extends Controller
{
    public function index()
    {
    	$ppcs = User::where('role_id', 4)->get();

    	return view('ppc.index', compact('ppcs'));
    }

	public function disable(User $ppc)
    {
		$this->validate(request(), 
        [    'admin_password' => 'required|password',],
         [    'admin_password.password' => 'The admin password is incorrect.',]);

        $ppc->update([
            'disabled' => true,
        ]);
       
        return redirect('/ppc')->with('success', 'PPC has been disabled!');
    }

    public function enable(User $ppc)
	{
		$this->validate(request(), 
        [    'admin_password' => 'required|password',],
         [    'admin_password.password' => 'The admin password is incorrect.',]);

		$ppc->update([
			'disabled'      	=> '0',
		]);
	
		return redirect('/ppc')->with('success', 'PPC  has been enabled!');
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

    	$role = Role::where('name' , 'PPC')->first();

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


    public function edit(User $ppc)
    {
    	return view('ppc.edit', compact('ppc'));
    }


   

    public function show(User $ppc)
    {
    	return view('ppc.show', compact('ppc'));
    }


  	public function update(User $ppc, Request $request)
    {
		$request->merge(['contact_no' => '09'.$request->input('contact_no')]);
		$this->validate(request(), [
            'first_name'   => 'required|regex:/^[a-zA-Z\\x{00F1}\\s]+$/u',
            'last_name'    => 'required|regex:/^[a-zA-Z\\x{00F1}\\s]+$/u',   
			'contact_no'   => 'required|digits:11|numeric',
			'address'      => 'required',
			'birthday'          => 'required',
			'username'     => 'required|unique:users,username,'.$ppc->id.'|min:6',
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
		if ($ppc->first_name === $request->first_name &&
			$ppc->last_name === $request->last_name &&
			$ppc->contact_no === $request->contact_no &&
			$ppc->address === $request->address &&
			$ppc->birthday === $request->birthday &&
			$ppc->username === $request->username &&
			empty($request->password)
		) {
			return redirect()->back()->with('warning', 'No changes were made to the user details.');
		}
 
    	$role = Role::where('name' , 'PPC')->first();

    	$ppc->update([
    		'role_id'	    => $role->id,
    		'first_name'		    => request('first_name'),
			'last_name'		    => request('last_name'),
    		'contact_no'	=> request('contact_no'),
    		'address'		=> request('address'),
    		'birthday'		    => request('birthday'),
    		'username'	    => request('username'),
    	]);

    	return redirect('/ppc')->with('info', 'User Information has been updated!');
    }


    public function destroy(User $ppc)
    {
    	$ppc->delete();

    	return back()->with('error', 'PPC has been removed!');
    }
}