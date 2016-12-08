<!doctype html>
<html ng-app="app">
    <head>
        <meta charset="UTF-8">
        <title>wswheboces Admin</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
        <link rel="apple-touch-icon" href="<?php echo url('/'); ?>/assets/ico/152.png">
        <meta name="apple-mobile-web-app-title" content="">
        <meta name="mobile-web-app-capable" content="yes">
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="copyright" content="">

                <meta name="keywords" content="">
<!--------------------------- Admin Style-Sheet------------------------------>
        {!! Html::style('resources/assets/plugins/bootstrap/css/bootstrap.min.css') !!}
        {!! Html::style('resources/assets/css/core.css') !!}
        {!! Html::style('resources/assets/css/components.css') !!}
        {!! Html::style('resources/assets/css/icons.css') !!}
        {!! Html::style('resources/assets/css/admin-custom.css') !!}
        {!! Html::style('resources/assets/css/style.css') !!}
        {!! Html::style('resources/assets/css/responsive.css') !!}
        {!! Html::style('resources/assets/css/animate.css') !!}
        {!! Html::style('resources/assets/css/morris.css') !!}
        {!! Html::style('resources/assets/css/new-css.css') !!}

        <!--------------------------- JQX Widgets Styles ----------------------------->
        {!! Html::style('resources/assets/plugins/jqwidgets/styles/jqx.base.css') !!}
        {!! Html::style('resources/assets/plugins/jqwidgets/styles/jqx.bootstrap.css') !!}
        <link href="http://localhost/boces_cms/assets/plugins/jqwidgets/styles/custom.css" rel="stylesheet">

        <!---------------- Common js ----------------->
        {!! Html::script('resources/assets/js/jquery-1.11.1.min.js') !!}
        {!! Html::script('resources/assets/js/jquery-ui.js') !!}

        {!! Html::script('resources/assets/plugins/bootstrap/js/bootstrap.min.js') !!}
        {!! Html::script('resources/assets/plugins/bootstrap/js/bootstrap-hover-dropdown.min.js') !!}


    </head>
    
   
    <!--- segment for active left menu --->
    <?php 
     
        if (Session::get('id') == '') {
            Redirect::to('admin')->send();
        }
    
    $method = Request::segment(1); ?>
  
    <!------------ Body Start ----------->
    <body class="fixed-left">
        <div id="wrapper">
            <div class="topbar">
                <div class="topbar-left">
                    <?php 
                        if (Session::has('website_id')) {

                           $web = Session::get('website_id');

                        } ?>
                    
                    <div class="text-center"> 
                        <a href="#" class="logo">
                            <span class="logo-icon">&nbsp;</span> 
                            <?php
                            //fetch data from the website table
                           $data=website_data($web);
                           //print_r($data);
                           ?>
                           <!--Display website logo-->
                           <img src="<?php echo url('/') . '/resources/views/Website/website_files/'. $data[0]->website_logo ?>" alt="" title="" class="logo-img">
                           <?php
                            ?>
                        </a> 
                    </div>
                </div>
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <button class="menu-icon-button open-left pull-left"> <i class="ion-navicon"></i> </button>
                            <ul class="nav navbar-nav pull-left m-l-10">
                                <li class="dropdown hidden-md hidden-sm hidden-xs mob-none-icon"> 
                                    <a href="javascript:void(0);" data-target="#" title="Comments" class="dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="true"> 
                                        <i class="ti-comment"></i> 
                                        <span class="badge badge-xs badge-info">0</span> 
                                    </a> 
                                </li>
                                <li class="dropdown hidden-md hidden-sm hidden-xs mob-none-icon"> 
                                    <a href="javascript:void(0);" data-target="#" title="New" class="dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="true"> 
                                        <i class="ti-plus"></i> New 
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li><a href="#" class="list-group-item">Add News</a></li>
                                        <li><a href="#" class="list-group-item">Add Event</a></li>
                                        <li><a href="#" class="list-group-item">Add File</a></li>
                                        <li><a href="#" class="list-group-item">Add New Administrator</a></li>
                                    </ul>
                                </li>
                            </ul>
                           
                            <ul class="nav navbar-nav navbar-right pull-right m-l-10">
                                <li class="dropdown"> 
                                    <a href="javascript:void(0);" class="dropdown-toggle waves-effect profile" data-toggle="dropdown"   aria-expanded="true">
                                        <img src="<?php echo url('/'); ?>/resources/assets/images/user-icon.png" alt="user-img" class="img-circle"> 
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php if (Session::has('name')) {
                                            $name = Session::get('name');
                                            ?>
                                            <li><a href="#">Logged in as: <?php echo $name; ?></a></li>
                                            <?php } ?>
                                            
                                            <?php if(Session::has('id')){

                                                    $id = Session::get('id'); }
                                                    //echo "value of the".$id;
                                                    //exit;
                                                    ?>
                                        <li><a href="{{url('/')}}/user/profile/{{$id}}"><i class="ti-user m-r-5"></i>Profile</a></li>
                                        <li><a href="#"><i class="ti-settings m-r-5"></i> Settings</a></li>
                                        <li><a href="#"><i class="ti-lock m-r-5"></i> Lock screen</a></li>
                                        <li><a href="{{ url('logout')}}"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-------------------------------- Left Navigation Start ------------------------------------->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <div id="sidebar-menu">
                        <?php
                        $controller = Request::segment(1);
                        $method = Request::segment(2);
                        $method1 = Request::segment(3);
                        ?>
                        <ul>
                            
                            <!-------------------------------------DASHBOARD START-------------------------------------------->
                            <li>
                                <?php if (Session::has('website_id')) {
                                    $web = Session::get('website_id');
                                } ?>
                                
                                    <a href="{{ url('dashboard')}}" title="Dashboard" class="active waves-effect waves-light">
                                        <i class="fa fa-tachometer"></i> 
                                        <span>Dashboard</span>
                                    </a>
                               
                                    
                            </li>
                            <!-------------------------------------DASHBOARD END---------------------------------------------->
                            
                            <?php
                             if(Session::get('website_id') == 1 || (Session::get('website_id') == 2)|| (Session::get('website_id') == 3)){
                                ?>
                            <li class="has_sub"><a href="javascript:void(0)" title="Site Content" class="<?php echo (($controller == "sitecontent") || ($controller == "sitecontent_listing")) ? "active" : ""; ?> waves-effect waves-light"><i class="fa fa-globe"></i> <span>Webpages - Site Content</span></a>
                                <ul>
                                    <li><a class="<?php echo (($controller == "sitecontent") || ($controller == "sitecontent_listing") && (($method == "add") || ($method == "edit") || ($method == "") || ($method == "type"))) ? "active" : ""; ?>" href="<?php echo url('/'); ?>/sitecontent">Site Content</a></li>
                                </ul>
                            </li>
                            <?php
                            }?>
                            <li class="has_sub"><a href="javascript:void(0)" title="Administration Area" class="<?php echo ($controller == "user" || $controller == "user_permission" || $controller == "Roles" ) ? "active" : ""; ?> waves-effect waves-light"><i class="fa fa-key"></i> <span>Administration Area</span></a>
                                <ul>
                                    <li><a class="<?php echo ($controller == "user" ) && ($method=="add" || $method=="edit" || $method=="") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/user">User Information</a></li>
                                    <li><a class="<?php echo ($controller == "user_permission") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/user_permission">Permission</a></li>
                                    <li><a class="<?php echo ($controller == "Roles") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Roles">Role</a></li> 
                                </ul>
                            </li>
                            <?php
                             if(Session::get('website_id') == 1)  {
                                ?>
                            <li class="has_sub"><a href="javascript:void(0)" title="Location" class="<?php echo ($controller == "location_listing") ? "active" : ""; ?> waves-effect waves-light"><i class="fa fa-map-pin"></i> <span>Location</span></a>
                                <ul>
                                    <li><a class="<?php echo ($controller == "location_listing") || ($controller == "location_insert") || ($controller == "location_update") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/location_listing">Maintain Location</a></li>
                                   <li><a class="<?php echo ($controller == "Video_intro") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Video_intro">Video Intros</a></li> 
                                </ul>
                            </li>
                            <?php
                             }
                            ?>
                            <?php
                            if(Session::get('website_id') == 1){
                                ?>
                            <li class="has_sub"><a href="javascript:void(0)" title="School News" class="<?php echo ($controller == "schoolnews") ? "active" : ""; ?> waves-effect waves-light"><i class="fa fa-newspaper-o"></i> <span>School News</span></a>
                                <ul>
                                    <li><a class="<?php echo ($controller == "schoolnews" && $method == "add") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/schoolnews/add">Add News</a></li>
                                    <li><a class="<?php echo (($controller == "schoolnews") || ($controller == "school_news_intro") || ($controller == "getNewsSearch")) && ($method == "update" || $method == "list" || $method == "create_image" || $method == "create_file" || $method == "create_link" || $method == "delete" || $method == "") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/schoolnews/list">Edit News</a></li>
                                </ul>
                            </li>
                             <?php
                             }
                             ?>
                            <?php
                             if(Session::get('website_id') == 1)  {
                                 ?>
                            <li class="has_sub"><a href="javascript:void(0)" title="Calendar_event" class="<?php echo ($controller == "calendar_event" || $controller == "calendar_category") ? "active" : ""; ?> waves-effect waves-light"><i class="fa fa-calendar"></i> <span>Calendar System</span></a>
                                <ul>
                                    <li><a class="<?php echo ($controller == "calendar_category") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/calendar_category">Calendar Category</a></li>
                                    <li><a class="<?php echo ($controller == "calendar_event" && $method == "add") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/calendar_event/add">Add Event</a></li>
                                    <li><a class="<?php echo ($controller == "calendar_event") && ($method == "" || $method == "edit" || $method == "getEventSearch" || $method == "create_image" || $method == "create_file" || $method == "create_link" || $method == "create_recur" || $method == "delete_view") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/calendar_event">Edit Event</a></li>
                                </ul>
                            </li>
                            <?php
                             }
                             ?>
                            <?php
                             if(Session::get('website_id') == 1)  {
                                 ?>
                            <li class="has_sub"><a href="javascript:void(0)" title="Job" class="<?php echo ($controller == "job" || $controller == "job_category") ? "active" : ""; ?> waves-effect waves-light"><i class="fa fa-users"></i> <span>Job Opportunity System</span></a>
                                <ul>
                                    <li><a class="<?php echo ($controller == "job_category") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/job_category">Job Category</a></li>
                                    <li><a class="<?php echo ($controller == "job" && $method == "add") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/job/add">Add Job Posting</a></li>
                                    <li><a class="<?php echo ($controller == "job") && ($method == "" || $method == "getJobSearch" || $method == "edit" || $method == "add_file" || $method == "add_link" || $method == "intro" || $method == "edit_intro") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/job">Edit Job Posting</a></li>
                                </ul>
                            </li>
                            <?php
                             }
                             ?>
                            <?php
                             if(Session::get('website_id') == 1)  {
                                 ?>
                            <li class="has_sub"><a href="javascript:void(0)" title="School Board Members" class="<?php echo ($controller == "school_board_members") ? "active" : ""; ?> waves-effect waves-light"><i class="fa fa-user-plus"></i> <span>School Board Members</span></a>
                                <ul>
                                    <li><a class="<?php echo ($controller == "school_board_members" && $method == "add") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/school_board_members/add">Add Board Member</a></li>
                                    <li><a class="<?php echo ($controller == "school_board_members" || $controller == "school_board_intro" ) && ($method == "" || $method == "edit") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/school_board_members">Edit Board Member</a></li>
                                </ul>
                            </li>
                            <?php
                             }
                             ?>
                            <?php
                             if(Session::get('website_id') == 1)  {
                                 ?>
                            <li class="has_sub"><a href="javascript:void(0)" title="Spotlight" class="<?php echo ($controller == "spotlight") ? "active" : ""; ?> waves-effect waves-light"><i class="fa fa-lightbulb-o"></i> <span>Spotlight Story</span></a>
                                <ul>
                                    <li><a class="<?php echo ($controller == "spotlight" && $method == "add") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/spotlight/add">Add Story</a></li>
                                    <li><a class="<?php echo ($controller == "spotlight" || $controller == "getStorySearch") && ($method == "" || $method == "edit") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/spotlight">Edit Story</a></li>
                                </ul>
                            </li>
                            <?php
                             }
                             ?>
                            <?php
                             if(Session::get('website_id') == 1)  {
                                 ?>
                            <li class="has_sub"><a href="javascript:void(0)" title="Site Images" class="<?php echo ($controller == "banner_listing") ? "active" : ""; ?> waves-effect waves-light"><i class="fa fa-anchor"></i> <span>Site Images</span></a>
                                <ul>
                                    <li><a class="<?php echo ($controller == "banner_listing" || $controller == "banner_insert" || $controller == "banner_edit") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/banner_listing">Home Page Banners</a></li>
                                </ul>
                            </li>
                            <?php
                             }
                             ?>
                            <?php
                             if(Session::get('website_id') == 1)  {
                                 ?>
                            <li class="has_sub"><a href="javascript:void(0)" title="Menu" class="<?php echo ($controller == "menu" || $controller == "menu_category") ? "active" : ""; ?> waves-effect waves-light"><i class="fa fa-coffee"></i> <span>School Lunch-Menus</span></a>
                                <ul>
                                    <li><a class="<?php echo ($controller == "menu_category") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/menu_category">Menu Category</a></li>
                                    <li><a class="<?php echo ($controller == "menu" && $method=="add")||($controller == "menu" && $method=="menucopyview") || ($controller == "menu_intro") &&($method=="weekend_setting_updates" || $method=="" || $method=="edit" || $method=="ical_setting") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/menu/add">Add Menu</a></li>
                                    <li><a class="<?php echo ($controller == "menu" && $method=="") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/menu">List Menu</a></li>
                                </ul>
                            </li>
                            <?php
                             }
                             ?>
                            <?php
                             if(Session::get('website_id') == 1)  {
                                 ?>
                             <li class="has_sub"><a href="javascript:void(0)" title="Driving Direction" class="<?php echo ($controller == "direction") ? "active" : ""; ?> waves-effect waves-light"><i class="fa fa-compass"></i><span>Driving Directions</span></a>
                                <ul>
                                    <li><a class="<?php echo ($controller == "direction" && $method == "add") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/direction/add">Add New Directions</a></li>
                                    <li><a class="<?php echo ($controller == "direction" || $controller == "direction_intro") && ($method == "" || $method == "edit") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/direction">Edit Directions</a></li>
                                </ul>
                            </li>
                            <?php
                             }
                             ?>
                            <?php
                             if(Session::get('website_id') == 1)  {
                                 ?>
                             <li class="has_sub"><a href="javascript:void(0)" title="Quick Information" class="<?php echo ($controller == "Alert_message") ? "active" : ""; ?> waves-effect waves-light"><i class="fa fa-info-circle"></i><span>Quick Information</span></a>
                                <ul>
                                    <li><a class="<?php echo ($controller == "alert_message") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/alert_message">Information Alert System</a></li>
                                    <li><a class="<?php echo ($controller == "quicklinks") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/quicklinks">Quick Links</a></li>  
                                    <li><a class="<?php echo ($controller == "home_scroll") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/home_scroll">Home Scroll</a></li> 
                                </ul>
                            </li>
                            <?php
                             }
                             ?>
                            <?php
                             if(Session::get('website_id') == 1 || (Session::get('website_id') == 2)|| (Session::get('website_id') == 3))  {
                                 ?>
                            <li class="has_sub"><a href="javascript:void(0)" title="Staff Member" class="<?php echo ($controller == "Staff_members" || $controller == "Staff_members") ? "active" : ""; ?> waves-effect waves-light"><i class="fa fa-users"></i> <span>Staff Members</span></a>
                                <ul>
                                    <li><a class="<?php echo ($controller == "staff_members" && $method == "add") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/staff_members/add">Add Staff Member</a></li>
                                    <li><a class="<?php echo ($controller == "staff_members" || $controller == "staff_intro_listing" || $controller == "staff_intro_update") && ($method == "" || $method == "edit") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/staff_members">Edit Staff Member</a></li>
                                    <li><a class="<?php echo ($controller == "positions") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/positions">Staff Positions</a></li>
                                    <li><a class="<?php echo ($controller == "departments") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/departments">Departments</a></li>
                                </ul>
                            </li>
                            <?php
                             }?>
                            <?php
                             if(Session::get('website_id') == 1)  {
                                 ?>
                            <li class="has_sub"><a href="javascript:void(0)" title="Doorways" class="<?php echo ($controller == "Doorway") ? "active" : ""; ?> waves-effect waves-light"><i class="fa fa-object-ungroup"></i><span>Doorways</span></a>
                                <ul>
                                    <li><a class="<?php echo ($controller == "Doorway" && $method == "create") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Doorway/create">Add Doorways</a></li>
                                    <li><a class="<?php echo ($controller == "Doorway") && ($method == "" || $method1 == "edit" ) ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Doorway">Edit Doorways</a></li>
                                </ul>
                            </li>
                            <?php
                             }
                             ?>
                            <?php
                             if(Session::get('website_id') == 1 || (Session::get('website_id') == 2 ) || (Session::get('website_id') == 3 ))  {
                                 ?>
                             <li class="has_sub"><a href="javascript:void(0)" title="Slideshows" class="<?php echo ($controller == "Slide_show_category" || $controller == "Slide_show") ? "active" : ""; ?>waves-effect waves-light"><i class="fa fa-slideshare"></i> <span>Slideshows</span></a>
                                <ul>
                                    <li><a class="<?php echo ($controller == "Slide_show") && ($method == "create") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Slide_show/create">Add Slideshows</a></li>
                                    <li><a class="<?php echo ($controller == "Slide_show") && (($method == "") || ($method1 == "edit" ) || ($method1 == "Slide_show" ))  ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Slide_show">Edit Slideshows</a></li>
                                    <li><a class="<?php echo ($controller == "Slide_show_category") && (($method == "create") || ($method == "") || ($method1 == "edit" )) ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Slide_show_category">Slideshows Categories</a></li>
                                </ul>
                            </li>
                            <?php
                             }
                             ?>
                            <?php
                             if(Session::get('website_id') == 1)  {
                                 ?>
                             <li class="has_sub"><a href="javascript:void(0)" title="Contacts - Feedback" class="<?php echo ($controller == "contact-feedback") ? "active" : ""; ?>waves-effect waves-light"><i class="fa fa-envelope"></i> <span>Contacts - Feedback</span></a>
                                <ul>
                                    <li><a class="<?php echo ($controller == "contact-feedback") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/contact-feedback">Feedback</a></li>
                                </ul>
                            </li>
                            <?php
                             }
                             ?>
                            <?php
                             if(Session::get('website_id') == 1)  {
                                 ?>
                            <li class="has_sub"><a href="javascript:void(0)" title="Form Creator" class="<?php echo ($controller == "Form_creator") ? "active" : ""; ?> waves-effect waves-light"><i class="fa fa-file-o"></i> <span>Form Creator</span></a>
                                <ul>
                                    <li><a class="<?php echo ($controller == "Form_creator" && $method == "create") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Form_creator/create">Add Form</a></li>
                                    <li><a class="<?php echo ( $controller == "Form_question" && $method == "create")||( $controller == "Form_question" && $method) ||( $controller == "Form_creator_update_limit" && $method) ||( $controller == "Form_creator_delete" && $method) || ($controller == "Form_creator") && ( $method=="" || $method1=="edit") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Form_creator">Edit Form</a></li>
                                </ul>
                            </li>
                            <?php
                             }
                             ?>
                            <?php
                             if(Session::get('website_id') == 1)  {
                                 ?>
                            <li class="has_sub"><a href="javascript:void(0)" title="Website Filing Cabinet" class="<?php echo ($controller == "Filing_cabinet" || $controller == "Filing_cabinet_category") ? "active" : ""; ?> waves-effect waves-light"><i class="fa fa-file"></i> <span>Website Filing Cabinet</span></a>
                                <ul>
                                    <li><a class="<?php echo ($controller == "Filing_cabinet") && ($method == "create") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Filing_cabinet/create">Add File</a></li>
                                    <li><a class="<?php echo (($controller == "Filing_cabinet") || ($controller == "Filing_cabinet_intro")) && (($method == "fileList") || ($method == "index") || ($method == "") || ($method1 == "edit" )) ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Filing_cabinet">Edit File</a></li>
                                    <li><a class="<?php echo ($controller == "Filing_cabinet_category") && ($method == "create") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Filing_cabinet_category/create">Add File Categories</a></li>
                                    <li><a class="<?php echo (($controller == "Filing_cabinet_category") || ($controller == "Filing_cabinet_category_intro")) && (($method == "index") || ($method == "") || ($method1 == "edit" )) ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Filing_cabinet_category">Edit File Categories</a></li>
                                </ul>
                            </li>
                            <?php
                             }
                             ?>
                            <?php
                             if(Session::get('website_id') == 1)  {
                                 ?>
                            <li class="has_sub"><a href="javascript:void(0)" title="Search-statistics" class="<?php echo ($controller == "Search_statistics") ? "active" : ""; ?>waves-effect waves-light"><i class="fa fa-search"></i> <span>Search Statistics</span></a>
                                <ul>
                                  <li><a class="<?php echo ($controller == "Search_statistics" || $controller == "Search_statistic")&&($method=="index" || $method=="") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Search_statistics">Site Search</a></li>
                                </ul>
                            </li>
                            <?php
                             }
                             ?>
                            <?php
                             if(Session::get('website_id') == 1)  {
                                 ?>
                            <li class="has_sub"><a href="javascript:void(0)" title="Tools" class="<?php echo ($controller == "Export" || $controller == "Export" || $controller == "Redirect_url" || $controller == "Email_template") ? "active" : ""; ?> waves-effect waves-light"><i class="fa fa-wrench"> </i><span>Tools</span></a>
                                <ul>
                                    <li><a class="<?php echo ($controller == "Export") && ($method == "create") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Export/create">Export</a></li>
                                    <li><a class="<?php echo ($controller == "Sitemap") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Sitemap">XML Sitemap</a></li>
                                    <li><a class="<?php echo ($controller == "Newsletter") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Newsletter">Newsletter</a></li>
                                    <li><a class="<?php echo ($controller == "Server_info") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Server_info">Server Info</a></li>
                                    <li><a class="<?php echo ($controller == "Redirect_url") && (($method == "create") || ($method == "") || ($method1 == "edit" )) ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Redirect_url">URL Redirects</a></li>
                                    <li><a class="<?php echo ($controller == "Email_template") && (($method == "create") || ($method == "") || ($method1 == "edit" )) ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Email_template">Email Template</a></li>
                                </ul>
                            </li>
                            <?php
                             }
                             ?>
                            <?php
                             if(Session::get('website_id') == 1)  {
                                 ?>
                            <li class="has_sub"><a href="javascript:void(0)" title="Appearance" class="<?php echo ($controller == "Editor" || $controller == "Editor") ? "active" : ""; ?> waves-effect waves-light"><i class="fa fa-wrench"></i><span>Appearance</span></a>
                                <ul>
                                    <li><a class="<?php echo ($controller == "Editor") && ($method == "create") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Editor/create">Editor</a></li>
                                    <li><a class="<?php echo ($controller == "widget") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/widget">Widgets</a></li>
                                </ul>
                            </li>
                            <?php
                             }
                             ?>
                            <?php
                             if(Session::get('website_id') == 1)  {
                                 ?>
                            <li class="has_sub"><a href="javascript:void(0)" title="Website" class="<?php echo ($controller == "Website" || $controller == "Website") ? "active" : ""; ?> waves-effect waves-light"><i class="fa fa-globe"></i><span>Website</span></a>
                                <ul>
                                    <li><a class="<?php echo ($controller == "Website") && ($method == "create") ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Website/create">Add Website</a></li>
                                    <li><a class="<?php echo ($controller == "Website") && (($method == "") || ($method1 == "edit" )) ? "active" : ""; ?>" href="<?php echo url('/'); ?>/Website">Edit Website</a></li>
                                </ul>
                            </li>
                            <?php
                             }
                             ?>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-------------------------------- Left Navigation End ------------------------------------->


            <!----------------------------- Right Top button Content Start ------------------------------>
            <div class="content-page">
                <div class="content">
                    <div id="screen-meta-links">
                        <div class="row p-10 p-t-0 p-b-0" id="tab-description1" style="display:none;">
                            <div class="col-lg-12 p-b-0">
                                <div class="top-box">
                                    <div class="col-lg-12 p-20 p-b-0">
                                        <div style="" class="top-box-title"> Boxes </div>
                                        <div class="top-box-pt1-row1">
                                            <label class="checkbox-inline">
                                                <input class="" id="checkbox1" type="checkbox" checked="checked">
                                                Updated Pages</label>
                                        </div>
                                        <div class="top-box-pt1-row1 m-l-40">
                                            <label class="checkbox-inline">
                                                <input class="" id="checkbox2" type="checkbox" checked="checked">
                                                SEO Information</label>
                                        </div>
                                        <div class="top-box-pt1-row1 m-l-40">
                                            <label class="checkbox-inline">
                                                <input class="" id="checkbox3" type="checkbox" checked="checked">
                                                Searched Keywords</label>
                                        </div>
                                        <div class="top-box-pt1-row1 m-l-40">
                                            <label class="checkbox-inline">
                                                <input class="" id="checkbox4" type="checkbox" checked="checked">
                                                Top 5 Visited Pages</label>
                                        </div>
                                        <div class="top-box-pt1-row1 m-l-40">
                                            <label class="checkbox-inline">
                                                <input class="" id="checkbox5" type="checkbox" checked="checked">
                                                Research Keywords</label>
                                        </div>
                                        <div class="top-box-pt1-row1 m-l-40">
                                            <label class="checkbox-inline">
                                                <input class="" id="checkbox6" type="checkbox" checked="checked">
                                                Recently Visited Pages</label>
                                        </div>
                                    </div>
                                    <div class="clearfix">&nbsp;</div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-10 p-t-0 p-b-0" id="tab-description2" style="display:none;">
                            <div class="col-lg-12 p-b-0">
                                <div class="top-box">
                                    <div class="col-lg-12 p-20 p-b-0">
                                        <div style="" class="top-box-title"> Help </div>
                                        <div class="col-lg-12 p-20 p-b-0">
                                            <div class="tabs-vertical-env">
                                                <ul class="nav tabs-vertical">
                                                    <li class="active"> <a aria-expanded="true" data-toggle="tab" href="#v-home">Overview</a> </li>
                                                    <li class=""> <a aria-expanded="false" data-toggle="tab" href="#v-profile">Navigation</a> </li>
                                                    <li class=""> <a aria-expanded="false" data-toggle="tab" href="#v-messages">Layout</a> </li>
                                                    <li class=""> <a aria-expanded="false" data-toggle="tab" href="#v-settings">Content</a> </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div id="v-home" class="tab-pane active">
                                                        <div class="col-lg-12">Welcome to your Dashboard! This is the screen you will see when you log in to your site, and gives you access to all the site management features of Dashboard. You can get help for any screen by clicking the Help tab in the upper corner.</div>
                                                    </div>
                                                    <div id="v-profile" class="tab-pane">
                                                        <div class="col-lg-12">The left-hand navigation menu provides links to all of the Dashboard Administration screens, with submenu items displayed on hover. You can minimize this menu to a narrow icon strip by clicking on the Collapse Menu arrow at the bottom.</div>
                                                        <div class="col-lg-12 m-t-10"> Links in the Toolbar at the top of the screen connect your dashboard and the front end of your site, and provide access to your profile and helpful Dashboard information. </div>
                                                    </div>
                                                    <div id="v-messages" class="tab-pane">
                                                        <div class="col-lg-12">You can use the following controls to arrange your Dashboard screen to suit your workflow. This is true on most other Administration screens as well.</div>
                                                        <div class="col-lg-12 m-t-10"><strong>Screen Options</strong> — Use the Screen Options tab to choose which Dashboard boxes to show.</div>
                                                        <div class="col-lg-12 m-t-10"><strong>Drag and Drop</strong> — To rearrange the boxes, drag and drop by clicking on the title bar of the selected box and releasing when you see a gray dotted-line rectangle appear in the location you want to place the box.</div>
                                                        <div class="col-lg-12 m-t-10"><strong>Box Controls</strong> — Click the title bar of the box to expand or collapse it. Some boxes added by plugins may have configurable content, and will show a “Configure? link in the title bar if you hover over it.</div>
                                                    </div>
                                                    <div id="v-settings" class="tab-pane">
                                                        <div class="col-lg-12">The boxes on your Dashboard screen are:</div>
                                                        <div class="col-lg-12 m-t-10"><strong>At A Glance</strong> — Displays a summary of the content on your site and identifies which theme and version of Dashboard you are using.</div>
                                                        <div class="col-lg-12 m-t-10"><strong>Activity</strong> — Shows the upcoming scheduled posts, recently published posts, and the most recent comments on your posts and allows you to moderate them.</div>
                                                        <div class="col-lg-12 m-t-10"><strong>Quick Draft</strong> — Allows you to create a new post and save it as a draft. Also displays links to the 5 most recent draft posts you've started.</div>
                                                        <div class="col-lg-12 m-t-10"><strong>News</strong> — Latest news from the official project, the Dashboard Planet, and popular and recent plugins.</div>
                                                        <div class="col-lg-12 m-t-10">Welcome — Shows links for some of the most common tasks when setting up a new site.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix">&nbsp;</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 p-r-10 text-right"> <a href="javascript:void(0)" id="tab1" class="btn btn-primary">Screen Options <i class="fa fa-angle-double-down"></i></a> <a href="javascript:void(0)" id="tab2" class="btn btn-primary">Help <i class="fa fa-angle-double-down"></i></a></div>
                        <div class="col-sm-12" style="margin-bottom: 10px"></div>
                    </div> 
                    <!----------------------------- Right Top button Content End ------------------------------>


                    <!-------------- Right Content Start --------->
                    @yield('content')
                    <!------------- Right Content Start --------->


                    <!--------------------- Footer START -------------------->
                    <footer class="footer text-right">
                        <div class="col-sm-6 text-left">&copy;2016 wswheboces.org</div>
                        <div class="col-sm-6 text-right">wswheboces v1.0.1</div>
                    </footer>
                    <!--------------------- Footer END --------------------->

                </div> <!-- content close -->
            </div> <!-- content page close -->
        </div> <!-- wrapper close -->
    </body>
