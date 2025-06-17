<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\UsrLog;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \Illuminate\Http\Request;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    function authenticated(Request $request, $user)
    {
        Auth::logoutOtherDevices(request(key:'password'));
        $user->update([
            'last_login_time' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp(),
            'user_department' =>gethostname(),
        ]);
        $data = array(
            'user_id'=>auth()->user()->id."-".auth()->user()->name,
            'login_ip'=>$request->getClientIp(),
            'login_date'=>Carbon::now()->toDateTimeString(),
            'attribute1' =>gethostname()."/".getenv("username"),
        );
        UsrLog::create($data);
    }
}
