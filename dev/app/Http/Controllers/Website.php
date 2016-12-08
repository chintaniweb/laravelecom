<?php

/**
 * @access          :   public
 * @description     :   website
 * @author          :   Pradip valand. <pradip@iwebsquare.com>
 * @created date    :   6th september, 2016
 * @updated date    :   
 * @created By      :   Pradip valand.
 * @version         :   0.1
 */

namespace App\Http\Controllers;

use Request;
use DB;
use App\Website_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Website extends Controller {

    public function __construct() {
        if (Session::get('id') == '') {
            Redirect::to('admin')->send();
        }
        
        //apply permission for boces website
        if(Session::get('website_id') == 1){
            
        $this->middleware('auth');
        $this->middleware('permission:website-create', ['only' => ['create']]);
        $this->middleware('permission:website-edit',   ['only' => ['edit']]);
        $this->middleware('permission:website-list',   ['only' => ['show', 'index']]);
        $this->middleware('permission:website-delete',   ['only' => ['destroy']]);
        
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //get website data
        $data = Website_model::all();
        //load view
        return view('Website/list', ['data' => $data]);
    }

    /**
     * Get json Response of content page
     */
    public function getWebsite() {

        //fetch sql data into arrays
        $data = DB::select("SELECT website_id, website_id as website_id_tmp, name,discription,status,website_logo FROM `website`");
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
        return view('Website/create');
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
            'name' => 'required'
        );
        //make validation
        //validation
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('Website/create')
                            ->withErrors($validator);
        } else {

            $data = Request::all();
            // print_r($data);exit;


            /*             * ************************************************************* */
            /*             * ******************* IMAGE UPLOAD START*********************** */
            /*             * ************************************************************* */
            //request file
            $file = Request::file('website_logo');

            if ($file != "") {

                //get original name of image
                $image_photo = $data['website_logo']->getClientOriginalName();
                // echo $image_photo;exit;
                //set image path
                $image_photo_path = 'resources\views\Website\website_files';
                //move image on specific path
                $data['website_logo']->move($image_photo_path, $image_photo);
                //store original name of image
                $data['website_logo'] = $image_photo;
            }
            /**             * ************************************************************ */
            /**             * ******************** IMAGE UPLOAD END*********************** */
            /**             * ************************************************************ */
            //insert record
            Website_model::create($data);

            //set validation message for successful insertion
            Session::flash('message', 'Record created successfully !');

            //redirect
            return redirect('Website');
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
        //website data
        $data = Website_model::find($id);
        //load view
        return view('Website/edit', ['data' => $data]);
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
            'name' => 'required'
        );
        //make validation
        //validation
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('Website/' . $id . '/edit')
                            ->withErrors($validator);
        } else {

            $data = Request::except(array('_method'));
            // print_r($data);exit;


            /*             * ************************************************************* */
            /*             * ******************* IMAGE UPLOAD START*********************** */
            /*             * ************************************************************* */
            //request file
            $file = Request::file('website_logo');

            if ($file != "") {

                //get original name of image
                $image_photo = $data['website_logo']->getClientOriginalName();
                // echo $image_photo;exit;
                //set image path
                $image_photo_path = 'resources\views\Website\website_files';
                //move image on specific path
                $data['website_logo']->move($image_photo_path, $image_photo);
                //store original name of image
                $data['website_logo'] = $image_photo;
            }
            /**             * ************************************************************ */
            /**             * ******************** IMAGE UPLOAD END*********************** */
            /**             * ************************************************************ */
            //update website data
            Website_model::where('website_id', $id)->update($data);


            //set validation message for successful insertion
            Session::flash('message', 'Record updated successfully !');

            //redirect
            return Redirect::to('Website/' . $id . '/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // delete website data
        $data = Website_model::find($id);

        $data->delete();

        // redirect
        Session::flash('message', 'Record deleted successfully ');
        return Redirect::to('Website');
    }

    /*
     * delete image
     */

    function deleteImage($id) {

        //get website data
        $data = DB::table('website')->where('website_id', $id)->get();
        //image path
        $picture_path = 'resources/views/Website/website_files/';
        //delete path
        $delete_path = $picture_path . $data[0]->website_logo;
        //unlink path
        unlink($delete_path);

        //set image field blank
        $input = ['website_logo' => ''];

        //update query to delete individual image
        DB::table('website')->where('website_id', $id)->update($input);

        //set falsh message for successful deletion
        Session::flash('message', 'Image Deleted Successfully!');

        return Redirect::to('Website/' . $id . '/edit');
    }

}
