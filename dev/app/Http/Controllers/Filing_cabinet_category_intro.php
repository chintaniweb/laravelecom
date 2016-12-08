<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\Filing_cabinet_category_intro_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Filing_cabinet_category_intro extends Controller {

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

        return view('Filing_cabinet/category_intro_list');
    }

    public function getFilingCabinetCategoryIntroList() {

        //echo "enter to the function";
        //exit;
        //fetch sql data into arrays
        $data = DB::select("SELECT filing_cabinet_category_intro_id, filing_cabinet_category_intro_id as filing_cabinet_category_intro_id_tmp, headline, header_image,filesystem_intro FROM `filing_cabinet_category_intro`");
        //echo "<pre>";
        //print_r($data);
        //exit;
        //$str = $this->db->last_query();echo $str;exit;

        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
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

        $data = Filing_cabinet_category_intro_model::find($id);

        return view('Filing_cabinet/category_intro_edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    Public function update(Request $request, $id) {

        //request all record 
        $filing_category_intro_data = $request::except('_method');

        $file_name = Request::file('header_image');

        if ($file_name != "") {

            //define path
            $path = 'resources/views/Filing_cabinet/filing_cabinet_category_intro_files/';

            //move file into folder
            $image_name = do_upload($file_name, $path);

            //store image original name
            $filing_category_intro_data['header_image'] = $image_name;
            //echo "sueecssfully";
        }
        //Filling Cabinet category Intro update
        Filing_cabinet_category_intro_model::where('filing_cabinet_category_intro_id', $id)->update($filing_category_intro_data);

        // redirect
        Session::flash('message', 'Record updated successfully');

        return Redirect::to('Filing_cabinet_category_intro/' . $id . '/edit');
    }

    function deleteImage($id) {

        $data = DB::table('filing_cabinet_category_intro')->where('filing_cabinet_category_intro_id', $id)->get();

        $picture_path = 'resources/views/Filing_cabinet/filing_cabinet_category_intro_files/';

        $delete_path = $picture_path . $data[0]->header_image;

        unlink($delete_path);

        //set image field blank
        $input = ['header_image' => ''];

        //update query to delete individual image
        DB::table('filing_cabinet_category_intro')->where('filing_cabinet_category_intro_id', $id)->update($input);

        //set falsh message for successful deletion
        Session::flash('message', 'Image Deleted Successfully!');

        return Redirect::to('Filing_cabinet_category_intro/' . $id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
    }

}
