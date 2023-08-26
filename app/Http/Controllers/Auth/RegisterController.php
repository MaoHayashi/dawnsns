<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
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
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'username' => 'required|string|between:4,12',
            'mail' => 'required|string|email|between:4,12|unique:users',
            'password' => 'required|string|between:4,12|unique:users',
            'password-confirm' => 'required|string|between:4,12|same:password',
        ],
        [
            'username.required' => '必須項目です',
            'username.between' => '4文字以上12文字以内で入力してください',
            'mail.required' => '必須入力です',
            'mail.email' => 'メールアドレスではありません',
            'mail.between' => '4文字以上12文字以内で入力してください',
            'mail.unique' => '他のメールアドレスを入力してください',
            'password.required' => '必須入力です',
            'password.between' =>'4文字以上12文字以内で入力してください',
            'password.unique' => '他のパスワードを入力してください',
            'password.between' => '4文字以上12文字以内で入力してください',
            'password.unique' => '他のパスワードを入力してください',
            'password-confirm.required' => '必須入力です',
            'password-confirm' => 'パスワードと確認用パスワードが一致していません',
        ]
    );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            $validator = $this->validator($data);
            if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
            }
            $this->create($data);
            session()->put('username',$data['username']);
            return redirect('added');
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}
