<?php

/**
 * @access          :   public
 * @description     :   User Permission
 * @author          :   Pradip valand. <pradip@iwebsquare.com>
 * @created date    :   21th september, 2016
 * @updated date    :   
 * @created By      :   Pradip valand.
 * @version         :   0.1
 */

namespace App\Http\Controllers;

use App\Permission;
use DB;
use Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Session;
use App\Http\Requests;


class User_permission extends Controller {

    public function __construct() {
        if (Session::get('id') == '') {
            Redirect::to('admin')->send();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //return list
        return view('User_permission.index_permission');
    }

    /**
     * Get json Response of content page
     */
    public function getPermissionList() {
        
        if (Session::has('website_id')) {

            //fetch user name from session
            $website_id = Session::get('website_id');
        }

        //fetch sql data into arrays
        $data = DB::select("SELECT p.* FROM `permissions` p where website_id = '$website_id' order by ID");

        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if (Permission::create()) {
            $data = 1;
        } else {
            $data = 0;
        }
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //request 
        $user_permission = Request::only('id','name','display_name','description','website_id');
        $id = Request::segment(3);
        //update data or create the data
        $update = Permission::where('id', $id)->update($user_permission);
        if ($update == 1) {
            $update = 1;
        } else {
            $update = Permission::create($user_permission);
        }
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($update) . "}";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $id = Request::segment(3);
        //fetch the data by id
        $data = Permission::where('ID', $id)->delete();
        //send json format data
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

}
