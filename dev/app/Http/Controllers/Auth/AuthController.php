<?php

namespace App\Http\Controllers\Auth;

use Auth;
use DB;
use App\Http\Requests\loginRequest;
use App\User_model;
use App\Website_model;
use Validator;
use Session;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

use AuthenticatesAndRegistersUsers,
    ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth, User $user) {
        $this->user = $user;
        $this->auth = $auth;
        //$this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'first_name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        return User_model::create([
                    'first_name' => $data['first_name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'website_id' => $data['website_id'],
        ]);
    }

    /** Login Form
     * 
     * @return view
     */
    protected function loginForm() {

        $website = Website_model::lists('name', 'website_id');

        return View('User.login', ['website' => $website]);
    }

    /** Login 
     * 
     * @return dashboard
     */
    protected function login(loginRequest $request) {

        /*
          if($this->auth->attempt($request->only('email','password'))) {
          // get user data
          $emailaddress=$request->only('email');

          $email = $request->email;

          $password = $request->password;

          $website_id = $request->website_id;//exit;

          echo "SELECT * FROM `users` where email = '$email' and password ='$password' and FIND_IN_SET($website_id,website_id)";exit;
          $user = DB::select(DB::raw("SELECT * FROM `users` where email = '$email' and password = '$password' and FIND_IN_SET($website_id,website_id)"));
          //$user=DB::table('users')->where('email',$emailaddress['email'])->get();
          print_r($user);exit;
          // set session
          Session::put('id',$user[0]->id);
          Session::put('name',$user[0]->first_name);
          Session::put('website_id',$website_id);

          return redirect('dashboard');

          }
          return redirect('admin')->withErrors([
          'email' => 'Please enter a valid email address.',
          ]);
         * 
         */
        if ($this->auth->attempt($request->only('email', 'password'))) {

            $email = $request->email;
            $website_id = $request->website_id; //exit;

            $user = DB::select(DB::raw("SELECT * FROM `users` where email = '$email' and FIND_IN_SET($website_id,website_id)"));
            //$user=DB::table('users')->where('email',$emailaddress['email'])->get();
            //print_r($user);exit;
            if(count($user) !=0){
            // set session 
            Session::put('id', $user[0]->id);
            Session::put('name', $user[0]->first_name);
            Session::put('email', $email);
            Session::put('website_id', $website_id);

            return redirect('dashboard');
            }
            else
            {
                return redirect('admin')->withErrors([
                        'email' => 'You do not have permission to access.',
                ]);
            }
        } else {
            //to do
            return redirect('admin')->withErrors([
                        'email' => 'Please enter a valid email address.',
            ]);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return Response
     */
    protected function logout() {
        $this->auth->logout();
        // session destroy
        Session::forget('id');

        return redirect('admin');
    }

}
