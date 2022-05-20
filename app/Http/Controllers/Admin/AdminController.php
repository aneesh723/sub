<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;

class AdminController extends Controller
{
    //

    public function dashboard()
    {
        return view('admin.dashboard');
    }
    
    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginSubmit(Request $request)
    {
        $rules = [
            'email' => ['required',],
            'password' => ['required']
        ];

        $msg =  Validator::make($request->all(), $rules);
        if ($msg->fails()) {
            // $this->sendResponse(false,$msg->errors()->first());
            return response()->json(['status' => false, 'msg' => $msg->errors()->first()]);
        }

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['status' => true, 'msg' => 'successfully login']);
        }
        return response()->json(['status' => false, 'msg' => 'Credentials Does Not Match', 'data' => $request->all()]);
    }



    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }



}
