<?php

/**
 * @access          :   public
 * @description     :   Email Template
 * @author          :   Pradip valand. <pradip@iwebsquare.com>
 * @created date    :   7th september, 2016
 * @updated date    :   
 * @created By      :   Pradip valand.
 * @version         :   0.1
 */

namespace App\Http\Controllers;

use Request;
use DB;
use App\Email_template_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Email_template extends Controller {

    public function __construct() {
        if (Session::get('id') == '') {
            Redirect::to('admin')->send();
        }
        
        if(Session::get('website_id') == 1){
            
        $this->middleware('auth');
        $this->middleware('permission:email-template-create', ['only' => ['create']]);
        $this->middleware('permission:email-template-edit',   ['only' => ['edit']]);
        $this->middleware('permission:email-template-list',   ['only' => ['show', 'index']]);
        $this->middleware('permission:email-template-delete',   ['only' => ['destroy']]);
        
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //get email template data
        $data = Email_template_model::all();

        //load view
        return view('Email_template/list', ['data' => $data]);
    }

    /**
     * Get jason Response of content page
     */
    public function getEmailtemplate() {

        //fetch sql data into arrays
        $data = DB::table('email_template')->orderBy('email_template_id', 'ASC')->get();
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
        return view('Email_template/create');
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

        //rules
        $rules = array(
            'email_template_name' => 'required'
        );

        //make validation
        //validation
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('Email_template/create')
                            ->withErrors($validator);
        } else {
            //post the data
            $data = Request::all();
            //insert record
            Email_template_model::create($data);

            //set validation message for successful insertion
            Session::flash('message', 'Record created successfully !');

            //redirect
            return redirect('Email_template');
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
        //email template data
        $data = Email_template_model::find($id);

        //load view
        return view('Email_template/edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //rules
        $rules = array(
            'email_template_name' => 'required'
        );

        //make validation
        //validation
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('Email_template/' . $id . '/edit')
                            ->withErrors($validator);
        } else {

            $data = Request::except(array('_method'));
            //insert record
            //update emailtemplate data
            Email_template_model::where('email_template_id', $id)->update($data);

            //set validation message for successful insertion
            Session::flash('message', 'Record created successfully !');

            //redirect
            return Redirect::to('Email_template/' . $id . '/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // delete emailtemplate data
        $data = Email_template_model::find($id);

        $data->delete();

        // redirect
        Session::flash('message', 'Record deleted successfully ');
        return Redirect::to('Email_template');
    }

}
