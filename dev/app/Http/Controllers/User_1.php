<?php

namespace App\Http\Controllers;

use Request;
use DB;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\User_model;
use App\Website_model;
use App\Role;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class User extends Controller {

    public function __construct() {
        if (Session::get('id') == '') {
            //Redirect::to('admin')->send();
        }
    }

    /*
     * list Users
     */

    public function index() {
       
        return view('User.index');
    }

    /*
     * get user data
     */

    public function getUser() {
        $data = DB::table('users')->select('*', 'id as id_tmp')->get();
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /*
     * Add user form
     */

    public function create() {

        $user_create = Website_model::lists('name', 'website_id');
        $user_role = Role::where('website_id', 1)->lists('name', 'id');
        //print_r($user_role);exit;
        $user_role1 = Role::where('website_id', 2)->lists('name', 'id');
        //print_r($user_role1);exit;   
        return view('User.create', ['user_create' => $user_create, 'user_role' => $user_role, 'user_role1' => $user_role1]);
    }

    /*
     * Add user
     */

    public function store(Request $request) {
        //return filled form
        Input::flash();
        $user = Request::all();
        //print_r($user);exit;
        //validation
        $rules = array(
            "email" => "required|email|unique:users,email",
            'password' => 'required|min:6',
            'website_id'=>'required',
        );
        
        $message = array(
            'website_id.required' => 'The Website field is required.',
        );

        $validator = Validator::make($user, $rules,$message);

        //store
        if ($validator->fails()) {
            //echo "dfss";exit;
            return redirect('user/add')->withErrors($validator);
        } else {

            $boces_role_id = $user['boces_role_id'];
            $role_boces_data = explode(" ", $boces_role_id);

            $cte_role_id = $user['cte_role_id'];
            $role_cte_data = explode(" ", $cte_role_id);
            //echo $data1;exit;
            $data = array_merge($role_boces_data, $role_cte_data);
            $user['password'] = bcrypt($user['password']);

            if (isset($user['website_id'])) {

                $user['website_id'] = implode(",", $user['website_id']);
            }

            User_model::create($user);
            //get last insert id
            $id = DB::getPdo()->lastInsertId();
            //insert user_role table
            foreach ($data as $k => $v) {

                DB::insert('insert into role_user (user_id, role_id) values (?, ?)', array($id, $v));
            }
            //echo $id;exit;
            //redirect & message
            session()->flash('msg', 'User Created Successfully');

            return redirect('user');
        }
    }

    /*
     * update user form
     */

    public function edit($id) {
      
        $user = User_model::find($id);

        $user_update = Website_model::lists('name', 'website_id');
        //print_r($user_update);exit;
        $website = DB::table('website')->get();
       //fetch location data from location tabe
        $role =  Role::where('website_id', 1)->lists('name', 'id')->all();
        $cte_role =  Role::where('website_id', 2)->lists('name', 'id')->all();
        //print_r($role);exit;
        
        

        return view('User.edit', ['user' => $user, 'website' => $website,'role'=> $role,'cte_role'=>$cte_role]);
    }

    /*
     * update user
     */

    public function update($id, Request $request) {
        $user = Request::except('_token');
        if ($user['password'] == "") {
            $user = Request::except('password', '_token');
        } else {
            $user['password'] = bcrypt($user['password']);
        }
        //validation
        $rules = array(
            "email" => "required|email",
        );

        $validator = Validator::make($user, $rules);

        if ($validator->fails()) {

            return redirect('user/edit/' . $id)->withErrors($validator);
        } else {
              $boces_role_id = $user['boces_role_id'];
              $role_boces_data = explode(" ", $boces_role_id);
              
              $cte_role_id = $user['cte_role_id'];
              $role_cte_data = explode(" ", $cte_role_id);
             //echo $data1;exit;
             $data = array_merge($role_boces_data, $role_cte_data);
            if (isset($user['website_id'])) {

                $user['website_id'] = implode(",", $user['website_id']);
            }

            User_model::where('id', $id)->update($user);
            DB::table('role_user')->where('user_id', $id)->delete();
            //insert user_role table
            foreach ($data as $k => $v) {

                DB::insert('insert into role_user (user_id, role_id) values (?, ?)', array($id, $v));
            }
//            DB::statement('insert into role_user(user_id,role_id) values ' . $values);
            session()->flash('msg', 'Record Updated Successfully');
            return redirect('user/edit/' . $id);
        }
    }

    /*
     *  delete user
     */

    public function destroy($id) {

        //delete data
        DB::table('users')->where('id', $id)->delete();

        //set falsh message for successful deletion
        Session::flash('message', 'Record Deleted Successfully!');

        //redirect to list
        return redirect('user');
    }

    /**
     * 
     * show forgot password 
     */
    public function forgot_password() {
        return view('User.forgot_password');
    }

    /**
     * check validate - forgot user
     */
    function check_forgot_password(Request $request) {

        //set email 
        $email = Request::all();

        $encrypted_email = Crypt::encrypt($email['email']);

        $rules = array('email' => 'required|email');

        $message = array(
            'email.required' => 'The Email field is required',
        );
        // validate email address
        $validator = Validator::make($email, $rules, $message);

        if ($validator->fails()) {
            return redirect('forgot_password')->withErrors($validator);
        } else {
            //check email address in database
            $email_data = DB::table('users')->where('email', $email['email'])->get();
            //if email existing
            if ((count($email_data)) > 0) {

                //redirect
                return view('User/forgot_pass', ['encrypted_email' => $encrypted_email]);
            } else {
                // incorrect email
                return redirect('forgot_password');
            }
        }
    }

    /**
     * change password
     */
    function change_password(Request $request) {
        $email = Request::segment(2);
        $decode_email_id = Crypt::decrypt($email);
        $password = Request::all();
        $pass = bcrypt($password['password']);
        $rules = array('password' => 'required|min:6|same:cnfrm_password',
            'cnfrm_password' => 'required|min:6');

        $validator = Validator::make($password, $rules);
        if ($validator->fails()) {
            return view('User/forgot_pass', ['encrypted_email' => $email])->withErrors($validator);
        } else {

            User_model::where('email', $decode_email_id)->update(array('password' => $pass));
            return redirect('admin');
            //$update=DB::table('users')->where('email',$decode_email_id)->update('password'=>$password['password']);
        }
    }

    public function view_profile($id) {
        //Session value get
        $data = DB::select("select * from users where id=" . $id);

        return view('user/viewprofile', ['data' => $data]);
    }

}
