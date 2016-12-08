<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\Role;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Role_controller extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('Roles.index');
    }

    /**
     * Get json Response of content page
     */
    public function getRollList() {
        //fetch sql data into arrays
        $data = DB::select("SELECT id as role_id,id,name,display_name,description from roles");

        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

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
        //echo $id;
        // echo "enter to the edit";
        //exit;

        $permissions_data = DB::table('permissions')->get();
        //echo "<pre>";
        //print_r($permissions_data);
        //exit;
        //
        //fetch setting data
        $data = DB::table('roles')->where('id', $id)->get();
        //echo "<pre>";
        //print_r($data);
        //exit;


        return view('Roles/edit', ['data' => $data, 'permissions_data' => $permissions_data]);
    }

    public function updateRoles(Request $request, $id) {

        //echo $id;
        $input = Request::all();

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
        return Redirect::to('Roles/update/'. $id);
//         echo "<pre>";
//         print_r($permissions_id);
//         exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $role = Request::only('id', 'name', 'display_name', 'description');
        $id = Request::segment(3);
        //echo $id;exit;
        $update = Role::where('id', $id)->update($role);
        if ($update == 1) {
            $update = 1;
        } else {
            $update = Role::create($role);
            //print_r($update);exit;
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
        $data = Role::where('id', $id)->delete();
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

}
