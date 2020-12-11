<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;

class AuthController extends Controller
{
   public function login()
   {
   	return view('login');
   }

   public function submitLogin (Request $request)
   {
	   $email = $request->input('email');
	   $password = $request->input('password');
	   //dd($username, $password);
	   if (Auth::attempt ([
	   	   'password' => $password,
	   	   'email'  => $email
	   ])) {
   	    return redirect()
   	      ->route('dashboard');
	   }else {
	      return back()
	        ->withError('Tên tài khoản không chính xác');
	   }
   }
   public function logout()

   {
   	Auth::logout();
   	   return redirect()->route('auth.login');
   }
   public function register()
   {
   	return view('register');
   }
   public function submitRegister (Request $request)
   {
      $validator = Validator::make($request->all(), [
         'fullname' => 'required',
         'email' => 'required|email',
         'password' => 'required'
      ], [
         'fullname.required' => 'Tên là trường bắt buộc',
         'email.email' => 'Email không hợp lệ',
         'password.required' => 'bắt buộc'
      ]);

      if ($validator->fails()) {
         return back()->withErrors($validator)->withInput();
      }

   	$sql = DB::table('users')->where('email',$request->email)->first();

 	   if (!$sql) {
 	  	   $user = new User();
		    $user->fullname = $request->fullname;
		    $user->role = $request->role;// phichs cunwgs laf 1 admin;
		    $user->email= $request->email;
		    $user->password = $request->password;
		    $user->save();
		    return redirect()
              ->route('auth.login')
              ->withSuccess('request success');
	    
 	    } else {
 	    	  return back()
 	   	      ->withError('Tên tài khoản đã tồn tại');
 	    }


   }
}
