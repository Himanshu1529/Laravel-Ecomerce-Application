<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use Auth;
class AuthController extends Controller
{
    public function login_admin()
    {
    	if(!empty(Auth::check()) && Auth::user()->is_admin == 1)
    	{
    		return redirect('admin/dashboard');
    	}
    	return view('admin.auth.login');
    }

    public function auth_login_admin(Request $request)
    {
    	$remember = !empty($request->remember) ? true : false;
    	if(Auth::attempt(['email' => $request->email,'password'=>$request->password,'is_admin' => 1, 'status' => 0,'is_delete' => 0], $remember))
    	{
    		return redirect('admin/dashboard');
    	}
    	else
    	{
    		return redirect()->back()->with('error',"Please Enter Correct Email And Password !");
    	}
    }


    public function logout_admin(Request $request)
    {
    	Auth::logout();
    	return redirect('admin');
    }

    public function auth_register(Request $request)
    {
        $checkEmail = User::checkEmail($request->email);

        if(empty($checkEmail))
        {
            $save = new User;
            $save->name = trim($request->name);
            $save->email = trim($request->email);
            $save->password = Hash::make($request->password);
            $save->save();


            $json['status'] = true;
            $json['message'] = "Your Account has been Created Successfully !";
        }
        else{
            $json['status'] = false;
            $json['message'] = "This Email has been Already Registered";
        }
        echo json_encode($json);
    }
    
}