</html>
<script type="text/javascript" src="<?php echo url('/') . '/resources/assets/plugins/detect/detect.js'; ?>"></script> 
<script type="text/javascript" src="<?php echo url('/') . '/resources/assets/plugins/jquery-slimScroll/jquery.slimscroll.js'; ?>"></script> 
<script type="text/javascript" src="<?php echo url('/') . '/resources/assets/js/custom.js'; ?>"></script> 
<script type="text/javascript" src="<?php echo url('/') . '/resources/assets/js/waves.js'; ?>"></script> 
<script type="text/javascript" src="<?php echo url('/') . '/resources/assets/js/morris.min.js'; ?>"></script> 
<script type="text/javascript" src="<?php echo url('/') . '/resources/assets/js/raphael-min.js'; ?>"></script> 
<script type="text/javascript" src="<?php echo url('/') . '/resources/assets/js/waypoints.min.js'; ?>"></script> 
<script type="text/javascript" src="<?php echo url('/') . '/resources/assets/js/jquery.counterup.min.js'; ?>"></script> 


<script type="text/javascript">

                                    //Top Drowdown's section for Search and Help
                                    $("#tab1").click(function() {
                                        $("#tab-description1").slideToggle();
                                        $("#tab2").toggleClass("top-btn-hide");
                                        $("#tab1 .fa").toggleClass("fa-angle-double-up");
                                        $("#tab1 .fa").toggleClass("fa-angle-double-down");
                                    });
                                    $("#tab2").click(function() {
                                        $("#tab-description2").slideToggle();
                                        $("#tab1").toggleClass("top-btn-hide");
                                        $("#tab2 .fa").toggleClass("fa-angle-double-up");
                                        $("#tab2 .fa").toggleClass("fa-angle-double-down");
                                    });


                                    // Create Moveable Div's
                                    $("#sortable1, #sortable2, #sortable3").sortable({
                                        connectWith: ".connectedSortable"
                                    }).disableSelection;


                                    // Create checkbox checkable Div's
                                    $('#checkbox1').change(function() {
                                        if ($('#checkbox1').is(":checked")) {
                                            $('#check-box1').show();
                                        } else {
                                            $('#check-box1').hide();
                                        }
                                    });
                                    $('#checkbox2').change(function() {
                                        if ($('#checkbox2').is(":checked")) {
                                            $('#check-box2').show();
                                        } else {
                                            $('#check-box2').hide();
                                        }
                                    });
                                    $('#checkbox3').change(function() {
                                        if ($('#checkbox3').is(":checked")) {
                                            $('#check-box3').show();
                                        } else {
                                            $('#check-box3').hide();
                                        }
                                    });
                                    $('#checkbox4').change(function() {
                                        if ($('#checkbox4').is(":checked")) {
                                            $('#check-box4').show();
                                        } else {
                                            $('#check-box4').hide();
                                        }
                                    });
                                    $('#checkbox5').change(function() {
                                        if ($('#checkbox5').is(":checked")) {
                                            $('#check-box5').show();
                                        } else {
                                            $('#check-box5').hide();
                                        }
                                    });
                                    $('#checkbox6').change(function() {
                                        if ($('#checkbox6').is(":checked")) {
                                            $('#check-box6').show();
                                        } else {
                                            $('#check-box6').hide();
                                        }
                                    });
</script>
