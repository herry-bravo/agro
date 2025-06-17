<?php

namespace App\Http\Controllers\Admin;

use App\RequisitionDetail;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class HomeController
{
    public function index(Request $request)
    {   
        $data="";
        return view('admin.home.index', compact('data'));
    }

    public function register(Request $request){

        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->user_status = 0;
        $user->save();

        return view('auth.login');
            
    }
}
