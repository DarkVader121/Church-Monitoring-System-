<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class ParishPriestController extends Controller
{
    public function index()
    {
    	$priests  = User::where('role_id', '2')->get();
    	return view('parish-priest.index', compact('priests'));
    }
	public function disable(User $priest)
    {
		$this->validate(request(), 
        [    'admin_password' => 'required|password',],
         [    'admin_password.password' => 'The admin password is incorrect.',]);

        $priest->update([
            'disabled' => true,
        ]);
       
        return redirect('/parish-priest')->with('success', 'priest has been disabled!');
    }

    public function enable(User $priest)
	{
		$this->validate(request(), 
		[    'admin_password' => 'required|password',],
		[    'admin_password.password' => 'The admin password is incorrect.',]);

		$priest->update([
			'disabled'      	=> '0',
		]);
	
		return redirect('/parish-priest')->with('success', 'priest has been enabled!');
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

	  $role = Role::where('name' , 'Parish Priest')->first();

	User::create([
		'role_id'	    => $role->id,
		'first_name'	=> request('first_name'),
		'last_name'  	=> request('last_name'),
		'contact_no'	=> request('contact_no'),
		'birthday'	        => request('birthday'),
		'address'	    => request('address'),
		'username'	    => request('username'),
		'password'	    => bcrypt(request('password')),
	]);

	return back()->with('success', 'New user has been added!'); 
}

public function edit(User $priest)
{
	return view('parish-priest.edit', compact('priest'));
}

public function update(User $priest , Request $request)
{
	$request->merge(['contact_no' => '09'.$request->input('contact_no')]);
	$this->validate(request(), [
	'first_name'   => 'required|regex:/^[a-zA-Z\\x{00F1}\\s]+$/u',
	'last_name'    => 'required|regex:/^[a-zA-Z\\x{00F1}\\s]+$/u',   
	'contact_no'   => 'required|digits:11|numeric',
	'address'      => 'required',
	'age'          => 'required|numeric',
	'username'     => 'required|unique:users,username,'.$priest->id.'|min:6',
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

	// check if any changes have been made to the parish-priest's details
	if ($priest->first_name === $request->first_name &&
	$priest->last_name === $request->last_name &&
	$priest->contact_no === $request->contact_no &&
	$priest->address === $request->address &&
	$priest->age === $request->age &&
	$priest->username === $request->username &&
	empty($request->password)
) {
	return redirect()->back()->with('warning', 'No changes were made to the user details.');
}


	$priest->update([
		'first_name'    => $request->first_name,
		'last_name'     => $request->last_name,
		'age'      		=> $request->age,
		'contact_no'    => $request->contact_no,
		'address'      	=> $request->address,
		'username'     	=> $request->username,
		'password'      => $request->password ? bcrypt($request->password) : $priest->password,
	]);

	return redirect('/parish-priest')->with('info', 'User information has been updated!');

}

public function show(User $priest)
{
	return view('parish-priest.show', compact('priest'));
}

public function destroy(User $priest)
{
	$priest->delete();

	return back()->with('error', 'Priest has been removed!');
}
}