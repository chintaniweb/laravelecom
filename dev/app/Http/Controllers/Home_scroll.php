<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\Home_scroll_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Home_scroll extends Controller {

    public function __construct() {
        if (Session::get('id') == '') {
            Redirect::to('admin')->send();
        }
    }

    public function index() {
        return view('HomeScroll.list');
    }

    //
    public function getHomeScrollList() {
        //fetch sql data into arrays
        $data = DB::select("SELECT * from home_scroll");

        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    public function create(Request $request) {
        if (Home_scroll_model::create()) {
            $data = 1;
        } else {
            $data = 0;
        }
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    public function update(Request $request, $id) {
        $home_scroll = Request::only('home_scroll_id', 'headline', 'link', 'scroll_sort');
        $id = Request::segment(3);
        $update = Home_scroll_model::where('home_scroll_id', $id)->update($home_scroll);
        if ($update == 1) {
            $update = 1;
        } else {
            $update = Home_scroll_model::create($home_scroll);
            //print_r($update);exit;
        }
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($update) . "}";
    }

    public function destroy($id) {
        $id = Request::segment(3);
        $data = Home_scroll_model::where('home_scroll_id', $id)->delete();
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

}
