<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserInfo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/after-registration';

    private $email = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $confirmCode = rand(1000000, 999999999);

        $user = new User();
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->confirm_code = $confirmCode;
        $user->balance = 10000;
        $user->save();

        $this->email = $data['email'];
        Mail::send('confirm-email', [
            'confirmCode' => $confirmCode, 'userId' => $user->id
        ], function ($m) {
            $m->subject('Подтверждение регистрации');
            $m->from('partylivea@gmail.com', 'puzzles');
            $m->to($this->email, $this->email);
        });

        $userInfo = new UserInfo;
        $userInfo->user_id = $user->id;
        $userInfo->save();

        return $user;
    }

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();

        return redirect($this->redirectPath())
        ->withSuccess('Thanks for registration! The password has been sent to your email.');
    }
}
