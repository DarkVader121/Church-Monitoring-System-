<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PhoneNumberController extends Controller
{
    public function index()
    {
        return view('update-phone.index');
    }

     public function update(Request $request)
    {
        $request->merge(['contact_no' => '09'.$request->input('contact_no')]);

        $this->validate(request(),[
            'contact_no'   => ['required', 'digits:11', 'numeric','regex:/^09/'],
        ]);
        
        auth()->user()->update([
            'contact_no'          => $request->contact_no,

        ]);

        return redirect('/update-phone')->with('info', 'The contact number has been changed!');

    }
}
