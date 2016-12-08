<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\Http\Requests;
use App\homepage_banners_model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class homepage_banners extends Controller {

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
        return view('Homepage_banners/list');
    }

    /**
     * Get jason Response of content page
     */
    public function getBanner() {

        //fetch sql data into arrays
        $data = DB::table('homepage_banners')->select('banner_id', 'banner_id as banner_id_tmp', 'title', 'start_date', 'end_date')->get();
        //print_r($data);
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //retun to add form
        return view('Homepage_banners/create');
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
            'title' => 'required',
            'url' => 'required'
        );



        //make validation
        $validate = Validator::make(Request::all(), $rules);

        //check if validation
        if ($validate->fails()) {

            //set validation message
            $messages = $validate->messages();

            //show validation message & redirect
            return Redirect::to('banner_insert')->withErrors($validate);
        } else {

            //request all record 
            $input = Request::all();

            $input['start_date'] = date("Y-m-d", strtotime($input['start_date']));
            $input['end_date'] = date("Y-m-d", strtotime($input['end_date']));

            /*             * ************************************************************* */
            /*             * ******************* IMAGE UPLOAD START*********************** */
            /*             * ************************************************************* */

            //request file 
            $file1 = Request::file('image');


            if ($file1 != "") {

                //location photo upload
                //get original name of image
                $image_photo = $input['image']->getClientOriginalName();
                //set image path
                $image_photo_path = 'resources\views\Homepage_banners\Homepage_banners_files';
                //move image on specific path
                $input['image']->move($image_photo_path, $image_photo);
                //store original name of image
                $input['image'] = $image_photo;
            }


            /**             * ************************************************************ */
            /**             * ******************** IMAGE UPLOAD END*********************** */
            /**             * ************************************************************ */
            //insert record
            homepage_banners_model::create($input);

            //set validation message for successful insertion
            Session::flash('message', 'Record Inserted Successfully!');

            //redirect
            return redirect('banner_listing');
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
        //fetch setting data
        $data = DB::table('homepage_banners')->where('banner_id', $id)->get();
        //  print_r($data);
        return view('homepage_banners/edit', ['data' => $data]);
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
            'title' => 'required',
            'url' => 'required'
        );

        //make validation
        $validator = Validator::make(Request::all(), $rules);


        //check if validation
        if ($validator->fails()) {

            //set validation message
            $messages = $validator->messages();

            //show validation message & redirect
            return Redirect::to('banner_edit/' . $id)->withErrors($validator);
        } else {

            //fetch all data into form
            $input = Request::all();
            //print_r($input);
            $input['start_date'] = date("Y-m-d", strtotime($input['start_date']));
            $input['end_date'] = date("Y-m-d", strtotime($input['end_date']));
            //print_r($input);exit;
            //request file 
            $file1 = Request::file('image');


            if ($file1 != "") {

                //location photo upload
                //get original name of image
                $image_photo = $input['image']->getClientOriginalName();
                //set image path
                $image_photo_path = 'resources\views\Homepage_banners\Homepage_banners_files';
                //move image on specific path
                $input['image']->move($image_photo_path, $image_photo);
                //store original name of image
                $input['image'] = $image_photo;
            }

            /*             * ************************************************************* */
            /*             * ********************* IMAGE UPLOAD END*********************** */
            /*             * ************************************************************* */

            //update query
            $insert = DB::table('homepage_banners')->where('banner_id', $id)->update($input);

            if ($insert) {

                //set falsh message for successful updation
                Session::flash('message', 'Record Updated Successfully!');
            } else {

                //set failure message
                Session::flash('message', 'please try again!');
            }

            //redirect
            return Redirect::to('banner_edit/' . $id);
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
        //delete data
        DB::table('homepage_banners')->where('banner_id', $id)->delete();

        //set falsh message for successful deletion
        Session::flash('message', 'Record Deleted Successfully!');

        //redirect to list
        return redirect('banner_listing');
    }

    /*
     * delete image
     */

    function deleteImage($id) {


        $data = DB::table('homepage_banners')->where('banner_id', $id)->get();

        $picture_path = 'resources/views/Homepage_banners/Homepage_banners_files/';

        $delete_path = $picture_path . $data[0]->image;

        unlink($delete_path);

        //set image field blank
        $input = ['image' => ''];

        //update query to delete individual image
        DB::table('homepage_banners')->where('banner_id', $id)->update($input);

        //set falsh message for successful deletion
        Session::flash('message', 'Image Deleted Successfully!');

        return Redirect::to('banner_edit/' . $id);
    }

}
