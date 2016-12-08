<?php

/** @access             :   public
 * @description          :   Sitecontent - Admin level
 * @author               :   Chaitali D. <chaitali@iwebsquare.com> 
 * @created date         :   21st Sept, 2016
 * @Last updated By      :   Chaitali D.
 * @version              :   0.1
 */

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Request;
use DB;
use Session;
use App\Sitecontent_model;
use App\Site_content_images;
use App\Site_content_files;
use App\Site_content_links;
use App\Location_model;
use App\Wesite_model;

class Sitecontent extends Controller {
   
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
    public function index($id = 0, $type = "") {
        //if id set or not blank
        if (isset($id) && $id != "type") {
            $parent_id = $id;
        } else {
            $parent_id = 0;
        }
        
        //get website data 
        $website_data=get_website_data();
       
        //print_r($website_data);exit;
        
        //get type of page
        $page_type = ($type != "") ? $type : "MainPage";

        //set breadcum url
        $str = $this->showCatBreadCrumb($parent_id);
        $bread_crumb_link = $str;

        //set root url
        $link = url('/') . "/sitecontent_listing";

        //set home link
        $home_link = "<a href=\"{$link}\">Home</a> &raquo; ";

        //get current page
        $current_page = "";
        if ($id != 0) {
            $current_page = $this->getNameLink($parent_id);
        }

        //create breadcrmb link in one string
        $bread_crumb_link = $home_link . $bread_crumb_link . " " . $current_page;
        
        if (Session::has('website_id')) {

            //fetch user name from session
           $web =  Session::get('website_id');
        }

        //if page_type not set
        if ($page_type != "" && $parent_id == 0) {
            //fetch data from parent_id and page type
            //count subpages
            $data = DB::table('site_content As a')
                    ->select(DB::raw("*, (SELECT count('sitecontent_id') from site_content"
                                    . " WHERE parent_id = a.sitecontent_id) as sub_category_tot"))
                    ->where('a.parent_id', $parent_id)
                    ->where('content_type', $page_type)
                    ->where('website_id',$web)
                    ->orderBy('sitecontent_id')
                    ->get();
        } else {
            //fetch data from parent_id and page type
            //count subpages
            $data = DB::table('site_content As a')
                    ->select(DB::raw("*, (SELECT count('sitecontent_id') from site_content"
                                    . " WHERE parent_id = a.sitecontent_id) as sub_category_tot"))
                    ->where('a.parent_id', $parent_id)
                    ->orderBy('sitecontent_id')
                    ->get();
        }

        //load view
        return view('Sitecontent/index', ['data' => $data, 'bread_crumb_link' => $bread_crumb_link, 'page_type' => $page_type,'website_data'=>$website_data,'web'=>$web]);
    }
    
