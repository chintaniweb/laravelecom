<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\Block_ip_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Block_ip extends Controller {

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
        return view('Contact-feedback.create_block_ip');
    }

    //
    public function getBlockIpList() {
        //fetch sql data into arrays
        $data = DB::select("SELECT * from block_ip");

        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    public function create(Request $request) {
        if (Block_ip_model::create()) {
            $data = 1;
        } else {
            $data = 0;
        }
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    public function update(Request $request, $id) {
        $block_ip = Request::only('block_id', 'ip_address');

        $id = Request::segment(3);

        $update = Block_ip_model::where('block_id', $id)->update($block_ip);
        if ($update == 1) {
            $update = 1;
        } else {
            $update = Block_ip_model::create();
        }
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($update) . "}";
    }

    public function destroy($id) {
        $id = Request::segment(3);

        $data = Block_ip_model::where('block_id', $id)->delete();

        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

}
