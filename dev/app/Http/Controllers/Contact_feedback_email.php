<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\Contact_feedback_email_model;
use App\Feedback_email_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Contact_feedback_email extends Controller {

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

        //fetch location data for contact set to be yes
        $data['location_data'] = get_location("contact", "Yes");

        //fetch additional feedback email data
        $data = DB::table('contact_feedback_additional')->get();

        //return view
        return view('Contact-feedback.index_email', ['data' => $data]);
    }

    /**
     * Get json Response of content page
     */
    public function getLocationList() {

        //fetch location from location table having contact-yes
        $data['location_data'] = get_location("contact", "Yes");

        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Get json Response of content page
     */
    public function getAdditionalList() {

        //fetch sql data into arrays
        $data = DB::select("SELECT * from contact_feedback_additional");

        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        //insert data
        if (Contact_feedback_email_model::create()) {
            $data = 1;
        } else {
            $data = 0;
        }
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Update Feedback email the specified resource in storage.
     * Feedback email
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        //fetch location data
        $feedback_email = Request::only('location_id', 'location_name', 'email');

        //set segment
        $id = Request::segment(3);

        //update feedback email
        $update = Feedback_email_model::where('location_id', $id)->update($feedback_email);
        if ($update == 1) {
            $update = 1;
        } else {
            $update = Feedback_email_model::create();
        }
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($update) . "}";
    }

    /**
     * Update Additional feedback email the specified resource in storage.
     * Additional feedback email
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function additional_update(Request $request, $id) {

        //fetch additional email
        $additional_email = Request::only('additional_id', 'name', 'email');

        //set segment
        $id = Request::segment(3);

        //update additional email
        $update = Contact_feedback_email_model::where('additional_id', $id)->update($additional_email);
        if ($update == 1) {
            $update = 1;
        } else {
            $update = Contact_feedback_email_model::create();
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

        //set segment
        $id = Request::segment(3);

        //fetch additional email to delete
        $data = Contact_feedback_email_model::where('additional_id', $id)->delete();

        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

}
