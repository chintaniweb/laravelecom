<?php
/**
 * @access          :   public
 * @description     :   Slide Show
 * @author          :   Pradip valand. <pradip@iwebsquare.com>
 * @created date    :   4th september, 2016
 * @updated date    :   
 * @created By      :   Pradip valand.
 * @version         :   0.1
 */
namespace App\Http\Controllers;
use Request;
use DB;
use App\Slide_show_images_front_model;
use App\slide_show_front_model;
use App\Slide_show_category_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Slide_show_front_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //slide show id
        $id=Request::segment(3);
        //echo $id;exit;
         //slide show data
        $data = DB::table('slide_show')->where('slide_show_id',$id)->get();
        //print_r($data);exit;
         //slide image data
        $data1=DB::table('slide_show_images')->where('slide_show_id',$id)->get();
        //print_r($data1);exit;
        return view('preview_slideshow',['data'=>$data,'slide_image_data'=>$data1]);
    }
    
    /**
     * Load the preview of Slide_show with all the current model's data.
     * @return void
     * */
    public function viewGallery() {
     
        $id = Request::segment(3);
        
        $data = DB::table('slide_show')->where('slide_show_id',$id)->get();
        //print_r($data);exit;
         //slide image data
        $data1=DB::table('slide_show_images')->where('slide_show_id',$id)->get();
        //print_r($data1);exit;
        return view('slideshowgallery',['data'=>$data,'slide_image_data'=>$data1]);
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
