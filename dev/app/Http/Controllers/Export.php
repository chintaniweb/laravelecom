<?php

/**
 * @access          :   public
 * @description     :   Export file
 * @author          :   Pradip valand. <pradip@iwebsquare.com>
 * @created date    :   5th september, 2016
 * @updated date    :   
 * @created By      :   Pradip valand.
 * @version         :   0.1
 */

namespace App\Http\Controllers;

use Request;
use App\Export_model;
use DB;
use Response;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Export extends Controller {

    public function __construct() {
        if (Session::get('id') == '') {
            Redirect::to('admin')->send();
        }
          // get session website id
        if(Session::get('website_id') == 1){
            
        $this->middleware('auth');
        $this->middleware('permission:export-create', ['only' => ['create']]);
        
        
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
        //load view
        return view('Export/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $input = Request::get('status');
        //fetch data into sitecontent table
        $table = DB::table('site_content')->where('status', $input)->get();
        //print_r($table);exit;
        $filename = 'Site Content_' . date('d-m-Y') . '.csv';
        //echo $filename;exit;
        //file open
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('sitecontent_id', 'parent_id', 'website_id', 'navigation_title', 'page_title', 'access_url', 'sub_title', 'page_text', 'page_sort', 'page_type', 'content_type', 'status', 'on_site', 'visibility', 'password', 'meta_title', 'meta_description', 'meta_keywords', 'added_by', 'created_at', 'updated_at', 'targeted_keyword'));
        //put data in file
        foreach ($table as $row) {
            fputcsv($handle, array($row->sitecontent_id, $row->parent_id, $row->website_id, $row->navigation_title, $row->page_title, $row->access_url, $row->sub_title, $row->page_text, $row->page_sort, $row->page_type, $row->content_type, $row->status, $row->on_site, $row->visibility, $row->password, $row->meta_title, $row->meta_description, $row->meta_keywords, $row->added_by, $row->created_at, $row->updated_at, $row->targeted_keyword));
        }
        
       //file close
        fclose($handle);
        //file type
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        //file name
        $name = 'Site Content_' . date('d-m-Y') . '.csv';
          //download file
        return Response::download($filename, $name, $headers);
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