    public function set_website()
    {
        
        // get website id
       $website_id=  Request::segment(3);
       
       //echo $website_id;exit;
        // set session variable of website id
      set_website_id($website_id);
       
        
        return redirect(url('/') .'/sitecontent');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //fetch all data from sitecontent
        $data = DB::table('site_content')
                ->get();
        //print_r($data);exit;
        
        //build tree for select parent
        $tree = $this->buildTree($data);

        //get page tree
        $tree_str = "<select name='parent_id' class=\"form-control\">\n";
        $tree_str .= '<option value="0">---- Select Page -----</option>';
        $tree_str .= $this->printTree($tree);
        $tree_str .="</select>";

         //fetch tag data from its table
        $web_data = DB::table('website')->get();

        //define array
        $website_array = array();

        foreach ($web_data as $webdata) {

            //tag data in array
            $website_array[$webdata->website_id] = $webdata->name;
        }
        // $web_array = Wesite_model::lists('name', 'website_id');
        //print_r($website_array);exit;
        //store string of tree into one variable
        $page_tree = $tree_str;

        //load view page
        return view('Sitecontent/create', ['page_tree' => $page_tree,'website_array'=>$website_array]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        //auto fill form data when validation fails
        Request::flash();

        //create the validation rules 
        $rules = array(
            'navigation_title' => 'required',
            'page_type' => 'required',
            // 'access_url' => 'required|alpha_dash',
            'page_title' => 'required',
        );

        //validate against the inputs from our form
        $validator = Validator::make(Request::all(), $rules);

        //check if the validator failed 
        if ($validator->fails()) {

            //get the error messages from the validator
            $messages = $validator->messages();

            //failure flash data
            Session::flash('message', 'please try again!');

            //redirect our user back to the form with the errors from the validator
            return Redirect::to('sitecontent/add')->withErrors($validator);
        } else {

            //fetch all data into form
            $input = Request::all();
            
            $sitecontent_id = $input['sitecontent_id'];
            
            $parent_id = $input['parent_id'];
            $website_id = $input['website_id'];
            $navigation_title = $input['navigation_title'];
            $page_title = $input['page_title'];
            $access_url = $input['access_url'];
            $sub_title = $input['sub_title'];
            $page_text = $input['page_text'];
            $page_sort = $input['page_sort'];
            $page_type = $input['page_type'];
            $content_type = $input['content_type'];
            $status = $input['status'];
            $on_site = $input['on_site'];
            $visibility = $input['visibility'];
            $password = $input['password'];
            $meta_title = $input['meta_title'];
            $meta_description = $input['meta_description'];
            $meta_keywords = $input['meta_keywords'];
            $added_by = $input['added_by'];
            $targeted_keyword = $input['targeted_keyword'];
            $created_at = $input['created_at'];
            $updated_at = $input['updated_at'];

            //fetch username from session after login
            if (Session::has('first_name')) {

                $user_name = Session::get('first_name');
                $input['added_by'] = $user_name;
            }
            
            
            
            $in = DB::insert('insert into site_content(parent_id,'
                    . 'navigation_title,page_title,access_url,sub_title,page_text,'
                    . 'page_sort,page_type,content_type,status,on_site,visibility,'
                    . 'password,meta_title,meta_description,meta_keywords,added_by,'
                    . 'targeted_keyword,created_at,updated_at) '
                    . 'values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$parent_id, $navigation_title, $page_title, $access_url,
                    $sub_title, $page_text, $page_sort, $page_type, $content_type,$status,$on_site,$visibility,$password,$meta_title,
                    $meta_description,$meta_keywords,$added_by,$targeted_keyword,$created_at,$updated_at]);
            
            echo $in;exit;
            //insert form data in database
            //$page_create = Sitecontent_model::create($input);
            //echo $page_create;exit;
            $id = DB::getPdo()->lastInsertId();

            //insert blog category
            $sql = array();
            foreach ($website_id as $k => $v) {

                $sql[] = '("' . $id . '", ' . $v . ')';
            }
            $values = implode(',', $sql);
            
            print_r($values);exit;
            DB::statement('insert into site_web_id(sitecontent_id,website_id,_token) values ' . $values);

            if ($page_create) {

                //success flash data
                Session::flash('message', 'Page Created Successfully!');
            } else {
                //failure flash data
                Session::flash('message', 'please try again!');
            }

            //redirect to listing
            return redirect('sitecontent');
        }
    }

    /*
     * Check password for front page
     * @chaitali Darji
     */

