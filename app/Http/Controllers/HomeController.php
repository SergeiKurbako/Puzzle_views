<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()) {
            return redirect('logout');
        }

        return view('home');
    }

    public function confirmEmail(Request $request)
    {
        $userId = $request->input('user_id');
        $confirmCode = $request->input('confirm_code');

        $user = User::find($userId);

        if ($user->confirm_code === $confirmCode) {
            $user->role = 'user';
            $user->save();
        }

        return view('after-confirm');
    }

    public function afterRegistration()
    {
        return view('after-registration');
    }

    public function testSms()
    {
        file_get_contents('https://smsc.ru/sys/send.php?login=webwidgets&psw=12345Qaz&phones=+375291271825&mes=3333');

        return 'done';
    }

    public function waitConfirm()
    {
        return view('wait-confirm');
    }
}
