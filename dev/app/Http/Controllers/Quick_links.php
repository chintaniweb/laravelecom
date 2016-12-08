<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\Quick_links_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Quick_links extends Controller {

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
        //
        return view('QuickLinks/list');
    }

    public function getQuickLinks() {
        //fetch sql data into arrays
        //$data = DB::table('quick_links')->where()->get();
        $data = DB::table('quick_links')->select('quick_links_id', 'quick_links_id as quick_links_id_tmp', 'link_url', 'link_friendly', 'active', 'link_sort')->get();
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return view('QuickLinks/create');
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

        //set rules for validation
        $rules = array(
            'link_url' => 'required',
            'link_friendly' => 'required'
        );

        //make validation
        $validate = Validator::make(Request::all(), $rules);

        //check if validation
        if ($validate->fails()) {

            //set validation message
            $messages = $validate->messages();

            //show validation message & redirect
            return Redirect::to('quicklinks/add')->withErrors($validate);
        } else {
            //request for flashing the data on failed validation


            $input = Request::all();

            //echo"<pre>";
            //print_r($input);
            //exit;

            Quick_links_model::create($input);

            Session::flash('message', 'Record Inserted Successfully!');

            //redirect
            return redirect('quicklinks');
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
        //
        $data = DB::table('quick_links')->where('quick_links_id', $id)->get();

        return view('quicklinks/edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
        Request::flash();
        //set rules for validation
        $rules = array(
            'link_url' => 'required',
            'link_friendly' => 'required'
        );

        //make validation
        $validate = Validator::make(Request::all(), $rules);

        //check if validation
        if ($validate->fails()) {

            //set validation message
            $messages = $validate->messages();

            //show validation message & redirect
            return Redirect::to('quicklinks/update/' . $id)->withErrors($validate);
        } else {
            //request for flashing the data on failed validation
            $input = Request::all();

            //update query

            $update = DB::table('quick_links')->where('quick_links_id', $id)->update($input);

            if ($update) {
                //set falsh message for successful updation
                Session::flash('message', 'Record Updated Successfully!');
            } else {
                //set failure message
                Session::flash('message', 'please try again!');
            }
            //redirect
            return Redirect::to('quicklinks/update/' . $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DB::table('quick_links')->where('quick_links_id', $id)->delete();

        //set falsh message for successful deletion
        Session::flash('message', 'Record Deleted Successfully!');

        //redirect to list
        return redirect('quicklinks');
        //echo "enter to the destroy";
        //
        //echo $id;
    }

}
