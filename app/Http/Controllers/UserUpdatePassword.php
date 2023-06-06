<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UserUpdatePassword extends Controller
{
    public function index()
    {
        return view('change-password.index');
    }

    public function update(Request $request)
    {
        $this->validate(request(), [
            'current_password' => 'required',
            'password' => 'required_if:password,value|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])/u',
            'password_confirmation' => 'required_if:password,value',
        ], [
            'password.regex' => 'The password must be at least 8 characters and contain at least 1 uppercase and 1 lowercase letter.',
        ]);
    
        if (!\Hash::check($request->current_password, auth()->user()->password)) {
            return redirect('/change-password')->with('error', 'The current password is incorrect');
        }
    
        if ($request->password != $request->password_confirmation) { 
            return redirect('/change-password')->with('error', 'The new password and confirmation password do not match');
        }
    
        auth()->user()->update([
            'password' => bcrypt(request('password'))
        ]);
    
        return redirect('/chairmans')->with('info', 'Your password has been changed.');
    }
    
}    