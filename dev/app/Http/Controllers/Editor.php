<?php

/**
 * @access          :   public
 * @description     :   Editor
 * @author          :   Pradip valand. <pradip@iwebsquare.com>
 * @created date    :   8th september, 2016
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
//use Storage;
use Illuminate\Support\Facades\Storage;
use File;

class Editor extends Controller {

    public function __construct() {
        if (Session::get('id') == '') {
            Redirect::to('admin')->send();
        }
        if(Session::get('website_id') == 1){
        $this->middleware('auth');
        $this->middleware('permission:editor-list', ['only' => ['create']]);
       
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data = Request::segment(3);
        //echo $data;exit;
        $directory = base_path() . '/resources/assets/css';
        $files = File::files($directory);
        //load view
        return view('Editior/create', ['file' => $data, 'map' => $files]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data = Request::segment(3);
        $directory = base_path() . '/resources/assets/css';
        //echo $directory;exit;
        $files = File::files($directory);
        //print_r($files);exit;
        $method = Request::segment(2);
        //echo $method;exit;
        //load view
        return view('Editior/create', ['map' => $files, 'file' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //echo "test";exit;
        //echo "fds";exit;
        $file_name = Request::segment(3);
        //echo $file_name;exit;
        $file = base_path() . '/resources/assets/css/' . $file_name;
        //print_r($file);exit;
        $data = Request::get('style');
        //print_r( $data);exit;
        //print_r($data);exit;
        if (file_put_contents($file, $data)) {
            //redirect
            //echo "test successfull";exit;
            return Redirect::to('Editor/create/' . $file_name)->withMessage('File write successfully');
        } {

            return Redirect::to('Editor/create')->withMessage('please try again!');
        }
    }

    public function save_Data() {
        return Redirect::to('Editor/create')->withMessage('please try again!');
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

}
