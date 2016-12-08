<?php

/**
 * @access          :   public
 * @description     :   Redirect url
 * @author          :   Pradip valand. <pradip@iwebsquare.com>
 * @created date    :   6th september, 2016
 * @updated date    :   
 * @created By      :   Pradip valand.
 * @version         :   0.1
 */

namespace App\Http\Controllers;

use Request;
use DB;
use App\Redirect_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Redirect_url extends Controller {

    public function __construct() {
        if (Session::get('id') == '') {
            Redirect::to('admin')->send();
        }
        //apply permission for boces website
        if(Session::get('website_id') == 1){
            
        $this->middleware('auth');
        $this->middleware('permission:redirect-url-create', ['only' => ['create']]);
        $this->middleware('permission:redirect-url-edit',   ['only' => ['edit']]);
        $this->middleware('permission:redirect-url-list',   ['only' => ['show', 'index']]);
        $this->middleware('permission:redirect-url-delete',   ['only' => ['destroy']]);
        
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //get data from redirect model
        $data = Redirect_model::all();
        //print_r($data);
        //return list
        return view('Redirect/list', ['data' => $data]);
    }

    /**
     * Get json Response of content page
     */
    public function getRedirectList() {

        //fetch sql data into arrays
        $data = DB::select("SELECT redirect_id, redirect_id as redirect_id_tmp, source_url, target_url FROM `redirect`");
        //json data
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //load view
        return view('Redirect/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //request for flashing the data on failed validation
        Request::flash();

        //make rules
        $rules = array(
            'source_url' => 'required',
            'target_url' => 'required'
        );

        //validation
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('Redirect_url/create')
                            ->withErrors($validator);
        } else {
            //get data from post
            $url_data = Request::all();
            //print_r($url_data);exit;
            // store the data using create method
            Redirect_model::create($url_data);

            // redirect
            Session::flash('message', 'Record created successfully  !');
            return Redirect::to('Redirect_url');
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
        //get data for redirect model
        $data = Redirect_model::find($id);
        //load view
        return view('Redirect/edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //make rules
        $rules = array(
            'source_url' => 'required',
            'target_url' => 'required'
        );

        //validation
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('Redirect_url/' . $id . '/edit')
                            ->withErrors($validator);
        } else {
            //get data from post
            $url_data = Request::except(array('_method'));
            //print_r($url_data);exit;
            //update redirect url  data
            Redirect_model::where('redirect_id', $id)->update($url_data);

            // redirect
            Session::flash('message', 'Record updated successfully !');
            return Redirect::to('Redirect_url/' . $id . '/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        // delete redirect url
        $data = Redirect_model::find($id);

        $data->delete();

        // redirect
        Session::flash('message', 'Record deleted successfully ');
        return Redirect::to('Redirect_url');
    }

}
