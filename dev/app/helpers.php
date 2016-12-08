<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * Image or file upload
 * $file = file_name
 * $path = destination path
 * return file's original name
 */

function getBaseUrl() 
{
    // output: /myproject/index.php
    $currentPath = $_SERVER['PHP_SELF']; 

    // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
    $pathInfo = pathinfo($currentPath); 

    // output: localhost
    $hostName = $_SERVER['HTTP_HOST']; 

    // output: http://
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';

    // return: http://localhost/myproject/
    return $protocol.$hostName.$pathInfo['dirname']."/";
}

function do_upload($file, $path) {

    if ($file == "") {

        return false;
    }
    if ($path == "") {

        //set default path
        $path = "files";
    }

    //fetch file original name
    $image_name = $file->getClientOriginalName();

    //move file
    $file->move($path, $image_name);

    //return original name of image
    return $image_name;
}

/**
 * Get dropdown for website Dynemically
 * @pradip valand
 */

function dropdown()
{
?>
    <div class="pull-right col-xs-2 col-sm-2">
            <select class="form-control" name="website_id" id="website_id" onchange="get_id(this.value)" >
                <?php 
                $website_data=get_website_data();
                if (Session::has('website_id')) {
                    //fetch user name from session
                    $website_id = Session::get('website_id');
                }                
                foreach ($website_data as $website) {                    
                ?>
                <option value="<?php echo $website->website_id ?>" <?php echo ($website->website_id == $website_id) ? "Selected" : ""; ?>><?php echo $website->name; ?></option>                                       
                <?php }?>                                              
            </select>
        </div>
<?php
}

/**
 * Get Frontend Menu Dynemically
 * @ pradip valand
 */
function website_url()
{
    //echo Session::get('website_id');
    //$root = "http://".$_SERVER['HTTP_HOST'];
    //$root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
    //$config['base_url']    = $root;
    //echo $config['base_url'];
    
    if(Session::get('website_id') == 1){
        $url=boces_url;
    }
    else if(Session::get('website_id')==2) {
        $url=cte_url;
    }
    else if(Session::get('website_id')==3) {
        $url=eta_url;
    }
    else {
        $url=boces_url;
    }
    //print_r($_SESSION);EXIT;
    
    return $url;
}

/**
 * Get Frontend Menu Dynemically
 */
function getFrontMenu($id = 0) {
   
    //fetch data from sitecontent for menu
    $menu_data = DB::table('site_content')
            ->where('content_type', 'MainPage')
            ->where('on_site', 'yes')
            ->where('status', 'Published')
            ->where('website_id',boces_website_id)
            ->orderBy('page_sort')
            ->get();

    return $menu_data;
}

/**
 * get website data
 * for display website logo
 * @Pradip Valand 28/11/2016
 */
function website_data($id) {

    //fetch data from website
    $Website_data = DB::table('website')
            ->where('website_id', $id)
            ->get();

    return $Website_data;
}

/**
 * get child_menu 
 * @chaitali 06/07/2016
 */
function getChildMenu($id) {

    //fetch data from sitecontent for menu
    $data = DB::table('site_content')
            ->where('parent_id', $id)
            ->where('on_site', 'yes')
            ->where('status', 'Published')
            ->orderBy('page_sort')
            ->get();

    return $data;
}

/*
 * Get page root from url to active menu
 * @Chaitali Darji
 */

function frontGetPageData($page_name) {

    //fetch data from sitecontent for menu
    $data = DB::table('site_content')
            ->where('access_url', $page_name)
            ->get();

    if(count($data) != 0){
    
        //store sitecontent id
        $id = $data[0]->sitecontent_id;
    }
    else{
        $id = 0;
    }

    return $id;
}

/*
 * get root page which parent_id is zero
 * @Chaitali Darji
 */

function frontGetRoot($id) {

    //fetch data from spotlight_story for home page
    $data = DB::table('site_content')
            ->where('sitecontent_id', $id)
            ->get();

     if(count($data) != 0){
        //store sitecontent id
        $parent_id = $data[0]->parent_id;

        if ($parent_id != 0) {

            return frontGetRoot($parent_id);
        } else {
            return $root_id = $data[0]->sitecontent_id;
        }
     }
     else{
         return $id=0;
     }
}

