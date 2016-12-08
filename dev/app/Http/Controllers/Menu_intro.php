<?php

/**
 * @access          :   public
 * @description     :   Menu Intro Module
 * @author          :   Swati D. <swati@iwebsquare.com>
 * @created date    :   27th Sept, 2016
 * @updated date    :   28th Sept,2016
 * @created By      :   Swati D.
 * @version         :   0.1
 */

namespace App\Http\Controllers;

use Request;
use DB;
use App\Menu_intro_model;
use App\Menu_setting_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Menu_intro extends Controller {

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

        //get data from newsletter table & apply pagination 
        $data = DB::table('menu_intro')->get();

        //return list
        return view('Menu/intro_index', ['data' => $data]);
    }

    /**
     * Get json Response of content page
     */
    public function getMenuIntroList() {

        //fetch sql data into arrays
        $data = DB::table('menu_intro')->select('menu_intro_id', 'menu_intro_id as menu_intro_id_tmp', 'headline', 'header_image', 'menu_intro')->get();

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

        //fetch menu intro data
        $data = DB::table('menu_intro')->where('menu_intro_id', $id)->get();

        //return to view page
        return view('Menu/intro_edit', ['data' => $data]);
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
            return Redirect::to('menu_intro/edit/' . $id)->withErrors($validator);
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
                $header_image_path = 'resources\views\Menu\menu_intro_files';
                //move image on specific path
                $input['header_image']->move($header_image_path, $header_image);
                //store original name of image
                $input['header_image'] = $header_image;
            }

            //update query
            $update = DB::table('menu_intro')->where('menu_intro_id', $id)->update($input);

            //check if update
            if ($update) {

                //set falsh message for successful updation
                Session::flash('message', 'Record Updated Successfully!');
            } else {

                //set failure message
                Session::flash('message', 'please try again!');
            }

            //redirect to update
            return Redirect::to('menu_intro/edit/' . $id);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function deleteImage($id) {

        //fetch menu intro data for individual id
        $data = DB::table('menu_intro')->where('menu_intro_id', $id)->get();

        //set image path
        $picture_path = 'resources/views/Menu/Menu_intro_files/';

        //concat image path & image name
        $delete_path = $picture_path . $data[0]->header_image;

        //delete image from image folder
        unlink($delete_path);

        //set image field blank
        $input = ['header_image' => ""];

        //update query to delete individual image
        DB::table('menu_intro')->where('menu_intro_id', $id)->update($input);

        //set falsh message for successful deletion
        Session::flash('message', 'Image Deleted Successfully!');

        //return to update
        return Redirect::to('menu_intro/edit/' . $id);
    }

    /**
     * Show the form for weekend setting updates the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function weekend_setting_updates() {

        //fetch setting data
        $data = DB::table('menu_setting')->where('menu_setting_id', 1)->get();

        //return view
        return view('Menu/weekend_setting_update', ['data' => $data]);
    }

    function weekend_update(Request $request) {

        //fetch all data into form
        $input = Request::all();

        //update query
        $update = DB::table('menu_setting')->where('menu_setting_id', 1)->update($input);

        //check if update
        if ($update) {

            //set falsh message for successful updation
            Session::flash('message', 'Record Updated Successfully!');
        } else {

            //set failure message
            Session::flash('message', 'please try again!');
        }
        //redirect to update
        return Redirect::to('menu_intro/weekend_setting_updates/');
    }

    function ical_setting() {

        //fetch setting data
        $data = DB::table('menu_setting')->where('menu_setting_id', 1)->get();

        //return view
        return view('Menu/ical', ['data' => $data]);
    }

    function ical_setting_updates(Request $request) {

        //fetch all data into form
        $input = Request::all();

        //id set to 1
        $id = 1;

        //update query
        $update = DB::table('menu_setting')->where('menu_setting_id', $id)->update($input);

        //check if update
        if ($update) {

            //set falsh message for successful updation
            Session::flash('message', 'Record Updated Successfully!');
        } else {

            //set failure message
            Session::flash('message', 'please try again!');
        }
        //redirect to update
        return Redirect::to('menu_intro/ical_setting/');
    }

}
