<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\Search_statistics_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Search_statistics extends Controller {

    public function __construct() {
        if (Session::get('id') == '') {
            Redirect::to('admin')->send();
        }
        
        //get prmission for boces website
        if(Session::get('website_id') == 1){
            
        $this->middleware('auth');
        $this->middleware('permission:search-statistics-list',   ['only' => ['show', 'index']]);
      
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        //set year , month & details blank
        $year = "";
        $month = "";
        $details = "";
        $search_data = array();

        //return list
        return view('Search_statistics/index', ['month' => $month, 'year' => $year, 'details' => $details, 'search_data' => $search_data]);
    }

    public function getSearchList(Request $request) {

        //get all data in form
        $input = Request::all();

        //fetch month
        $month = $input['theMonth'];

        //year fetch
        $year = $input['theYear'];

        //fetch details
        $details = $input['details'];

        //default year
        if ($year == "") {
            $year = date("Y");
        }

        //default month
        if ($month == "") {
            $month = date("m");
        }

        //sql query to list data
        $search_data = DB::select(DB::raw("SELECT site_search_id,search_for, details,created_at "
                                . "FROM  `site_search` where month(created_at) = $month and "
                                . "year(created_at)= $year and details = '$details'"));

        //return to list
        return view('Search_statistics/index', ['search_data' => $search_data, 'month' => $month, 'year' => $year, 'details' => $details]);
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
