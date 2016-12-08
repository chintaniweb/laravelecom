<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\Newsletter_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Newsletter extends Controller {

    public function __construct() {
        if (Session::get('id') == '') {
            Redirect::to('admin')->send();
        }
    }

    public function index() {
        // echo "enter to the index newsletter index";
        return view('Newsletter.list');
    }

    //
    public function getNewsletterList() {
        //fetch sql data into arrays
        $data = DB::select("SELECT * from newsletter");


        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    public function create(Request $request) {
        
    }

    public function update(Request $request, $id) {
        $newsletter = Request::only('email');
        $id = Request::segment(3);
        $update = Newsletter_model::where('newsletter_id', $id)->update($newsletter);
        if ($update == 1) {
            $update = 1;
        } else {
            $update = Newsletter_model::create();
        }
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($update) . "}";
    }

    public function destroy($id) {
        $id = Request::segment(3);
        $data = Newsletter_model::where('newsletter_id', $id)->delete();
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

}