/*
 * Front get slider images and 
 * data from spotlight story
 * for home page
 * @chaitali Darji
 */

function frontGetSpotlightSlideShow() {

    //fetch data from spotlight_story for home page
    $data = DB::table('spotlight_story')
            ->where('active', 'Yes')
            ->orderBy('spotlight_sort')
            ->take(4)
            ->get();

    return $data;
}

/*
 * Get about us data
 * for home page
 * @chaitali Darji
 */

function frontGetAboutUs() {

    //fetch data from sitecontent for menu
    $data = DB::table('site_content')
            ->where('sitecontent_id', boces_website_id)
            ->get();

    return $data;
}

/*
 * Get video data
 * for home page
 * @chaitali Darji
 */

function frontGetVideos() {

    //fetch data from sitecontent for menu
    $data = DB::table('video_intro')
            ->get();

    return $data;
}

/*
 * Get news data
 * for home page
 * @chaitali Darji
 */

function frontGetNews() {

    $news = DB::table('school_news')
            ->join('school_news_images', 'school_news.school_news_id', '=', 'school_news_images.school_news_id')
            ->select('school_news.*', 'school_news_images.*', 'school_news.school_news_id')
            ->orderBy('news_starting')
            ->take(4)
            ->get();

    return $news;
}

/*
 * Get event data
 * for home page
 * @chaitali Darji
 */

function frontGetEvents() {

    $current_date = date("Y-m-d");

    $event = DB::table('calendar_event')
            ->join('calendar_event_images', 'calendar_event.calendar_event_id', '=', 'calendar_event_images.calendar_event_id')
            ->select('calendar_event.*', 'calendar_event_images.*', 'calendar_event.calendar_event_id')
            ->whereRaw("$current_date < calendar_event.event_start")
            ->orderBy('event_start')
            ->take(4)
            ->get();

    return $event;
}

/**
 * Get Location base on type
 * @param field = table field
 * @param type = Yes/No
 * 
 * @return array
 */
function get_location($field, $type) {

    $location = DB::table('location')
            ->where($field, $type)
            ->orderBy('location_sort')
            ->get();

    return $location;
}

/**
 * Get Sitecontent base on updated date
 * Dashboard widget
 * @return array
 */
function getUpdatedPages() {
    
    if (Session::has('website_id')) {

       $website_id = Session::get('website_id');

    }
    
    $updated_pages = DB::table('site_content')
            ->where('website_id',$website_id)
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

    return $updated_pages;
}

/**
 * Get SEO data  from Sitecontent
 * Dashboard widget
 * @return array
 */
function getSeoData() {
    //check if session data exist
   
    if (Session::has('website_id')) {

       $website_id = Session::get('website_id');

    }

    $seo_data = $data = DB::select(
                    DB::raw("SELECT "
                            . "(select count(sitecontent_id) from site_content) as total_sitecontent ,"
                            . "(select count(meta_title) from site_content where meta_title != '') as total_meta_title ,"
                            . "(select count(meta_description) from site_content where meta_description != '') as total_meta_description,"
                            . "(select count(meta_keywords) from site_content where meta_keywords != '')  as total_meta_keywords "
                            . "FROM site_content where website_id = $website_id limit 1"));
    
    //print_r($seo_data);exit;
    
    return $seo_data;
}

/**
 * Get Recently visited pages data  from Sitecontent
 * Dashboard widget
 * @return array
 */
function recentlyVisitedPages() {
    
    
    if (Session::has('website_id')) {

       $website_id = Session::get('website_id');

    }

    $recent_page = $data = DB::select(
                    DB::raw("SELECT * FROM visited_page JOIN site_content "
                            . "ON visited_page.page_id = site_content.sitecontent_id "
                            . "WHERE visitor_page_id IN (SELECT MAX(visitor_page_id) FROM visited_page where website_id = $website_id "
                            . "GROUP BY page_id ) order by visitor_page_id DESC limit 5"));

   // print_r($recent_page);exit;
    
    return $recent_page;
}

