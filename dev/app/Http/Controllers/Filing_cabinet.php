<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\Filing_cabinet_model;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class Filing_cabinet extends Controller {

    public function __construct() {
        if (Session::get('id') == '') {
            Redirect::to('admin')->send();
        }
         //apply permission for boces site
        if(Session::get('website_id') == 1){
            
        $this->middleware('auth');
        $this->middleware('permission:filling-cabinet-create', ['only' => ['create']]);
        $this->middleware('permission:filling-cabinet-edit',   ['only' => ['edit']]);
        $this->middleware('permission:filling-cabinet-list',   ['only' => ['show', 'index']]);
        $this->middleware('permission:filling-cabinet-delete',   ['only' => ['destroy']]);
        
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $catTree;

    public function index() {
        
        //load the view
        return view('Filing_cabinet/categorylist');
    }

    public function fileList() {


        //load the view
        return view('Filing_cabinet/list');
    }

    public function getFileList() {
        //echo "hello";

        $id = Request::segment(2);

        if ($id == "") {
            // echo "enter to the if";
            // exit;
            $data = DB::select("SELECT filing_cabinet_id, file_name, filing_cabinet_category_id, filing_cabinet_id as filing_cabinet_id_tmp, show_file_date, hide_file_date, file_description, file_sort FROM `filing_cabinet`");
        } else {
            //echo "enter to the else";
            //exit;
            $data = DB::select("SELECT filing_cabinet_id, file_name, filing_cabinet_category_id, filing_cabinet_id as filing_cabinet_id_tmp, show_file_date, hide_file_date, file_description, file_sort FROM `filing_cabinet` where FIND_IN_SET($id,filing_cabinet_category_id)");
        }

//Get id 
        // $filing_cabinet_category_id = $this->uri->segment(5);
        //fetch sql data into arrays
        // $data = $this->Filing_cabinet_model->get_data_rows($filing_cabinet_category_id);
        header("Content-type: application/json");
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $id = 0;
        if ($id != "") {
            //echo "if";
            //exit;
            $data = DB::select("SELECT filing_cabinet_category_id, parent_id, filing_cabinet_category_id as filing_cabinet_category_id_tmp,filing_cabinet_category_id as filing_cabinet_category_id_cat_tmp, category_name,category_sort FROM `filing_cabinet_category` where parent_id=$id");
        } else {

            //echo "else";
            //exit;
            $data = DB::select("SELECT filing_cabinet_category_id, parent_id, filing_cabinet_category_id as filing_cabinet_category_id_tmp,filing_cabinet_category_id as filing_cabinet_category_id_cat_tmp, category_name,category_sort FROM `filing_cabinet_category`");
        }

        $tree = $this->buildTree($data); //create the bulid tree

        $arr_filing_cabinet_category_id = array();

        //get page tree
        /*   $tree_str = "<ul class=\"list-unstyled\">\n";                
          $tree_str .= "<li class=\"sub-category list-unstyled m-l-15\">\n";
          //$tree_str .= '<option value="0">---- Select Root Category -----</option>';

          $tree_str .= $this->printTree($tree,$r = 0, $p = null,$arr_filing_cabinet_category_id="");
          $tree_str .="</li>";
          $tree_str .="</ul>"; */

        $tree_str = "<ul class=\"list-unstyled\">\n";

        //$tree_str .= '<option value="0">---- Select Root Category -----</option>';
        $this->printTree1($tree, $r = 0, $p = null, $arr_filing_cabinet_category_id = "");
        $tree_str .= $this->catTree;
        $tree_str .="</li>";
        $tree_str .="</ul>";
        $page_tree = $tree_str;
        //echo "<pre>";
        //print_r($page_tree);
        //exit;

        return view('Filing_cabinet/create', ['page_tree' => $page_tree]);
    }

    public function buildTree(Array $data, $parent = 0) {
        $tree = array();
        foreach ($data as $d) {
            if ($d->parent_id == $parent) {
                $children = $this->buildTree($data, $d->filing_cabinet_category_id);

                // set a trivial key
                if (!empty($children)) {
                    $d->_children = $children;
                }
                $tree[] = $d;
            }
        }
        return $tree;
    }

    public function printTree1($tree, $r = 0, $p = null, $arr_filing_cabinet_category_id = "") {
        //print_r($tree);exit;

        for ($i = 0; $i < count($tree); $i++) {
            $t = $tree[$i];

            $checked = "";
            if (is_array($arr_filing_cabinet_category_id)) {
                if (count($arr_filing_cabinet_category_id) > 0) {
                    $checked = in_array($t->filing_cabinet_category_id, $arr_filing_cabinet_category_id) ? "checked" : "";
                }
            }

            $this->catTree .= "<li class=\"sub-category list-unstyled m-l-15\">";
            $this->catTree .= "<input name=\"filing_cabinet_category_id[]\" $checked type=\"checkbox\" value=" . $t->filing_cabinet_category_id . "><small>&nbsp;&nbsp;" . $t->category_name . "</small>";
            if (isset($t->_children)) {

                $this->catTree .= "<ul class=\"list-unstyled m-l-15\">";
                $this->printTree1($t->_children, ++$r, $t->parent_id, $arr_filing_cabinet_category_id);
                $this->catTree .= "</ul>";
            }
            $this->catTree .= "</li>";
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
        //echo "enter to the store";
        //exit;
        Request::flash();

        $input = Request::all();
        $input['show_file_date'] = date("Y-m-d", strtotime($input['show_file_date']));
        $input['hide_file_date'] = date("Y-m-d", strtotime($input['hide_file_date']));

        //request for flashing the data on failed validation
        //set rules for validation
        $rules = array(
            'file_name' => 'required'
        );

        //make validation
        $validate = Validator::make(Request::all(), $rules);

        //check if validation
        if ($validate->fails()) {
            //echo "dfsf";exit;
            //set validation message
            $messages = $validate->messages();

            //show validation message & redirect
            return Redirect::to('Filing_cabinet/create')->withErrors($validate);
        } else {
            // for image upload
            $file_name = Request::file('file_name');

            if ($file_name != "") {
                //define path
                $path = 'resources/views/Filing_cabinet/filing_cabinet_files/';

                //move file into folder
                $image_name = do_upload($file_name, $path);


                //store image original name
                $input['file_name'] = $image_name;
                //echo "sueecssfully";
            }

            // filling cabinet category


            if (isset($input['filing_cabinet_category_id'])) {

                $filing_cabinet_category_id = $input['filing_cabinet_category_id'];
                $category = ""; //set blank

                foreach ($filing_cabinet_category_id as $filing_cabinet_category_id_str) {
                    //echo $location_str."<br />";
                    if ($category != "") {
                        $category .= ",";
                    }
                    $category .= $filing_cabinet_category_id_str;
                }
                $input['filing_cabinet_category_id'] = $category;
            }


            //echo "<pre>";
            //print_r($input);
            //exit;
            Filing_cabinet_model::create($input);
            // redirect
            Session::flash('message', 'Successfully created!');
            return Redirect::to('Filing_cabinet/create');

            //  echo "<pre>";
            // print_r($input);
            //exit;
        }
        //$input=Request::all();
        //echo "<pre>";
        //print_r($input);
        //exit;
        // echo "enter to the store";
        //exit;
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
        //fetch the data 
        $data = Filing_cabinet_model::find($id);

        //echo "<pre>";
        //print_r($data);
        //exit;
        $id = 0;

        if ($id != "") {
            $category_data = DB::select("SELECT filing_cabinet_category_id, parent_id, filing_cabinet_category_id as filing_cabinet_category_id_tmp,filing_cabinet_category_id as filing_cabinet_category_id_cat_tmp, category_name,category_sort FROM `filing_cabinet_category` where parent_id=$id");
        } else {

            $category_data = DB::select("SELECT filing_cabinet_category_id, parent_id, filing_cabinet_category_id as filing_cabinet_category_id_tmp,filing_cabinet_category_id as filing_cabinet_category_id_cat_tmp, category_name,category_sort FROM `filing_cabinet_category`");
        }

        $tree = $this->buildTree($category_data); //create the bulid tree
        //get category string    
        $str_filing_cabinet_category_id = $data["filing_cabinet_category_id"];

        $arr_filing_cabinet_category_id = array();
        //set location string
        if ($str_filing_cabinet_category_id != "") {
            $arr_filing_cabinet_category_id = explode(",", $str_filing_cabinet_category_id);
        }

        $tree_str = "<ul class=\"list-unstyled\">\n";

        //$tree_str .= '<option value="0">---- Select Root Category -----</option>';
        $this->printTree1($tree, '', '', $arr_filing_cabinet_category_id);
        $tree_str .= $this->catTree;
        $tree_str .="</li>";
        $tree_str .="</ul>";
        $page_tree = $tree_str;

        //echo "<pre>";
        //print_r($page_tree);
        //exit;
        //load the view
        //$data['action'] = 'update';
        //$data['main_content'] = 'Filing_cabinet/Admin/view';
        //$this->load->view('../../includes/Admin/template', $data);
        // echo $arr_filing_cabinet_category_id;
        //exit;
        //echo $str_filing_cabinet_category_id;
        //echo "<pre>";
        //print_r($tree);
        //exit;
// $data = Filing_cabinet_model::find($id);



        return view('Filing_cabinet/edit', ["data" => $data, "page_tree" => $page_tree]);
        //echo "enter to the edit";
        //exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //echo "enter to the update";
        //exit;
        //Request::flash();

        $input = $request::except('_method');
        $input['show_file_date'] = date("Y-m-d", strtotime($input['show_file_date']));
        $input['hide_file_date'] = date("Y-m-d", strtotime($input['hide_file_date']));

        //request for flashing the data on failed validation
        //set rules for validation
//        $rules = array(
//            'file_name' => 'required'
//            
//        );
//
//        //make validation
//        $validate = Validator::make(Request::all(), $rules);
//
//        //check if validation
//        if ($validate->fails()) {
//            //echo "dfsf";exit;
//            //set validation message
//            $messages = $validate->messages();
//
//            //show validation message & redirect
//            return Redirect::to('Filing_cabinet/edit')->withErrors($validate);
//        }
        // for image upload
        $file_name = Request::file('file_name');

        if ($file_name != "") {
            //define path
            $path = 'resources/views/Filing_cabinet/filing_cabinet_files/';

            //move file into folder
            $image_name = do_upload($file_name, $path);


            //store image original name
            $input['file_name'] = $image_name;
            //echo "sueecssfully";
        }

        // filling cabinet category


        if (isset($input['filing_cabinet_category_id'])) {

            $filing_cabinet_category_id = $input['filing_cabinet_category_id'];
            $category = ""; //set blank

            foreach ($filing_cabinet_category_id as $filing_cabinet_category_id_str) {
                //echo $location_str."<br />";
                if ($category != "") {
                    $category .= ",";
                }
                $category .= $filing_cabinet_category_id_str;
            }
            $input['filing_cabinet_category_id'] = $category;
        }

        //fetch post data
        //$filing_category_data = $request::except('_method');
        //update doorway
        Filing_cabinet_model::where('filing_cabinet_id', $id)->update($input);

        // redirect
        //Session::flash('message', 'Successfully updated !');

        return Redirect::to('Filing_cabinet');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $filing_cabinet_data = Filing_cabinet_model::find($id);

        $filing_cabinet_data->delete();

        // redirect
        Session::flash('message', 'Record deleted successfully ');
        return Redirect::to('Filing_cabinet');
    }

    function deleteImage($id) {

        $data = DB::table('filing_cabinet')->where('filing_cabinet_id', $id)->get();

        $picture_path = 'resources/views/Filing_cabinet/filing_cabinet_files/';

        $delete_path = $picture_path . $data[0]->file_name;

        unlink($delete_path);

        //set image field blank
        $input = ['file_name' => ''];

        //update query to delete individual image
        DB::table('filing_cabinet')->where('filing_cabinet_id', $id)->update($input);

        //set falsh message for successful deletion
        Session::flash('message', 'Image Deleted Successfully!');

        return Redirect::to('Filing_cabinet/' . $id . '/edit');
    }

}
