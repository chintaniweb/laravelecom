<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Menu_category_model;
use DB;
use Request;
use Illuminate\Support\Facades\Input;
//use Request;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

class Menu_category extends Controller {

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
        return view('Menu.index_category');
    }

    /**
     * Get json Response of content page
     */
    public function getMenuCategoryList() {

        //fetch sql data into arrays
        $data = DB::table('menu_category')->get();

        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Store a newly created resource in create.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        if (Menu_category_model::create()) {
            $data = 1;
        } else {
            $data = 0;
        }
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $menu_category = Request::only('category_id', 'category_name', 'category_sort');
        $id = Request::segment(3);
        $update = Menu_category_model::where('category_id', $id)->update($menu_category);
        if ($update == 1) {
            $update = 1;
        } else {
            $update = Menu_category_model::create();
        }
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($update) . "}";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $id = Request::segment(3);
        $data = Menu_category_model::where('category_id', $id)->delete();
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

}
