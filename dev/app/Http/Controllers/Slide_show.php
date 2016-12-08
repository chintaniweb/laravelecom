<?php

/**
 * @access          :   public
 * @description     :   Slide Show
 * @author          :   Pradip valand. <pradip@iwebsquare.com>
 * @created date    :   3rd september, 2016
 * @updated date    :   
 * @created By      :   Pradip valand.
 * @version         :   0.1
 */

namespace App\Http\Controllers;

use Request;
use DB;
use App\Slide_show_image_model;
use App\Slide_show_model;
use App\Slide_show_category_model;
use App\Website_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Slide_show extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        if (Session::get('id') == '') {
            Redirect::to('admin')->send();
        }
        
    //apply permission for boces website
    if(Session::get('website_id') == 1){
            
        $this->middleware('auth');
        $this->middleware('permission:create-slideshow', ['only' => ['create']]);
        $this->middleware('permission:edit-slideshow',   ['only' => ['edit']]);
        $this->middleware('permission:slideshow-listing',   ['only' => ['show', 'index']]);
        $this->middleware('permission:delete-slideshow',   ['only' => ['destroy']]);
        $this->middleware('permission:add-slideshow-banner',   ['only' => ['addimg']]);
        $this->middleware('permission:edit-slideshow-banner',   ['only' => ['editdata']]);
        $this->middleware('permission:update-slideshow-banner',   ['only' => ['updateimage']]);
        $this->middleware('permission:delete-slideshow-banner',   ['only' => ['deleteimage']]);
    }
    
    //apply permission for cte website
    if(Session::get('website_id') == 2){
            
        $this->middleware('auth');
        $this->middleware('permission:create-cte-slideshow', ['only' => ['create']]);
        $this->middleware('permission:edit-cte-slideshow',   ['only' => ['edit']]);
        $this->middleware('permission:cte-slideshow-listing',   ['only' => ['show', 'index']]);
        $this->middleware('permission:delete-cte-slideshow',   ['only' => ['destroy']]);
        $this->middleware('permission:add-cte-slideshow-banner',   ['only' => ['addimg']]);
        $this->middleware('permission:edit-cte-slideshow-banner',   ['only' => ['editdata']]);
        $this->middleware('permission:update-cte-slideshow-banner',   ['only' => ['updateimage']]);
        $this->middleware('permission:delete-cte-slideshow-banner',   ['only' => ['deleteimage']]);
    }
   
    }

    public function index() {
        
        //get website data 
        $website_data=get_website_data();
        
        if (Session::has('website_id')) {

            //fetch user name from session
           $web =  Session::get('website_id');
        }
        //echo $web;
        //exit;

        //get slideshow data
        $data = Slide_show_model::all();
        //$data2=Slide_show_image_model::all();
        //return list
        return view('Slide_show/list', ['data' => $data,'website_data'=>$website_data,'web'=>$web]);
    }
    public function set_website()
    {
        
        // get website id
       $website_id=  Request::segment(3);
       //echo $website_id;
       //exit;
    
       //   //echo $website_id;exit;
        // set session variable of website id
        set_website_id($website_id);
      
        return redirect(url('/') .'/Slide_show');
        
    }
    /**
     * Get json Response of content page
     */
    public function getSlideShowList() {
        
          if (Session::has('website_id')) {

            //fetch user name from session
           $web =  Session::get('website_id');
        }

    //$data=DB::select("select s.title,si.image from slide_show as s join slide_show_images as si on s.slide_show_id=si.slide_show_id where s.website_id=2");   
    
        //fetch sql data into arrays
        //select query to get data inside the row
      $data = DB::select("SELECT slide_show_id, slide_show_id as slide_show_id_tmp,title, transitions,slide_show_category_id,password,slide_show_sort,on_site_date,off_site_date,description FROM slide_show where website_id=".$web);
        //$str = $this->db->last_query();  echo $str;exit;

        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
        /******************************************************/
        /******************WEBSITE ID START********************/
        /******************************************************/
        //fetch tag data from its table
        $web_data = DB::table('website')->get();

        //define array
        $website_array = array();

        //fetch website id in array
        foreach ($web_data as $webdata) {

            //web data in array
            $website_array[$webdata->website_id] = $webdata->name;
        }
       
        /******************************************************/
        /******************WEBSITE ID END**********************/
        /******************************************************/
        
        $category = Slide_show_category_model::lists('name', 'slide_show_category_id');
        //load view
        return view('Slide_show/create_slideshow', ['category' => $category,'website_array'=>$website_array]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {


        //request for flashing the data on failed validation
        Request::flash();

        //make rules
        $rules = array(
            'title' => 'required',
        );
        //check validation
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('Slide_show/create')
                            ->withErrors($validator);
        } else {

            //get data from post
            $slide_show_data = Request::all();
            //echo "<pre>";
            //print_r($slide_show_data);
            //exit;
           
            
            

            $slide_show_data['on_site_date'] = date("Y-m-d", strtotime($slide_show_data['on_site_date']));
            $slide_show_data['off_site_date'] = date("Y-m-d", strtotime($slide_show_data['off_site_date']));
            //echo"<pre>";
            //print_r($slide_show_data);exit;
            //print_r($slide_category_data);exit;
            // store the data using create method
            
            $website_id = $slide_show_data['website_id'];
            foreach($website_id as $id)
            {   
                  $slide_show_data['website_id'] = $id;
           // echo"<pre>";
            //print_r($website_id);
            //exit;
                Slide_show_model::create($slide_show_data);
            }

            // redirect
            Session::flash('message', 'Record created successfully  !');
            return Redirect::to('Slide_show');
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

        $data2 = DB::table('slide_show_images')->where('slide_show_id', $id)->get();
        
        //image data
        $data1 = Slide_show_image_model::find($id);

        //category data
        $category = Slide_show_category_model::lists('name', 'slide_show_category_id');
        $data = Slide_show_model::find($id);
        
        
        //$web_data = DB::table('website')->get();

        //define array
       // $website_array = array();
   
        //echo"<pre>";
        //print_r($websiteid_array);
        //exit;

        //fetch website id in array
        
       // print_r($website_array);exit;
       
        return view('Slide_show/edit_slideshow', ['category' => $category, 'data' => $data, 'data2' => $data2]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // validate
        $rules = array(
            'title' => 'required'
        );
        $message = array(
            'title.required' => 'The Slide Show Title field is required',
        );

        //check validation
        $validator = Validator::make(Request::all(), $rules, $message);

        // if validation fails
        if ($validator->fails()) {
            return Redirect::to('Slide_show/' . $id . '/edit')
                            ->withErrors($validator);
        } else {

            //fetch post data
            $slide_show_data = Request::except(array('_method'));
            $slide_show_data['on_site_date'] = date("Y-m-d", strtotime($slide_show_data['on_site_date']));
            $slide_show_data['off_site_date'] = date("Y-m-d", strtotime($slide_show_data['off_site_date']));

            //update slideshow category data
            Slide_show_model::where('slide_show_id', $id)->update($slide_show_data);

            // redirect
            Session::flash('message', 'Record updated successfully !');
            return Redirect::to('Slide_show/' . $id . '/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // delete
        $data = Slide_show_model::find($id);
        $data->delete();

        // redirect
        Session::flash('message', 'Record deleted successfully ');
        return Redirect::to('Slide_show');
    }

    //image uploading
    public function addimg(Request $request) {
        $id = Request::segment(2);

        $slide_data = Request::all();
        //echo $id;exit;
        //make rules
        $rules = array(
            'image' => 'required'
        );
        if (count($slide_data['image'][0]) == "") {

            //set validation message
            Session::flash('msg', 'Please Try again !');

            //redirect
            return redirect('Slide_show/' . $id . '/edit');
        } 
        else {
            $data = Request::all();

            $data['slide_show_id'] = $id;

            //request file
            $file1 = Request::file('image');
            //print_r($file1);exit;
            $file_count = count($file1);
            $uploadcount = 0;
            // $abc='';
            foreach ($file1 as $file) {
               
              //random number generate so unique image add to the database not added duplicate image name.
                $val=rand();

                $destinationPath = 'resources\views\Slide_show\slide_show_file';
                
                $filename = $file->getClientOriginalName();
                
                $filename_new=explode(".", strtolower($filename));
                
                //$filename_new= preg_replace('/\.[^.]+$/','',$filename);

                $upload_success = $file->move($destinationPath, $filename_new[0]."_".$val.".".$filename_new[1]);

                $data['image'] =  $filename_new[0]."_".$val.".".$filename_new[1];

                //insert record
                Slide_show_image_model::create($data);
            }
            /**             * ************************************************************ */
            /**             * ******************** IMAGE UPLOAD END*********************** */
            /**             * ************************************************************ */
            //set validation message for successful insertion
            Session::flash('message', 'Record updated successfully !');

            //redirect
            return redirect('Slide_show/' . $id . '/edit');
        }
    }

     //edit the category
    public function updateimage(Request $request, $id) {

        //echo "enter to the update image";
        //exit;
        //slide show id
        $id = Request::segment(2);
        //slide show image id
        $id1 = Request::segment(5);

        $data = Request::all();
        //echo "<pre>";
        //print_r($data);
        //exit;
        //$data['slide_show_id']=$id;
        // print_r($data);exit;


        /*         * ************************************************************* */
        /*         * ******************* IMAGE UPLOAD START*********************** */
        /*         * ************************************************************* */

        //request file
        $file1 = Request::file('image');
        
        //echo"<pre>";
       // print_r($file1);
       // exit;
        

        if ($file1 != "") {
         
            //random number generate so unique image add to the database not added duplicate image name.
            $val=rand();
            //get original name of image
            $image_photo = $data['image']->getClientOriginalName();
            // echo $image_photo;exit;
            $image_photo_new= explode(".", strtolower($image_photo));
            //set image path
            $image_photo_path = 'resources\views\Slide_show\slide_show_file';
            //move image on specific path
            $data['image']->move($image_photo_path, $image_photo_new[0]."_".$val.".".$image_photo_new[1]);
            //store original name of image
            $data['image'] = $image_photo_new[0]."_".$val.".".$image_photo_new[1];
        }
        /**         * ************************************************************ */
        /**         * ******************** IMAGE UPLOAD END*********************** */
        /**         * ************************************************************ */
        //update the data
        $insert = DB::table('slide_show_images')->where('slide_show_images_id', $id1)->update($data);



        //set validation message for successful insertion
        Session::flash('message', 'Record updated successfully !');

        //redirect
        return redirect('Slide_show/' . $id . '/Slide_show/update/' . $id1);
    }


    //update the data
    public function editdata($id) {

        //slide show id
        $id = Request::segment(2);
        //slide show image id
        $id1 = Request::segment(5);


        $data2 = DB::table('slide_show_images')->where('slide_show_id', $id)->get();
        //print_r($data2);exit;
        //image data
        $data1 = Slide_show_image_model::find($id1);
        //print_r($data1);exit;
        //category data
        $category = Slide_show_category_model::lists('name', 'slide_show_category_id');
        $data = Slide_show_model::find($id);
        //load view
        return view('Slide_show/update_slideshow', ['category' => $category, 'data' => $data, 'data2' => $data2, 'data1' => $data1]);
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteimage($id) {
        //slide show id
        $id = Request::segment(2);
        //echo $id;
        //slide show image id
        $id1 = Request::segment(5);
        //echo $id1;exit;
        // delete
        //delete data
        $data = DB::table('slide_show_images')->where('slide_show_images_id', $id1)->get();
        $picture_path = 'resources/views/Slide_show/slide_show_file/';
        $delete_path = $picture_path . $data[0]->image;
        unlink($delete_path);
//       //set image field blank
//        $input = ['image' => ''];
        //update query to delete individual image
        DB::table('slide_show_images')->where('slide_show_images_id', $id1)->delete();

        // redirect
        //Session::flash('message', 'Record deleted successfully ');
        return Redirect::to('Slide_show/' . $id . '/edit');
    }

}
