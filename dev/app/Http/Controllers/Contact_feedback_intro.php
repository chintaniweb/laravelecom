<?php

/** @access             :   public
 * @description          :   Contact-feedback Intro - Admin level
 * @author               :   Swati D. <swati@iwebsquare.com> 
 * @created date         :   12th Oct, 2016
 * @Last updated By      :   Swati D.
 * @version              :   0.1
 */

namespace App\Http\Controllers;

use Request;
use DB;
use App\Contact_feebback_intro_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Contact_feedback_intro extends Controller {

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
        return view('Contact-feedback/intro_index');
    }

    /**
     * Get json Response of content page
     */
    public function getContactIntroList() {

        //fetch sql data into arrays
        $data = DB::table('contact_feedback_intro')->select('contact_intro_id', 'contact_intro_id as contact_intro_id_tmp', 'headline', 'header_image', 'contact_intro')->get();

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

        //fetch contact feedback intro data
        $data = DB::table('contact_feedback_intro')->where('contact_intro_id', $id)->get();

        //return to view page
        return view('Contact-feedback/intro_edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        //set the validation rules 
        $rules = array(
            'headline' => 'required',
        );

        //make validation
        $validator = Validator::make(Request::all(), $rules);

        //check if validation
        if ($validator->fails()) {

            //set validation message
            $messages = $validator->messages();

            //show validation message & redirect
            return Redirect::to('contact_feedback_intro/edit/' . $id)->withErrors($validator);
        } else {

            //fetch all data into form
            $input = Request::all();

            //request file
            $file = Request::file('header_image');

            //check if field is not blank
            if ($file != "") {

                //get original name of image
                $header_image = $input['header_image']->getClientOriginalName();
                //set image path
                $header_image_path = 'resources\views\Contact-feedback\contact_feedback_intro_files';
                //move image on specific path
                $input['header_image']->move($header_image_path, $header_image);
                //store original name of image
                $input['header_image'] = $header_image;
            }

            //update query
            $update = DB::table('contact_feedback_intro')->where('contact_intro_id', $id)->update($input);

            //check if update
            if ($update) {

                //set falsh message for successful updation
                Session::flash('message', 'Record Updated Successfully!');
            } else {

                //set failure message
                Session::flash('message', 'please try again!');
            }

            //redirect
            return Redirect::to('contact_feedback_intro/edit/' . $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    /**
     * Remove Contact feedback intro the specified resource from storage.
     * Contact feedback intro
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function deleteImage($id) {

        //fetch contact feedback intro data
        $data = DB::table('contact_feedback_intro')->where('contact_intro_id', $id)->get();

        //set image path
        $picture_path = 'resources/views/Contact-feedback/contact_feedback_intro_files/';

        //concat image path & its name to delete
        $delete_path = $picture_path . $data[0]->header_image;

        //delete image from folder
        unlink($delete_path);

        //set image field blank
        $input = ['header_image' => ""];

        //update query to delete individual image
        DB::table('contact_feedback_intro')->where('contact_intro_id', $id)->update($input);

        //set falsh message for successful deletion
        Session::flash('message', 'Image Deleted Successfully!');

        //return to update page
        return Redirect::to('contact_feedback_intro/edit/' . $id);
    }

}
