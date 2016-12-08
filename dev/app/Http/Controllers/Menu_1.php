<?php

/**
 * @access          :   public
 * @description     :   Menu Module
 * @author          :   Swati D. <swati@iwebsquare.com>
 * @created date    :   26th Sept, 2016
 * @created By      :   Swati D.
 * @version         :   0.1
 */

namespace App\Http\Controllers;

use Request;
use DB;
use App\Menu_model;
use App\Menu_category_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Menu extends Controller {

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

        //set year & month blank
        $year = "";
        $month = "";

        //get data from menu table
        $data = DB::table('menu')->get();

        //return list
        return view('Menu/index', ['data' => $data, 'month' => $month, 'year' => $year]);
    }

    /**
     * Display a menu listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function menu_list(Request $request) {

        //request 
        $input = Request::all();

        //month fetch
        $month = $input["theMonth"];

        //year fetch
        $year = $input["theYear"];

        //get data from menu table
        $data = DB::table('menu')->get();

        //return list
        return view('Menu/index', ['data' => $data, 'month' => $month, 'year' => $year]);
    }

    /**
     * Load the main view with all the current model model's data.
     * @return void
     */
    public function getMenuList($year, $month) {

        //set month
        $month = (strlen($month) != 2) ? str_pad($month, 2, "0", STR_PAD_LEFT) : $month;

        //concat year & month for search
        $search = $year . "-" . $month . "-%";

        //fetch sql data into arrays
        $data = DB::select(DB::raw("SELECT menu_id, menu_id as menu_id_tmp, event_date, menu, other_menu FROM `menu` where event_date like '" . $search . "'"));

        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        //set year & month blank
        $year = "";
        $month = "";
        $day = "";

        //default year
        if ($year == "") {
            $year = date("Y");
        }

        //fetch sql data into arrays
        $data['data'] = "";

        //get Menu category SEction
        $category = DB::table('menu_category')->orderBy('category_id', 'desc')->get();

        //retun to add form
        return view('Menu/create', array('data' => $data, 'month' => $month, 'year' => $year, 'category' => $category, 'day' => $day));
    }

    public function menucreate() {

        //request to keep input value
        Request::flash();

        //set rules for validation
        $rules = array(
            'theMonth' => 'required',
        );

        //make validation
        $validate = Validator::make(Request::all(), $rules);

        //check if validation
        if ($validate->fails()) {

            //set validation message
            $messages = $validate->messages();

            //show validation message & redirect
            return Redirect::to('menu/add')->withErrors($validate);
        } else {

            //request all record 
            $input = Request::all();

            //month fetch
            $month = $input["theMonth"];

            //year fetch
            $year = $input["theYear"];

            //Get Category
            $category_id = $input["category_id"];

            //check existing menu 
            if ($this->checkExistedMenu($month, $year)) {

                //set validation message for successful insertion
                Session::flash('message', 'Menu already created. Please check menu list.');

                //redirect
                return redirect(url('/') . '/menu/add');
            }

            //set date format
            $number = cal_days_in_month(CAL_GREGORIAN, $month, $year);

            //set number of days 
            $day = $number;

            //default year
            if ($year == "") {
                $year = date("Y");
            }

            //get Menu category Section
            $category = DB::table('menu_category')->orderBy('category_id', 'desc')->get();

            //return to view
            return view('Menu/create', ['month' => $month, 'year' => $year, 'category_id' => $category_id, 'day' => $day, 'category' => $category]);
        }
    }

    /**
     * To check menu created - Existed
     */
    public function checkExistedMenu($month, $year) {

        //check for year & month is blank or not
        $search_str = ($month != "" && $year != "") ? $year . $month : "";

        //fetch sql data into arrays
        $year = substr($search_str, 0, 4);
        $month = substr($search_str, 4, 2);
        $month = (strlen($month) != 2) ? str_pad($month, 2, "0", STR_PAD_LEFT) : $month;

        //concat year & month
        $search = $year . "-" . $month . "-%";

        //fetch sql data into arrays
        $data = DB::select(DB::raw("SELECT menu_id, menu_id as menu_id_tmp, event_date, menu, other_menu FROM `menu` where event_date like '" . $search . "'"));

        //count data
        if (count($data) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        //request all record 
        $input = Request::all();

        //fetch lidden day
        $hidden_day = $input['hidden_day'];

        //fetch hidden month
        $hidden_month = $input['hidden_month'];

        //fetch hidden year
        $hidden_year = $input['hidden_year'];

        //loop to count all year, month & fields
        for ($i = 1; $i <= $hidden_day; $i++) {

            //store value of i
            $theDay = $i;

            //set varibale from looping
            $field1 = "menu_" . $i;
            $field2 = "other_menu_" . $i;

            //get value
            $event_date = $hidden_year . "-" . $hidden_month . "-" . $i;

            //set value
            $value = array(
                'event_date' => $event_date,
                'menu' => $input[$field1],
                'other_menu' => $input[$field2]
            );

            //insert data
            Menu_model::create($value);
        }

        //if the insert has returned true then we show the flash message
        if (1) {

            //set validation message for successful insertion
            Session::flash('message', 'Record Inserted Successfully!');

            //redirect
            return redirect('menu/add');
        } else {

            //set validation message if insertion failure
            Session::flash('message', 'Please try again!');

            //redirect
            return redirect('menu/add');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show() {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        //fetch menu data
        $data = DB::table('menu')->where('menu_id', $id)->get();

        //return view
        return view('menu/edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {


        //fetch all data into form
        $input = Request::all();
        // print_r($input);exit;
        //update query
        $update = DB::table('menu')->where('menu_id', $id)->update($input);

        if ($update) {

            //set falsh message for successful updation
            Session::flash('message', 'Record Updated Successfully!');
        } else {

            //set failure message
            Session::flash('message', 'please try again!');
        }

        //redirect
        return Redirect::to('menu/edit/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        //delete data
        DB::table('menu')->where('menu_id', $id)->delete();

        //set falsh message for successful deletion
        Session::flash('message', 'Record Deleted Successfully!');

        //redirect to list
        return Redirect::to('menu');
    }

    /**
     * Show the form for copy menu the specified resource.
     * Copy Menu form
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function menucopyview() {

        //sql query to fetch existing monthname
        $existing_menu_lable = DB::select(
                        DB::raw("SELECT DISTINCT CONCAT(YEAR(`event_date`), ' ',"
                                . " MONTHNAME(`event_date`)) AS `Month` FROM `menu` WHERE 1"));

        //sql query to fetch existing month
        $existing_menu_value = DB::select(
                        DB::raw("SELECT DISTINCT CONCAT(YEAR(`event_date`), '', MONTH(`event_date`)) "
                                . "AS `Month` FROM `menu` WHERE 1"));

        //sql query to fetch menu category
        $category = DB::table('menu_category')->orderBy('category_id', 'desc')->get();

        //return view
        return view('Menu/menucopy', ['existing_menu_lable' => $existing_menu_lable, 'existing_menu_value' => $existing_menu_value, 'category' => $category]);
    }

    /**
     * Copy the specified resource from storage.
     * Copy the existing menu according to month & year
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function menucopy(Request $request) {

        //fetch all data into form
        $input = Request::all();

        //get selected data
        $copyfrom = $input['copyfrom'];
        $copyto = $input['copyto'];
        list($year_to, $month_to) = explode("-", $copyto);

        //fetch sql data into arrays
        $year = substr($copyfrom, 0, 4);
        $month = substr($copyfrom, 4, 2);
        $month = (strlen($month) != 2) ? str_pad($month, 2, "0", STR_PAD_LEFT) : $month;

        //concat year & month for search
        $search = $year . "-" . $month . "-%";

        //fetch sql data into arrays
        $data_menu = DB::select(DB::raw("SELECT menu_id, menu_id as menu_id_tmp, event_date, menu, "
                                . "other_menu FROM `menu` where event_date like '" . $search . "'"));
        //check if data menu
        if (count($data_menu) > 0) {

            // get number of days from selected month & year
            $number = cal_days_in_month(CAL_GREGORIAN, $month_to, $year_to);

            for ($i = 1, $j = 0; $i <= $number; $i++, $j++) {

                $event_date = $year_to . "-" . $month_to . "-" . $i;

                $value = array(
                    'event_date' => $event_date,
                    'menu' => $data_menu[$j]->menu,
                    'other_menu' => $data_menu[$j]->other_menu
                );
                //insert data
                Menu_model::create($value);
            }
            //set copy menu successful message
            Session::flash('message', 'Copy Menu created successfully');

            //redirect to add page
            return redirect('menu/add');
        }
    }

}
