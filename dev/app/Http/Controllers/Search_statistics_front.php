<?php

/**
 * @access          :   public
 * @description     :   Search Statistics Module - Front End level
 * @author          :   Swati D. <swati@iwebsquare.com>
 * @created date    :   5th Oct, 2016
 * @updated date    :   6th Oct, 2016
 * @created By      :   Swati D.
 * @version         :   0.1
 */

namespace App\Http\Controllers;

use Request;
use DB;
use App\Search_statistics_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Search_statistics_front extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the search header form for creating a new resource.
     * SEARCH HEADER
     * @return \Illuminate\Http\Response
     */
    public function search_header() {

        //get all data from model
        $data = Search_statistics_model::all();
      
        //fetch searched data
        $search_key = Request::get('search_for');

        //set variables to array
        $search_result = array();
        $sitecontent_result = array();
        $news_result = array();
        $calendar_result = array();
        $keyword = "";

        //return list
        return view('header_search', ['search_result' => $search_result, 'data' => $data, 'sitecontent_result' => $sitecontent_result, 'news_result' => $news_result,
            'calendar_result' => $calendar_result, 'keyword' => $keyword, 'search_key' => $search_key]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        //fetch all data from site_search table
        $data = DB::table('site_search')->get();

        //set variables to array
        $search_result = array();
        $sitecontent_result = array();
        $news_result = array();
        $calendar_result = array();
        $keyword = "";

        //return list
        return view('create_search', ['search_result' => $search_result, 'data' => $data, 'sitecontent_result' => $sitecontent_result, 'news_result' => $news_result,
            'calendar_result' => $calendar_result, 'keyword' => $keyword]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        //set rules for validation
        $rules = array(
            'search_for' => 'required',
        );

        //make validation
        $validate = Validator::make(Request::all(), $rules);

        //check if validation
        if ($validate->fails()) {

            //set validation message
            $messages = $validate->messages();

            //set validation message for search
            Session::flash('message', 'Make sure you search for something please!');

            //show validation message & redirect
            return Redirect::to('search')->withErrors($validate);
        } 
        else {


            //get the Get value of search
            $input = Request::all();

            //fetch searched keyword
            $keyword = $input['search_for'];

            //fetch data of searched keyword
            $key_data = DB::table('site_search')->where('search_for', $keyword)->get();

            //check if searched data already inserted
            if (count($key_data) == 0) {

                //insert data
                Search_statistics_model::create($input);
            }

            if ($input['search_for']) {

                //get the module
                $module = $input['module'];

                //set variables to array
                $sitecontent_result = array();
                $news_result = array();
                $calendar_result = array();

                //if module is not selected
                if ($module != "") {

                    //selected module
                    foreach ($module as $m) {

                        //check if keyword not blank
                        if ($keyword != "" && $keyword != null) {
                            //sitecontent module
                            if ($m == "Sitecontent") {
                                //search page title & page text
                                $site_str = " and (page_title like '%$keyword%' OR page_text LIKE '%$keyword%') ";
                                //sql query to fetch searched keyword
                                $sitecontent_result = DB::select(DB::raw("SELECT parent_id,sitecontent_id, access_url,page_title, navigation_title FROM `site_content` WHERE 1=1 $site_str ORDER BY `sitecontent_id` "));
                            }
                            //school news module
                            if ($m == "School_news") {
                                //search headline & news description
                                $site_str = " and (headline like '%$keyword%' OR news_description LIKE '%$keyword%') ";
                                //sql query to fetch searched keyword
                                $news_result = DB::select(DB::raw("SELECT school_news_id, headline, news_description FROM `school_news` WHERE 1=1 $site_str ORDER BY `school_news_id` "));
                            }
                            //calendar event module
                            if ($m == "Calendar_event") {
                                //search headline & full event description
                                $site_str = " and (headline like '%$keyword%' OR full_event_description LIKE '%$keyword%') ";
                                //sql query to fetch searched keyword
                                $calendar_result = DB::select(DB::raw("SELECT calendar_event_id, headline, full_event_description FROM `calendar_event` WHERE 1=1 $site_str ORDER BY `calendar_event_id` "));
                            }
                        }
                    }
                } 
                else {
                    //search page title & page text
                    $site_str = " and (page_title like '%$keyword%' OR page_text LIKE '%$keyword%') ";
                    //sql query to fetch searched keyword
                    $sitecontent_result = DB::select(DB::raw("SELECT parent_id,sitecontent_id, access_url,page_title, navigation_title FROM `site_content` WHERE 1=1 $site_str ORDER BY `sitecontent_id` "));
                }
            }

            //return list
            return view('create_search', ['sitecontent_result' => $sitecontent_result, 'news_result' => $news_result,
                'calendar_result' => $calendar_result, 'keyword' => $keyword]);
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

        //$data = Search_statistics_model::find($id);
        $data = Search_statistics_model::find($id);

        //set array to variables
        $search_result = array();
        $sitecontent_result = array();
        $news_result = array();
        $calendar_result = array();
        $keyword = "";

        //return list
        return view('searchFront', ['search_result' => $search_result, 'data' => $data, 'sitecontent_result' => $sitecontent_result, 'news_result' => $news_result,
            'calendar_result' => $calendar_result, 'keyword' => $keyword]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        //get the Get value of search
        $input = Request::all();

        //fetch searched keyword
        $keyword = $input['search_for'];

        //fetch searched keyword
        $key_data = DB::table('site_search')->where('search_for', $keyword)->get();

        if ($input['search_for']) {

            //check if there is no keyword 
            if (count($key_data) == 0) {

                //insert if keyword not exist
                Search_statistics_model::create();
            }

            //fetch the module
            $module = $input['module'];

            //set variables to array
            $sitecontent_result = array();
            $news_result = array();
            $calendar_result = array();

            //if module is not selected
            if ($module != "") {

                //selected module
                foreach ($module as $m) {
                    //echo $m;exit;

                    if ($keyword != "" && $keyword != null) {
                        //sitecontent module
                        if ($m == "Sitecontent") {
                            //search page title & page_text
                            $site_str = " and (page_title like '%$keyword%' OR page_text LIKE '%$keyword%') ";
                            //sql query to fetch searched keyword
                            $sitecontent_result = DB::select(DB::raw("SELECT parent_id,sitecontent_id, access_url,page_title, navigation_title FROM `site_content` WHERE 1=1 $site_str ORDER BY `sitecontent_id` "));
                        }
                        //school news module
                        if ($m == "School_news") {
                            //search headline & news description
                            $site_str = " and (headline like '%$keyword%' OR news_description LIKE '%$keyword%') ";
                            //sql query to fetch searched keyword
                            $news_result = DB::select(DB::raw("SELECT school_news_id, headline, news_description FROM `school_news` WHERE 1=1 $site_str ORDER BY `school_news_id` "));
                        }
                        //calendar event module
                        if ($m == "Calendar_event") {
                            //search headline & full event description
                            $site_str = " and (headline like '%$keyword%' OR full_event_description LIKE '%$keyword%') ";
                            //sql query to fetch searched keyword
                            $calendar_result = DB::select(DB::raw("SELECT calendar_event_id, headline, full_event_description FROM `calendar_event` WHERE 1=1 $site_str ORDER BY `calendar_event_id` "));
                        }
                    }
                }
            } 
            else {
                //search page title & page_text
                $site_str = " and (page_title like '%$keyword%' OR page_text LIKE '%$keyword%') ";
                //sql query to fetch searched keyword
                $sitecontent_result = DB::select(DB::raw("SELECT parent_id,sitecontent_id, access_url,page_title, navigation_title FROM `site_content` WHERE 1=1 $site_str ORDER BY `sitecontent_id` "));
            }
        }
        //fetch all data on particular id
        $data = Search_statistics_model::find($id);

        //return list
        return view('searchFront', ['sitecontent_result' => $sitecontent_result, 'news_result' => $news_result,
            'calendar_result' => $calendar_result, 'data' => $data, 'keyword' => $keyword]);
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
