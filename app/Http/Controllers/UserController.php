<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;

class UserController extends Controller
{
    public function profile()
    {
    	return view('user.profile');
    }

    public function updateProfile( Request $request) 
    {
    	$validator = Validator::make($request->all(), [
    		'email' => 'required|email'
    	], [
    		'email.email' => 'Email không hợp lệ',
    		'fullname.required' => 'Tên là trường bắt buộc',

    	]);

    	if ($validator->fails()) {
    		return back()->withErrors($validator)->withInput();
    	}

    	$user = Auth::user();
    	$fullname = $request->input('fullname');
    	$email = $request->input('email');

    	$user->fullname = $fullname;
    	$user->email = $email;

    	 $user->save();
    	 return back();
    }


    public function password()
    {
    	return view('user.password');
    }

    public function updatePassword( Request $request) 
    {
    	$validator = Validator::make($request->all(), [
    		'password' => 'required',
    		'pass_new' => 'required|min:3|max:25',
    		'confirm_pass' => 'required|same:pass_new'
    	], [
    		'password.required' => 'Mật khẩu không đúng',
    		'pass_new.size' => 'Mật khẩu min 3 kí tự , max 25 kí tự ',
    		'confirm_pass.required' => 'Mật khẩu không đúng'

    	]);

    	if ($validator->fails()) {
    		return back()->withErrors($validator)->withInput();
    	}

    	$password = $request->input('password');

    	if(!Hash::check($password, Auth::user()->password))
    	{
    		return back()
    		  ->withError('Mật khẩu cũ không chính xác');
    	};

        Auth::user()->password = bcrypt($request->input('pass_new'));

    	Auth::user()->save();
    	  return back()
          -> withSuccess('Thay đổi thành công');
    }
}
