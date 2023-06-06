<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

     public function update(Request $request)
    {
        $this->validate(request(),[
            'first_name'                  => 'required|alpha',
            'last_name'                   => 'required|alpha',
            'name'                        => 'required',
            'age'                         => 'required',
            'address'                     => 'required',
            'contact_no'                  => 'required',
            'username'                    => 'required',
           
        ]);
        
        auth()->user()->update([
            'first_name'          => $request->first_name,
            'last_name'          => $request->last_name,
            'name'               => $request->name,
            'age'                => $request->age,
            'address'          => $request->address,
            'contact_no'          => $request->contact_no,
            'username'      => $request->username,
        ]);
        return redirect('/chairmans')->with('info', 'User has been changed!');

    }
}