    public function check_password($name, Request $request) {

        //get form data
        $password_data = Request::all();

        //store password 
        $password = $password_data['password'];

        //fetch page data
        $protected_page_data = Sitecontent_model::where('password', $password)
                ->where('access_url', $name)
                ->get();

        if (count($protected_page_data) > 0) {

            //get child pages by name
            $page_title = $protected_page_data[0]->page_title;
            $page_data_by_title = $this->frontGetChildPagesByName($page_title);

            //get child pages by id
            $site_id = $page_data_by_title[0]->sitecontent_id;
            $subpage_data = $this->frontGetChildPages($site_id);

            $page = $protected_page_data;

            $bread_crumb_link = "";

            //Fetch pdf files by sitecontent id
            $sitecontent_pdf = $this->frontGetPdfName($site_id);

            //Fetch links by sitecontent id
            $sitecontent_link = $this->frontGetLinkName($site_id);

            //load view
            return view('subpage_front', ['subpage_data' => $subpage_data, 'bread_crumb_link' => $bread_crumb_link,
                'page' => $page, 'sitecontent_pdf' => $sitecontent_pdf, 'sitecontent_link' => $sitecontent_link]
            );
        } else {
            return view('password_protected', ['name' => $name]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name) {

        //get left menu
        $sub_page = $this->get_sub_contentByName($name);

        //REDIRECT 404 PAGE SUBPAGE NOT AVAILIABLE
        if (count($sub_page) == 0) {
            return view('errors/404');
        }

        //Check the visibility of page
        //if page password protected
        if ($sub_page[0]->visibility == "Password protected") {

            //load form of password protected
            return view('password_protected', ['name' => $name]);
        } else {

            //the code below wel reload the current data
            $page = $this->get_sub_contentByName($name);

            //REDIRECT 404 PAGE
            if (count($page) == 0) {
                return view('errors/404');
            }
        }

        //get sitecontent_id for fetch pdf files
        $Sitecontent_id = $sub_page[0]->sitecontent_id;

        //Fetch pdf files by sitecontent id
        $sitecontent_pdf = $this->frontGetPdfName($Sitecontent_id);

        //Fetch links by sitecontent id
        $sitecontent_link = $this->frontGetLinkName($Sitecontent_id);

        //get breadcrum link
        $str = $this->frontShowCatBreadCrumb($Sitecontent_id);

        //if breadcrum not blank add open page name in last
        if ($str != "") {
            $bread_crumb_link = $str . "<a href='" . url('/') . '/page/' . $sub_page[0]->access_url . "'>" . $sub_page[0]->navigation_title . "</a>";
        } else {
            $bread_crumb_link = "<a href='" . url('/') . '/page/' . $sub_page[0]->access_url . "'>" . $sub_page[0]->navigation_title . "</a>";
        }

        // if page type is goto page then open that view page
        if ($sub_page[0]->page_type == "Goto Page") {
            
        } else {

            // if page type is typical page then fetch their parent id 
            $parent_id = $sub_page[0]->parent_id;

            //if parent id is not zero
            if ($parent_id != 0) {

                //get count of child pages
                $site_id = $sub_page[0]->sitecontent_id;
                $count_sub_data = $this->frontGetChildPages($site_id);

                //if child page count is grater than zero
                if (count($count_sub_data) > 0) {

                    //get all child page data
                    $subpage_data = $this->frontGetChildPages($site_id);

                    //load view
                    return view('subpage_front', ['subpage_data' => $subpage_data, 'bread_crumb_link' => $bread_crumb_link,
                        'page' => $page, 'sitecontent_pdf' => $sitecontent_pdf, 'sitecontent_link' => $sitecontent_link]
                    );
                }
                //if child is not available
                else {

                    // get parent's child data
                    $subpage_data = $this->frontGetChildPages($parent_id);

                    //load view
                    return view('subpage_front', ['subpage_data' => $subpage_data, 'bread_crumb_link' => $bread_crumb_link,
                        'page' => $page, 'sitecontent_pdf' => $sitecontent_pdf, 'sitecontent_link' => $sitecontent_link]
                    );
                }
            }
            // if parent id is zero
            else {

                //get count of child pages
                $site_id = $sub_page[0]->sitecontent_id;
                $count_sub_data = $this->frontGetChildPages($site_id);

                //if child page count is grater than zero
                if (count($count_sub_data) > 0) {

                    //get all child page data
                    $subpage_data = $this->frontGetChildPages($site_id);

                    //load view
                    return view('subpage_front', ['subpage_data' => $subpage_data, 'bread_crumb_link' => $bread_crumb_link,
                        'page' => $page, 'sitecontent_pdf' => $sitecontent_pdf, 'sitecontent_link' => $sitecontent_link]
                    );
                }
                // if child not avilable
                else {

                    $subpage_data = array();

                    //load view
                    return view('subpage_front', ['subpage_data' => $subpage_data, 'bread_crumb_link' => $bread_crumb_link,
                        'page' => $page, 'sitecontent_pdf' => $sitecontent_pdf, 'sitecontent_link' => $sitecontent_link]
                    );
                }
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        //fetch data from sitecontent_id
        $data = Sitecontent_model::where('sitecontent_id', $id)
                ->get();

        //load view
        return view('Sitecontent/edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        //auto fill form data when validation fails
        Request::flash();

        // create the validation rules 
        $rules = array(
            'navigation_title' => 'required',
            'page_type' => 'required',
            //        'access_url' => 'required|alpha_dash',
            'page_title' => 'required',
        );

        //validate against the inputs from our form
        $validator = Validator::make(Request::all(), $rules);

        //check if the validator failed 
        if ($validator->fails()) {

            //get the error messages from the validator
            $messages = $validator->messages();

            //failure flash data
            Session::flash('message', 'please try again !');

            //redirect our user back to the form with the errors from the validator
            return Redirect::to('sitecontent/edit/' . $id)->withErrors($validator);
        } else {

            //fetch all data into form
            $input = Request::all();

            //update query
            $update_result = Sitecontent_model::where('sitecontent_id', $id)
                    ->update($input);

            if ($update_result) {

                //success flash data
                Session::flash('message', 'Page Updated Successfully!');
            } else {
                //failure flash data
                Session::flash('message', 'please try again!');
            }

            //fetch data from sitecontent_id
            $data = Sitecontent_model::where('sitecontent_id', $id)->get();

            //load view
            return view('Sitecontent/edit', ['data' => $data]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        //delete data from storage
        Sitecontent_model::destroy($id);

        //delete images from storage
        Site_content_images::where('sitecontent_id', $id)->delete();

        //delete file fron storage
        Site_content_files::where('sitecontent_id', $id)->delete();

        //delete link
        Site_content_links::where('sitecontent_id', $id)->delete();

        //success flash data
        Session::flash('message', 'Record Deleted Successfully!');

        //redirect to routes
        return redirect('sitecontent');
    }

    /**
     * build Tree structure
     * @param array $data
     * @param type $parent
     * @return type
     */
    public function buildTree(Array $data, $parent = 0) {
        $tree = array();
        foreach ($data as $d) {
            if ($d->parent_id == $parent) {
                $children = $this->buildTree($data, $d->sitecontent_id);

                // set a trivial key
                if (!empty($children)) {
                    $d->_children = $children;
                }
                $tree[] = $d;
            }
        }
        return $tree;
    }

    /**
     * Print tree in string
     * @param type $tree
     * @param int $r
     * @param type $p
     */
    public function printTree($tree, $r = 0, $p = null) {
        static $str = "";
        foreach ($tree as $i => $t) {
            $dash = ($t->parent_id == 0) ? '' : str_repeat('-', $r) . ' ';
            $str .= "<option value=" . $t->sitecontent_id . ">" . $dash . $t->navigation_title . "</option>";
            if ($t->parent_id == $p) {
                // reset $r
                $r = 0;
            }
            if (isset($t->_children)) {
                $this->printTree($t->_children, ++$r, $t->parent_id);
            }
        }

        return $str;
    }

    /**
     * get category Tree ID
     * @param type $catID
     * @return type
     */
    public function getCategoryTreeIDs($catID) {

        //fetch data by sitecontent_id
        $row = Sitecontent_model::where('sitecontent_id', $catID)->get();

        $parent_id = "";
        if (count($row) > 0) {
            $parent_id = ($row[0]->parent_id != "") ? $row[0]->parent_id : 0;
        }
        //print_r($row);exit;
        $path = array();
        if (!$parent_id == '') {
            $path[] = $parent_id;
            $path = array_merge($this->getCategoryTreeIDs($parent_id), $path);
        }
        return $path;
    }

    /**
     * showCatBreadCrumb
     * @param type $catID
     */
    public function showCatBreadCrumb($catID) {

        $array = $this->getCategoryTreeIDs($catID);
        //print_r($array);exit;

        $numItems = count($array);
        $str = "";
        for ($i = 0; $i <= $numItems - 1; $i++) {

            $str .= "<a href=\"{$array[$i]}\">" . $this->getNameLink($array[$i]) . "</a> &raquo; ";
        }
        return $str;
    }

    /**
     * Get access_url for link
     * @param type $catID
     * @return type
     */
    public function getUrlLink($catID) {

        if ($catID != 0) {

            //fetch data of specific sitecontent_id
            $row = Sitecontent_model::where('sitecontent_id', $catID)->get();

            //set access_url
            $access_url = ($row[0]->access_url != "") ? $row[0]->access_url : "";

            //return access_url
            return $access_url;
        }
        return true;
    }

    /**
     * Get Navigation title
     * @param type $catID
     * @return type
     */
    public function getNameLink($catID) {

        if ($catID != 0) {

            //fetch data using sitecontent_id
            $row = Sitecontent_model::where('sitecontent_id', $catID)->get();

            //set navigation title
            $navigation_title = ($row[0]->navigation_title != "") ? $row[0]->navigation_title : "";

            //return navigation title
            return $navigation_title;
        }
        return true;
    }

    /*
     * Show the form for creating a new image.
     * in perticular sitecontent_id
     */

    public function createImage($id) {

        //fetch image data from sitecontent_id
        $data = Site_content_images::where('sitecontent_id', $id)->get();

        //load view
        return view('Sitecontent/create_image', ['data' => $data, 'id' => $id]);
    }

    /*
     * Store a newly created image in storage.
     * in a particular sitecontent_id 
     */

    public function storeImage($id) {

        // Tell the validator that this file should be an image
        $rules = array(
            'site_images' => 'image|mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
        );

        //validate against the inputs from our form
        $validator = Validator::make(Request::all(), $rules);

        //check if the validator failed 
        if ($validator->fails()) {

            //get the error messages from the validator
            $messages = $validator->messages();

            //failure flash data
            Session::flash('message', 'please try again!');

            //redirect our user back to the form with the errors from the validator
            return Redirect::to('sitecontent/create_image/' . $id)->withErrors($validator);
        } else {

            //request all record 
            $input = Request::all();

            $file_name = Request::file('site_images');

            if ($file_name != "") {

                //define path
                $path = 'resources/views/Sitecontent/Site_content_files/';

                //move file into folder
                $image_name = do_upload($file_name, $path);

                //store image original name
                $input['site_images'] = $image_name;
            }

            //store sitecontent id
            $input['sitecontent_id'] = $id;

            //insert record
            Site_content_images::create($input);

            //set validation message for successful insertion
            Session::flash('message', 'Image Inserted Successfully!');

            //redirect
            return redirect('sitecontent/create_image/' . $id);
        }
    }

    /**
     * Remove the specified image from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyImage($sitecontent_id, $site_content_images_id) {

        //select query
        $data = Site_content_images::where('site_content_images_id', $site_content_images_id)->get();

        $picture_path = 'resources/views/Sitecontent/Site_content_files/';

        $delete_file = $picture_path . $data[0]->site_images;

        //delete image from folder
        unlink($delete_file);

        //delete image
        Site_content_images::where('site_content_images_id', $site_content_images_id)->delete();

        //success flash data
        Session::flash('message', 'Image Deleted Successfully!');

        //redirect to routes
        return redirect('sitecontent/create_image/' . $sitecontent_id);
    }

    /*
     * Show the form for creating a new File.
     * in perticular sitecontent_id
     */

    public function createFile($id) {

        //fetch image data from sitecontent_id
        $data = Site_content_files::where('sitecontent_id', $id)->get();

        //load view
        return view('Sitecontent/create_file', ['data' => $data, 'id' => $id]);
    }

    /*
     * Store a newly created file in storage.
     * in a particular sitecontent_id 
     */

    public function storeFile($id) {

        // Tell the validator that this file should be an image
        $rules = array(
            'file_name' => 'required|max:10000' // max 10000kb
        );

        //validate against the inputs from our form
        $validator = Validator::make(Request::all(), $rules);

        //check if the validator failed 
        if ($validator->fails()) {

            //get the error messages from the validator
            $messages = $validator->messages();

            //failure flash data
            Session::flash('message', 'please try again!');

            //redirect our user back to the form with the errors from the validator
            return Redirect::to('sitecontent/create_file/' . $id)->withErrors($validator);
        } else {

            //request all record 
            $input = Request::all();

            $file_name = Request::file('file_name');

            if ($file_name != "") {

                $path = 'resources\views\Sitecontent\Site_content_files';

                //move file into folder
                $image_name = do_upload($file_name, $path);

                //store image name
                $input['file_name'] = $image_name;
            }

            //store sitecontent id
            $input['sitecontent_id'] = $id;

            //insert record
            Site_content_files::create($input);

            //set validation message for successful insertion
            Session::flash('message', 'File Inserted Successfully!');

            //redirect
            return redirect('sitecontent/create_file/' . $id);
        }
    }

    /**
     * Show the form for editing the specified file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editFile($id, $file_Id) {

        //fetch data from sitecontent_id
        $data = Site_content_files::where('site_content_files_id', $file_Id)->where('sitecontent_id', $id)->get();

        //fetch image data from sitecontent_id
        $files = Site_content_files::where('sitecontent_id', $id)->get();

        //load view
        return view('Sitecontent/edit_file', ['data' => $data, 'files' => $files, 'id' => $id]);
    }

    /*
     * update already created file in storage.
     * in a particular sitecontent_id 
     */

    public function updateFile($id, $file_id) {

        // Tell the validator that this file should be an image
        $rules = array(
            'file_name' => 'max:10000' // max 10000kb
        );

        //validate against the inputs from our form
        $validator = Validator::make(Request::all(), $rules);

        //check if the validator failed 
        if ($validator->fails()) {

            //get the error messages from the validator
            $messages = $validator->messages();

            //failure flash data
            Session::flash('message', 'please try again!');

            //redirect our user back to the form with the errors from the validator
            return Redirect::to('sitecontent/edit_file/' . $id . '/' . $file_id)->withErrors($validator);
        } else {

            //request all record 
            $input = Request::all();

            $file_name = Request::file('file_name');

            if ($file_name != "") {

                //define path
                $path = 'resources\views\Sitecontent\Site_content_files';

                //move file into folder
                $image_name = do_upload($file_name, $path);

                //store file original name
                $input['file_name'] = $image_name;
            }

            //store sitecontent id
            $input['sitecontent_id'] = $id;

            //update file
            $update_result = Site_content_files::where('site_content_files_id', $file_id)
                    ->where('sitecontent_id', $id)
                    ->update($input);

            //set validation message for successful insertion
            Session::flash('message', 'File Updated Successfully!');

            //redirect
            return redirect('sitecontent/edit_file/' . $id . '/' . $file_id);
        }
    }

    /**
     * Remove the specified file from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyFile($sitecontent_id, $site_content_file_id) {

        //fetch data from sitecontent_id
        $data = Site_content_files::where('site_content_files_id', $site_content_file_id)
                ->where('sitecontent_id', $sitecontent_id)
                ->get();

        $picture_path = 'resources/views/Sitecontent/Site_content_files/';

        $delete_file = $picture_path . $data[0]->file_name;

        unlink($delete_file);

        //delete file fron storage
        Site_content_files::where('site_content_files_id', $site_content_file_id)
                ->where('sitecontent_id', $sitecontent_id)
                ->delete();

        //success flash data
        Session::flash('message', 'File Deleted Successfully!');

        //redirect to routes
        return redirect('sitecontent/create_file/' . $sitecontent_id);
    }

    /*
     * Show the form for creating a new Link.
     * in perticular sitecontent_id
     */

    public function createLink($id) {

        //fetch link data from sitecontent_id
        $data = Site_content_links::where('sitecontent_id', $id)->get();

        //load view
        return view('Sitecontent/create_link', ['data' => $data, 'id' => $id]);
    }

    /*
     * Store a newly created link in storage.
     * in a particular sitecontent_id 
     */

    public function storeLink($id) {

        // validation rules
        $rules = array(
            'website_url' => 'required'
        );

        //validate against the inputs from our form
        $validator = Validator::make(Request::all(), $rules);

        //check if the validator failed 
        if ($validator->fails()) {

            //get the error messages from the validator
            $messages = $validator->messages();

            //failure flash data
            Session::flash('message', 'please try again!');

            //redirect our user back to the form with the errors from the validator
            return Redirect::to('sitecontent/create_link/' . $id)->withErrors($validator);
        } else {

            //request all record 
            $input = Request::all();

            //set sitecontent_id
            $input['sitecontent_id'] = $id;

            //insert record
            Site_content_links::create($input);

            //set validation message for successful insertion
            Session::flash('message', 'Link Inserted Successfully!');

            //redirect
            return redirect('sitecontent/create_link/' . $id);
        }
    }

    /**
     * Remove the specified file from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyLink($sitecontent_id, $site_content_link_id) {

        //delete link
        Site_content_links::where('site_content_links_id', $site_content_link_id)->delete();

        //success flash data
        Session::flash('message', 'Link Deleted Successfully!');

        //redirect to routes
        return redirect('sitecontent/create_link/' . $sitecontent_id);
    }

    /**
     * Fetch Data Rows data from the database by page name
     * possibility to mix search, filter and order
     * @return array
     */
    public function get_sub_contentByName($name) {

        //get data for subpage
        $data = Sitecontent_model::where('access_url', $name)
                ->where('status', 'Published')
                ->get();

        return $data;
    }

    /*
     * Get pdf list from sitecontent id
     * @chaitali Darji 
     */

    function frontGetPdfName($id) {

        //get pdf data for subpage
        $data = Site_content_files::where('sitecontent_id', $id)->get();

        return $data;
    }

    /*
     * Get pdf list from sitecontent id
     * @chaitali Darji 
     */

    function frontGetLinkName($id) {

        //get pdf data for subpage
        $data = Site_content_links::where('sitecontent_id', $id)->get();

        return $data;
    }

    /**
     * showCatBreadCrumb for front
     * link with access_url
     * @param type $catID
     */
    public function frontShowCatBreadCrumb($catID) {

        $array = $this->getCategoryTreeIDs($catID);
        //print_r($array);exit;

        $numItems = count($array);
        $str = "";
        for ($i = 0; $i <= $numItems - 1; $i++) {

            $str .= "<a href=" . url('/') . '/page/' . $this->getUrlLink($array[$i]) . ">" . $this->getNameLink($array[$i]) . "</a> &nbsp; / &nbsp; ";
        }
        return $str;
    }

    /*
     * get subpages of page for front-end
     * @created by: chaitali Darji
     */

    function frontGetChildPagesByName($name) {

        //get data for subpage
        $data = Sitecontent_model::where('page_title', $name)->where('status', 'Published')->get();

        return $data;
    }

    /*
     * get subpages of page for front-end
     * @created by: chaitali Darji
     */

    function frontGetChildPages($id) {

        //get data for subpage
        $data = Sitecontent_model::where('parent_id', $id)->where('status', 'Published')->get();

        return $data;
    }

}
