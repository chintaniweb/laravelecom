<?php

/**
 * @access          :   public
 * @description     :   Slide Show Category
 * @author          :   Pradip valand. <pradip@iwebsquare.com>
 * @created date    :   30th september, 2016
 * @updated date    :   
 * @created By      :   Pradip valand.
 * @version         :   0.1
 */

namespace App\Http\Controllers;

use Request;
use DB;
use App\Location_model;
use App\Slide_show_category_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Slide_show_category extends Controller {

    public function __construct() {
        if (Session::get('id') == '') {
            Redirect::to('admin')->send();
        }
        //apply permission for boces website
        if(Session::get('website_id') == 1){
            
        $this->middleware('auth');
        $this->middleware('permission:slideshow-category-create', ['only' => ['create']]);
        $this->middleware('permission:slideshow-category-create-edit',   ['only' => ['edit']]);
        $this->middleware('permission:slideshow-category-create-list',   ['only' => ['show', 'index']]);
        $this->middleware('permission:slideshow-category-create-delete',   ['only' => ['destroy']]);
        
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // get all the slide_show_category
        $data = Slide_show_category_model::all();
        //fetch location data
        $location_data = Location_model::where('contact', '=', 'Yes')->lists('location_name', 'location_id')->all();
        $location_id = 0;

        //return list
        return view('Slide_show/index', ['data' => $data, 'location_id' => $location_id, 'location_data' => $location_data]);
    }

    /**
     * Get jason Response of content page
     * fetch all the data for join slide show category table and location table
     */
    public function getSlideShowCategory($id) {

        if ($id != 0) {
            $data = DB::table('slide_show_category')->leftJoin('location', 'slide_show_category.location_id', '=', 'location.location_id')->where('location.contact', 'Yes')->get();
        } else {
            $data = DB::table('slide_show_category')->leftJoin('location', 'slide_show_category.location_id', '=', 'location.location_id')->where('location.contact', 'Yes')->get();
        }

        //json data pass to listing page
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //echo "fds";exit;
        //fetch location data from its table
        $location_data = Location_model::where('contact', '=', 'yes')->lists('location_name', 'location_id');
        //print_r($location_data);exit;
        //load view
        return view('Slide_show/create', ['location_data' => $location_data]);
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

        // validate
        $rules = array(
            'name' => 'required',
            'location_id' => 'required',
        );
        $message = array(
            'name.required' => 'The Category field is required',
            'location_id.required' => 'The Location field is required',
        );

        //check validation
        $validator = Validator::make(Request::all(), $rules, $message);

        // if validation fails
        if ($validator->fails()) {
            return Redirect::to('Slide_show_category/create')
                            ->withErrors($validator);
        } else {

            //get data from post
            $slide_category_data = Request::all();
            //print_r($slide_category_data);exit;
            // store the data using create method
            Slide_show_category_model::create($slide_category_data);

            // redirect
            Session::flash('message', 'Record created successfully  !');
            return Redirect::to('Slide_show_category');
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
        //fetch location data
        $location_data = Location_model::where('contact', '=', 'yes')->lists('location_name', 'location_id');
        // get the slideshow data
        $data = Slide_show_category_model::find($id);
        // print_r($data);exit;
        // show the edit form and pass the slide show data
        return view('Slide_show/edit', ['location_data' => $location_data, 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // validate
        $rules = array(
            'name' => 'required'
        );

        //check validation
        $validator = Validator::make(Request::all(), $rules);

        // if validation fails
        if ($validator->fails()) {
            return Redirect::to('Slide_show_category/' . $id . '/edit')
                            ->withErrors($validator);
        } else {

            //fetch post data
            $slide_category_data = Request::except(array('_method'));

            //update slideshow category data
            Slide_show_category_model::where('slide_show_category_id', $id)->update($slide_category_data);

            // redirect
            Session::flash('message', 'Record updated successfully !');
            return Redirect::to('Slide_show_category/' . $id . '/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // delete
        $data = Slide_show_category_model::find($id);
        $data->delete();

        // redirect
        Session::flash('message', 'Record deleted successfully !');
        return Redirect::to('Slide_show_category');
    }

}
