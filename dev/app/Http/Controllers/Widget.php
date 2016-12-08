<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
//use widget;
use DB;
use App\Http\Requests;
use App\widget_sidebar;
use App\widget_footer;
use App\widget_dashboard;
use Session;
use Illuminate\Support\Facades\Redirect;

class Widget extends Controller {

    public function __construct() {
        if (Session::get('id') == '') {
            Redirect::to('admin')->send();
        }
    }

    public function index() {
        //get dashboard data
        $data['dashboard_data'] = DB::table('widget')
                        ->join('widget_dashboard', 'widget.name', '=', 'widget_dashboard.widget_id')->get();

        //get sidebar data
        $data['sidebar_data'] = DB::table('widget_sidebar')->get();
        //print_r($data['sidebar_data']); 
        //get sidebar data
        $data['footer_data'] = DB::table('widget_footer')->get();
        // print_r($data['footer_data']);exit;
        return view('widget.list', ["data" => $data]);
    }

    /**
     * insert sidebar widget
     */
    public function sidebar_widget() {

        //get news ID

        $id = Request::segment(3);
        //$insert = array('widget_id' => $id);
        $insert = widget_sidebar::create(['widget_id' => $id]);
        if ($insert == true) {
            if ($id == "text") {
                widget_sidebar::where('id', $insert->id)->update(array("widget_id" => "stext" . $insert->id));
            }
            $data = 1;
        } else {
            $data = 0;
        }
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * update sidebar widget
     */
    public function update_sidebar_widget($id, Request $request) {


        $widget = Request::all();

        widget_sidebar::where('widget_id', $id)->update($widget);

        return redirect('widget');
    }

    /**
     * delete Sidebar widget
     */
    public function delete_sidebar_widget($id) {

        //delete query
        DB::table('widget_sidebar')->where('widget_id', $id)->delete();
        return redirect('widget');
    }

    /**
     * insert sidebar widget
     */
    public function footer_widget() {

        //get news ID

        $id = Request::segment(3);
        //$insert = array('widget_id' => $id);
        $insert = widget_footer::create(['widget_id' => $id]);
        if ($insert == true) {
            if ($id == "text") {
                widget_footer::where('id', $insert->id)->update(array("widget_id" => "ftext" . $insert->id));
            }
            $data = 1;
        } else {
            $data = 0;
        }
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * update sidebar widget
     */
    public function update_footer_widget($id, Request $request) {


        $widget = Request::all();

        //print_r($widget);exit;

        widget_footer::where('widget_id', $id)->update($widget);

        return redirect('widget');
    }

    /**
     * delete Sidebar widget
     */
    public function delete_footer_widget($id) {

        //delete query
        DB::table('widget_footer')->where('widget_id', $id)->delete();
        return redirect('widget');
    }

    /**
     * update sidebar widget
     */
    public function update_dashboard_widget($id, Request $request) {


        $widget = Request::all();

        //print_r($widget);exit;

        widget_dashboard::where('widget_id', $id)->update($widget);

        return redirect('widget');
    }

}