/*
 * get all page count
 * Created By :Chaitali Darji
 */

function get_page_count() {

    $recent_page_count = $data = DB::select(
                    DB::raw("SELECT page_id,count(*) as total FROM `visited_page` group by page_id"));

    return $recent_page_count;
}

/**
 * Get Top 5 Recently visited pages data  from Sitecontent
 * Dashboard widget
 * @return array
 */
function visitedPageData() {
    
    if (Session::has('website_id')) {

       $website_id = Session::get('website_id');

    }

    $top_visited = DB::table('visited_page')
            ->join('site_content', 'site_content.sitecontent_id', '=', 'visited_page.page_id')
            ->select(DB::raw('count(visited_page.page_id) as total,visited_page.visitor_page_id,visited_page.ip,'
                            . 'visited_page.page_view,visited_page.created_at,visited_page.updated_at,site_content.sitecontent_id,'
                            . 'site_content.page_title'))
            ->where('site_content.website_id',$website_id)
            ->groupBy('visited_page.page_id')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

    return $top_visited;
}

/**
 * get site visit page
 * @chaitali
 */
function save_site_visit() {

    $ip = get_ip_address();
    $page = get_page_visit();
    $type = Request::segment(1);
    $page_name = Request::segment(2);

    if ($page_name != "" && $type == "page") {

        $id = get_page_id($page_name);
    } else {
        $id = 0;
    }
    $page_id = $id;
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    if ($page_id != NULL) {

        DB::insert('insert into visited_page(ip,page_view,page_id,created_at,updated_at) values(?,?,?,?,?)', 
                    [$ip, $page, $id, $created_at, $updated_at]);
    }
    return true;
}

/**
 * get IP Adress
 * @chaitali 
 */
function get_ip_address() {
    $ip = getenv('HTTP_CLIENT_IP')? :
            getenv('HTTP_X_FORWARDED_FOR')? :
                    getenv('HTTP_X_FORWARDED')? :
                            getenv('HTTP_X_CLUSTER_CLIENT_IP')? :
                                    getenv('HTTP_FORWARDED_FOR')? :
                                            getenv('HTTP_FORWARDED')? :
                                                    getenv('REMOTE_ADDR');

    return $ip;
}

/**
 * get Page visit
 * @chaitali 
 */
function get_page_visit() {
    return url()->current();
}

/**
 * get page id
 * @chaitali 
 */
function get_page_id($name) {
    //echo "in";exit;
    if (Session::has('website_id')) {

       $website_id = Session::get('website_id');
      //echo $web;exit;
    }

    $menu_data = DB::table('site_content')->where('access_url', $name)->where('website_id',$website_id)->get();

    if (count($menu_data) != 0) {
        $sitecontent_id = $menu_data[0]->sitecontent_id;
       //echo $sitecontent_id;exit;
        
        return $sitecontent_id;
    }
    return;
}

/*
 * get page meta data
 * for front-end
 * @Chaitali Darji
 */

function getMetaData($name) {

    $meta_data = DB::table('site_content')->where('access_url', $name)->get();
    return $meta_data;
}

function get_widget_data($name) {
    
    $widget_data = DB::table('widget')->where('name',$name)->get();
    return $widget_data;
}

function getLikeBoxData(){
    
    $like_box = DB::table('widget_like_box_setting')->where('like_box_id','1')->get();
    return $like_box;
}

/*
 * Get video data
 * for home page
 * @chaitali Darji
 */

function get_website_data() {

    //fetch data from sitecontent for menu
    $website = DB::table('website')->get();

    return $website;
}


 /*
     *  set session for website id
     */
function set_website_id($website_id)
    {
        //if new website id != session website id
        
        //check if session data exist
        if (Session::get('website_id')!=$website_id) {
        //echo $website_id;exit;
        //fetch user name from session
        Session::set('website_id',$website_id);
           
        }           
    }
    
