<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
//use widget;
use DB;
use App\Http\Requests;

class Widget extends Controller
{
    public function index() {
        //get dashboard data
        // get updated page data
        $updated_pages = get_widget_data('UPDATED_PAGES');
        
        //print_r($data);exit;
       
        // get seo page data
        $seo_info = get_widget_data('SEO_INFORMATION');
        
        //get recently visited dpage data
        $recently_visited_data = get_widget_data('RECENTLY_VISITED_PAGES');
         
        //get Top visited dpage data
        $top_visited_data = get_widget_data('TOP_VISITED');
        
        //get Like box data
        $like_box_data = getLikeBoxData();
        
        //get search data
        $search_data = get_widget_data('SEARCH');
        
        //get dashboard data
        $dashboard_data = DB::table('widget')
                ->join('widget_dashboard','widget.name','=','widget_dashboard.widget_id')->get();
        
        //get sidebar data
        $sidebar_data = DB::table('widget_sidebar')->get();
        
        return view('widget.list',['updated_pages'=>$updated_pages,'seo_info'=>$seo_info,
            'recently_visited_data'=>$recently_visited_data,'top_visited_data'=>$top_visited_data,
            'like_box_data'=>$like_box_data,'search_data'=>$search_data,'dashboard_data'=>$dashboard_data,'sidebar_data'=>$sidebar_data]);
    }
    
    /**
     * insert sidebar widget
     */
    public function sidebar_widget() {
        
        //get news ID
        
        $id = Request::segment(3);
        //$insert = array('widget_id' => $id);
        $insert = DB::table('widget_sidebar')->insert(['widget_id' => $id]);
        if($insert == true) {
            $data = 1;
        }
        else {
            $data = 0;
        }
        header("Content-type: application/json"); 
		echo "{\"data\":" .json_encode($data). "}";
    }
}
