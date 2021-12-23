<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;


class AdminLoginController extends Controller
{
  use AuthenticatesUsers;

  
  public function __construct()
    { 
      // $this->middleware('guest')->except('logout');
    }
    
    public function showLoginForm()
    { 
      if(Auth::guard('admin')->user()){
        return redirect()->route('admin.admin');
      } 
      return view('auth.admin-login');
    }

    public function login(Request $request)
    { 
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);

      // Attempt to log the user in
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
       
        return redirect()->intended(route('admin.admin'));
      }

      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email', 'remember'));
    }
    public function logout(Request $request)
    {  
     
        Auth::guard('admin')->logout();
        return $this->loggedOut($request) ?: redirect()->route('admin.login');
        /*return $this->loggedOut($request) ?: redirect()->route('admin.login');*/
    }
}
