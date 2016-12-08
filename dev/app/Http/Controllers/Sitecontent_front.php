<?php

/** @access             :   public
 * @description          :   Sitecontent - Front level
 * @author               :   Pradip v. <pradip@iwebsquare.com> 
 * @created date         :   18th Oct, 2016
 * @Last updated By      :  
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

class Sitecontent_front extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show($name) {
         //echo "sfds";exit;
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

}
