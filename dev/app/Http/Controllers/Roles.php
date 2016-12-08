<?php

/**
 * @access          :   public
 * @description     :   Role
 * @author          :   Pradip valand. <pradip@iwebsquare.com>
 * @created date    :   7th Nov, 2016
 * @updated date    :   11th Nov, 2016
 * @created By      :   Pradip valand.
 * @updated By      :   Swati D.
 * @version         :   0.1
 */

namespace App\Http\Controllers;

use Request;
use DB;
use App\Role;
use App\Website_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Roles extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        //get website data 
        $website_data = get_website_data();

        //get session
        if (Session::has('website_id')) {

            //fetch user name from session
            $web = Session::get('website_id');
        }
        
        //get Role data
        $data = Role::all();

        //return list
        return view('Roles/index', ['data' => $data, 'website_data' => $website_data, 'web' => $web]);
    }

    /**
     * Get json Response of content page
     */
    public function getRoleList() {

        //get session
        if (Session::has('website_id')) {

            //fetch user name from session
            $web = Session::get('website_id');
        }

        //select query to get data inside the row
        $data = DB::select("SELECT id, id as role_id_tmp,id as permission_id_tmp,name, display_name FROM roles where website_id=" . $web);

        //json data
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    public function set_website() {
        // get website id
        $website_id = Request::segment(3);
        //echo $website_id;
        //exit;
        //   //echo $website_id;exit;
        // set session variable of website id
        set_website_id($website_id);

        return redirect(url('/') . '/Roles');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        /*** ************************************************** */
        /*** ***************WEBSITE ID START******************* */
        /*** ************************************************** */
        
        //fetch tag data from its table
        $web_data = DB::table('website')->get();

        //define array
        $website_array = array();

        //fetch website id in array
        foreach ($web_data as $webdata) {

            //web data in array
            $website_array[$webdata->website_id] = $webdata->name;
        }

        /*** ************************************************** */
        /*** ***************WEBSITE ID END********************* */
        /*** ************************************************** */
        //load view
        return view('Roles/create', ['website_array' => $website_array]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        //make rules
        $rules = array(
            'name' => 'required',
        );
        //check validation
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            
            return Redirect::to('Roles/create')->withErrors($validator);
            
        } 
        else {

            //get data from post
            $role = Request::all();

            //fetch website_id
            $website_id = $role['website_id'];
            
            foreach ($website_id as $id) {
                
                $role['website_id'] = $id;
                Role::create($role);
            }

            // redirect
            Session::flash('message', 'Record created successfully  !');
            return Redirect::to('Roles/create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        
        $data = Role::find($id);

        return view('Roles/update', [ 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
     
        // validate
        $rules = array(
            'name' => 'required'
        );

        //check validation
        $validator = Validator::make(Request::all(), $rules);

        // if validation fails
        if ($validator->fails()) {
            return Redirect::to('Roles/' . $id . '/edit')
                            ->withErrors($validator);
        } else {

            //fetch post data
            $role_data = Request::except(array('_method', '_token'));

            //update Role category data
            Role::where('id', $id)->update($role_data);

            // redirect
            Session::flash('message', 'Record updated successfully !');
            return Redirect::to('Roles/' . $id . '/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
        //fetch the data spotlight by id
        DB::table('roles')->where('id', $id)->delete();

        //redirect the  listing page
        return redirect('Roles ')->withMessage('Data Delete Successfully');
    }

    public function permissionEdit($id) {
        
        //get the permssion role where role match
        $permission_role = DB::table('permission_role')->select('permission_id')->where('role_id', $id)->get();

        //define array
        $tmp = array();

        foreach ($permission_role as $key => $value) {

            $tmp[] = $value->permission_id;
        }

        $permission_role = $tmp;
        
        if (Session::has('website_id')) {

            //fetch user name from session
            $website_id = Session::get('website_id');
        }

        //get all permission data    
        $permissions_data = DB::table('permissions')->where('website_id',$website_id)->get();
        
        //print_r($permissions_data);exit;

        //fetch setting data
        $data = DB::table('roles')->where('id', $id)->get();

        return view('Roles/edit', ['data' => $data, 'permissions_data' => $permissions_data, 'permission_role' => $permission_role]);
    }

    //Update roles
    public function updateRoles(Request $request, $id) {

        //get data from post
        $input = Request::all();

        //empty value of permssion
        if (empty($input['permissions_id'])) {
            DB::table('permission_role')->where('role_id', $id)->delete();
        }

        //permission id 
        if (isset($input['permissions_id'])) {
            $data['permission_id'] = $input['permissions_id'];

            $getdata = DB::table('permission_role')->where('role_id', $id)->get();

            if ($getdata != '') {
                DB::table('permission_role')->where('role_id', $id)->delete();
            }

            foreach ($data['permission_id'] as $per_id) {

                $data['permission_id'] = $per_id;
                $data['role_id'] = $id;
                $insert = DB::table('permission_role')->insert($data);
            }
        }
        return Redirect::to('Roles/update/' . $id)->withMessage('Permission Updated successfully');
    }

}
