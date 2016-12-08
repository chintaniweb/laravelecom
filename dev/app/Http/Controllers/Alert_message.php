<?php

/**
 * @access          :   public
 * @description     :   Alert message
 * @author          :   Pradip valand. <pradip@iwebsquare.com>
 * @created date    :   28th september, 2016
 * @updated date    :   
 * @created By      :   Pradip valand.
 * @version         :   0.1
 */

namespace App\Http\Controllers;

use Request;
use App\Alert_message_model;
use DB;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Alert_message extends Controller {
    
    

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
        return view('Alert_message/list');
    }

    /**
     * Get json Response of content page
     */
    public function getAlertMessageList() {

        //fetch sql data into arrays
        $data = DB::select("SELECT alert_message_id,alert_message_id as alert_message_id_tmp,subject,on_site_date,off_site_date,details,alert_image,created_at,updated_at FROM `alert_message`");
        //echo $this->db->last_query();
        //json Format
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //show form
        return view('Alert_message/create');
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
            'subject' => 'required',
        );
        $message = array(
            'subject.required' => "The Subject field is required",
        );
        //make validation
        $validate = Validator::make(Request::all(), $rules, $message);

        //check if validation
        if ($validate->fails()) {

            //set validation message
            $messages = $validate->messages();
            //echo $messages;exit;
            //show validation message & redirect
            return Redirect::to('alert_message/add')->withErrors($validate);
        } else {

            //request all input
            $data = Request::all();
            // print_r($data);exit;
            $data['on_site_date'] = date('Y-m-d H:i:s', strtotime($data['on_site_date']));
            $data['off_site_date'] = date("Y-m-d H:i:s", strtotime($data['off_site_date']));

            //insert the value using create method
            Alert_message_model::create($data);
            //return Redirect::to('Category.add_category')->withMessage('Data inserted Successfully');
            return Redirect::to('alert_message')->withMessage('Data inserted Successfully');
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
        //fetch the alert_message data
        $data = DB::table('alert_message')->where('alert_message_id', $id)->get();
        //print_r($data);exit;
        return view('Alert_message/updated', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //request for flashing the data on failed validation
        Request::flash();
        //make rules
        $rules = array(
            'subject' => 'required',
        );
        //make validation
        $validate = Validator::make(Request::all(), $rules);

        //check if validation
        if ($validate->fails()) {

            //set validation message
            $messages = $validate->messages();
            //echo $messages;exit;
            //show validation message & redirect
            return Redirect::to('alert_message/edit/' . $id)->withErrors($validate);
        } else {

            //request all input
            $data = Request::all();
            $data['on_site_date'] = date('Y-m-d H:i:s', strtotime($data['on_site_date']));
            $data['off_site_date'] = date("Y-m-d H:i:s", strtotime($data['off_site_date']));
            //print_r($data);exit;
            //update data
            $update = DB::table('alert_message')->where('alert_message_id', $id)->update($data);
            if ($update) {
                //set falsh message for successful updation
                Session::flash('message', 'Record Updated Successfully!');
            } else {
                //set failure message
                Session::flash('message', 'please try again!');
            }
            //return Redirect::to('Category.add_category')->withMessage('Data inserted Successfully');
            return Redirect::to('alert_message/edit/' . $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //fetch the staff members data by id
        DB::table('alert_message')->where('alert_message_id', $id)->delete();

        //redirect the listing page
        return redirect('alert_message ')->withMessage('Data Delete Successfully');
    }

}
