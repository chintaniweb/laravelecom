<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('User/dashboard'); 
});
Route::get('admin','Auth\AuthController@loginForm');
Route::post('login','Auth\AuthController@login');
Route::get('logout','Auth\AuthController@logout');
Route::get('forgot_password','User@forgot_password');
Route::post('check_forgot_password','User@check_forgot_password');
Route::post('change_password/{id}','User@change_password');

Route::get('user','User@index');
Route::get('user/getUser',['uses'=>'User@getUser','middleware' => ['permission:user-list|user-add|user-edit']]);
Route::get('user/add',['uses'=>'User@create','middleware' => ['permission:user-add']]);
Route::post('user/add',['uses'=>'User@store','middleware' => ['permission:user-add']]);
Route::get('user/edit/{id}',['uses'=>'User@edit','middleware' => ['permission:user-edit']]);
Route::post('user/edit/{id}',['uses'=>'User@update','middleware' => ['permission:user-edit']]);

//location
Route::get('location_insert','Location@create');
Route::post('create_location','Location@store');
Route::get('location_listing','Location@index');
Route::get('location_update/{id}','Location@edit');
Route::post('location_update/{id}','Location@update');
Route::get('location_delete/{id}','Location@destroy');
Route::get('deleteImage/{name}/{id}','Location@deleteImage');
//get all locations in list
Route::get('getLocation','Location@getLocation');


//spotlight story
Route::get('spotlight/add','Spotlight@create');
Route::post('spotlight/add','Spotlight@store');
Route::get('spotlight','Spotlight@index');
Route::get('spotlight/edit/{edit}','Spotlight@edit');
Route::post('spotlight/edit/{edit}','Spotlight@update');
Route::get('spotlight/delete/{delete}','Spotlight@destroy');
Route::get('spotlight_listing','Spotlight@index');
Route::get('getStory/{location_id}','Spotlight@getStory');
Route::post('getStorySearch','Spotlight@getStorySearch');
Route::get('spotlight/deleteImage/{delete}','Spotlight@deleteImage');

//Sitecontent
Route::get('sitecontent','Sitecontent@index'); 
Route::get('sitecontent_listing','Sitecontent@index'); 
Route::get('sitecontent_listing/{id}','Sitecontent@index');
Route::get('sitecontent_listing/{type}/{type_value}','Sitecontent@index');
Route::get('sitecontent/add','Sitecontent@create'); 
Route::post('sitecontent/add','Sitecontent@store');
Route::get('sitecontent/edit/{edit}','Sitecontent@edit');
Route::post('sitecontent/edit/{edit}','Sitecontent@update');
Route::get('sitecontent/delete/{delete}','Sitecontent@destroy');

//school board members
Route::get('school_board_members/add','School_board_members@create');
Route::post('school_board_members/add','School_board_members@store');
Route::get('school_board_members','School_board_members@index');
Route::get('school_board_members/edit/{edit}','School_board_members@edit');
Route::post('school_board_members/edit/{edit}','School_board_members@update');
Route::get('school_board_members/delete/{delete}','School_board_members@destroy');
Route::get('school_board_members/deleteImage/{delete}','School_board_members@deleteImage');
//get school board members list
Route::get('getSchoolBoardMemberList','School_board_members@getSchoolBoardMemberList');
//school board intro
Route::get('school_board_intro','School_board_intro@index');
Route::get('school_board_intro/edit/{edit}','School_board_intro@edit');
Route::post('school_board_intro/edit/{edit}','School_board_intro@update');
Route::get('getSchoolBoardIntroList','School_board_intro@getSchoolBoardIntroList');
//delete individual image in school board intro
Route::get('school_board_intro/deleteImage/{delete}','School_board_intro@deleteImage');

//Job category
Route::get('job_category','Job_category@index');
Route::get('job_category/getJobCategoryList','Job_category@getJobCategoryList');
Route::get('job_category/add','Job_category@create');
Route::get('job_category/edit/{id}','Job_category@update');
Route::get('job_category/delete/{id}','Job_category@destroy');

//driving direction
Route::get('direction/add','Driving_direction@create');
Route::post('direction/add','Driving_direction@store');
Route::get('getDirection','Driving_direction@getDirection');
Route::get('direction','Driving_direction@index');
Route::get('direction/edit/{id}','Driving_direction@edit');
Route::post('direction/edit/{id}','Driving_direction@update');
Route::get('direction/delete/{id}','Driving_direction@destroy');
Route::get('direction/deleteImage/{delete}','Driving_direction@deleteImage');

//driving direction intro
Route::get('getDrivingDirectionsIntroList','Driving_direction_intro@getDrivingDirectionsIntroList');
Route::get('direction_intro','Driving_direction_intro@index');
Route::get('direction_intro/edit/{edit}','Driving_direction_intro@edit');
Route::post('direction_intro/edit/{edit}','Driving_direction_intro@update');
Route::get('direction_intro/deleteImage/{id}','Driving_direction_intro@deleteImage');

//Sitecontent Image Tab
Route::get('sitecontent/create_image/{id}','Sitecontent@createImage');
Route::post('sitecontent/add_image/{id}','Sitecontent@storeImage');
Route::get('sitecontent/delete_image/{id}/{image_id}','Sitecontent@destroyImage');

//Sitecontent File tab
Route::get('sitecontent/create_file/{id}','Sitecontent@createFile');
Route::post('sitecontent/add_file/{id}','Sitecontent@storeFile');
Route::get('sitecontent/edit_file/{id}/{file_id}','Sitecontent@editFile');
Route::post('sitecontent/edit_file/{id}/{file_id}','Sitecontent@updateFile');
Route::get('sitecontent/delete_file/{id}/{file_id}','Sitecontent@destroyFile');

//Sitecontent Link tab
Route::get('sitecontent/create_link/{id}','Sitecontent@createLink');
Route::post('sitecontent/add_link/{id}','Sitecontent@storeLink');
Route::get('sitecontent/delete_link/{id}/{link_id}','Sitecontent@destroyLink');

//permission
Route::get('user_permission','User_permission@index');
Route::get('user_permission/getPermissionList','User_permission@getPermissionList');
Route::get('user_permission/edit/{id}','User_permission@update');
Route::get('user_permission/delete/{id}','User_permission@destroy');
Route::get('user_permission/add','User_permission@create');

//Calendar category
Route::get('calendar_category','Calendar_category@index');
Route::get('calendar_category/getCalendarCategoryList','Calendar_category@getCalendarCategoryList');
Route::get('calendar_category/add','Calendar_category@create');
Route::get('calendar_category/edit/{id}','Calendar_category@update');
Route::get('calendar_category/delete/{id}','Calendar_category@destroy');

//Calendar Event
Route::get('calendar_event/add','Calendar_event@create');
Route::post('calendar_event/add','Calendar_event@store');
Route::get('calendar_event','Calendar_event@index');
Route::get('calendar_event/edit/{edit}','Calendar_event@edit');
Route::post('calendar_event/edit/{edit}','Calendar_event@update');
Route::get('calendar_event/delete/{delete}','Calendar_event@destroy');
//Route::get('calendar_event/deleteImage/{delete}','School_board_members@deleteImage');

//get calendar event list
Route::get('getCalendarEventList/{id}','Calendar_event@getCalendarEventList');
Route::post('calendar_event/getEventSearch','Calendar_event@getEventSearch');

//Job 
Route::get('job','Job@index');
Route::get('job/add','Job@create');
Route::post('job/add','Job@store');
Route::get('job/edit/{id}','Job@edit');
Route::post('job/edit/{id}','Job@update');
Route::get('job/delete/{id}','Job@destroy');

// get job list
Route::get('job/getJobList/{id}','Job@getJobList');
Route::post('job/getJobSearch','Job@getJobSearch');

//Get Job Intro
Route::get('job/intro','Job_intro@index');
Route::get('job/getJobIntroList','Job_intro@getJobIntroList');
Route::get('job/edit_intro/{id}','Job_intro@edit');
Route::post('job/edit_intro/{id}','Job_intro@update');

//Job File Tab
Route::get('job/add_file/{id}','Job@createFile');
Route::post('job/add_file/{id}','Job@storeFile');
Route::get('job/delete_file/{id}/{file_id}','Job@destroyFile');

//Job Link Tab
Route::get('job/add_link/{id}','Job@createLink');
Route::post('job/add_link/{id}','Job@storeLink');
Route::get('job/delete_link/{id}/{link_id}','Job@destroyLink');

//front subpage
Route::get('page/{page_name}','Sitecontent@show');
Route::post('check_password/{name}','Sitecontent@check_password');

//view story for front
Route::get('view_story/{id}','Spotlight@show');
Route::post('view_story_by_location','Spotlight@frontShowStoryByLocation');

//news for front
Route::get('school_news/view_news/{id}','Sitecontent@frontShowNews');
Route::post('school_news/searchNews','Sitecontent@frontSearchNews');
Route::get('school_news/allNews','Sitecontent@frontallNews');

//events for front
Route::get('calendar_event/front_calendar_event_data/{id}','Calendar_event@showEvent');
Route::get('calendar_event/front_calendar','Calendar_event@frontCalendar');

//Driving directions for front-end
Route::get('Driving_directions/Direction','Driving_direction@showDirection');
Route::post('Driving_directions/searchDirection','Driving_direction@searchDirection');

//Location for front
Route::get('Location/Location','Location@showLocation');

//Menu category
Route::get('menu_category','Menu_category@index');
Route::get('menu_category/getMenuCategoryList','Menu_category@getMenuCategoryList');
Route::get('menu_category/add','Menu_category@create');
Route::get('menu_category/edit/{id}','Menu_category@update');
Route::get('menu_category/delete/{id}','Menu_category@destroy');
//Menu
Route::get('menu/add','Menu@create');
Route::post('menu/add','Menu@store');
Route::post('menu/menucreate','Menu@menucreate');
Route::get('menu','Menu@index');
Route::get('menu/edit/{edit}','Menu@edit');
Route::post('menu/edit/{edit}','Menu@update');
Route::get('menu/delete/{delete}','Menu@destroy');
Route::get('getMenuList/{year}/{month}','Menu@getMenuList');
Route::post('menu/list','Menu@menu_list');
//menu copy (function include in menu controller)
Route::get('menu/menucopyview','Menu@menucopyview');
Route::post('menu/menucopy','Menu@menucopy');
//menu intro
Route::get('menu_intro','Menu_intro@index');
Route::get('menu_intro/edit/{edit}','Menu_intro@edit');
Route::post('menu_intro/edit/{edit}','Menu_intro@update');
Route::get('getMenuIntroList','Menu_intro@getMenuIntroList');
//delete individual image
Route::get('menu_intro/deleteImage/{delete}','Menu_intro@deleteImage');
//update weekend_option (function include in menu_intro controller)
Route::get('menu_intro/weekend_setting_updates','Menu_intro@weekend_setting_updates');
Route::post('menu_intro/weekend_update','Menu_intro@weekend_update');
//update ical_setting (function include in menu_intro controller)
Route::get('menu_intro/ical_setting','Menu_intro@ical_setting');
Route::post('menu_intro/ical_setting_updates','Menu_intro@ical_setting_updates');

//stff department
Route::get('departments/getStaffDepartmentsList','Departments@getStaffDepartmentsList');
Route::get('departments','Departments@index');
Route::get('departments/edit/{id}','Departments@update');
Route::get('departments/delete/{id}','Departments@destroy');

//staff postition
Route::get('positions/getStaffPositionsList','Staff_positions@getStaffPositionsList');
Route::get('positions','Staff_positions@index');
Route::get('positions/edit/{id}','Staff_positions@update');
Route::get('positions/delete/{id}','Staff_positions@destroy');

//staff member
Route::get('staff_members/add','Staff_members@create');
Route::post('staff_members/add','Staff_members@store');
Route::get('getStaffMemberList','Staff_members@getStaffMemberList');
Route::get('staff_members','Staff_members@index');
Route::get('staff_members/edit/{edit}','Staff_members@edit');
Route::post('staff_members/edit/{edit}','Staff_members@update');
Route::get('staff_members/delete/{delete}','Staff_members@destroy');

//Contact form for front-end
Route::get('Contact_feedback/Contact','Contact_front@create');
Route::post('Contact_feedback/add_contact','Contact_front@store');

//schoolnews
Route::get('schoolnews/list','Schoolnews@index');
Route::get('schoolnews/add','Schoolnews@create');
Route::post('schoolnews/add','Schoolnews@store');
Route::get('schoolnews/update/{id}','Schoolnews@edit');
Route::post('schoolnews/update/{id}','Schoolnews@update');
Route::get('schoolnews/delete/{id}','Schoolnews@delete');
Route::post('schoolnews/delete/{id}','Schoolnews@destory');
Route::get('getSchoolnews/{location_id}','Schoolnews@getSchoolnews');
Route::post('getNewsSearch','Schoolnews@getNewsSearch');

//schoolnews Intro
Route::get('school_news_intro','School_news_intro@index');
Route::get('school_news_intro/update/{id}','School_news_intro@edit');
Route::post('school_news_intro/update/{id}','School_news_intro@update');
Route::get('getSchoolNewsIntroList','School_news_intro@getSchoolNewsIntroList');
Route::get('school_news_intro/deleteImage/{id}','School_news_intro@deleteImage');

//Schoolnews File tab
Route::get('schoolnews/create_file/{id}','Schoolnews@createFile');
Route::post('schoolnews/add_file/{id}','Schoolnews@storeFile');
Route::get('schoolnews/edit_file/{id}/{file_id}','Schoolnews@editFile');
Route::post('schoolnews/edit_file/{id}/{file_id}','Schoolnews@updateFile');
Route::get('schoolnews/delete_file/{id}/{file_id}','Schoolnews@destroyFile');


//schoolnews Image Tab
Route::get('schoolnews/create_image/{id}','Schoolnews@createImage');
Route::post('schoolnews/add_image/{id}','Schoolnews@storeImage');
Route::get('schoolnews/delete_image/{id}/{image_id}','Schoolnews@destroyImage');

//schoolnews Link tab
Route::get('schoolnews/create_link/{id}','Schoolnews@createLink');
Route::post('schoolnews/add_link/{id}','Schoolnews@storeLink');
Route::get('schoolnews/delete_link/{id}/{link_id}','Schoolnews@destroyLink');

//Home_scroll
Route::get('home_scroll','Home_scroll@index');
Route::get('homescroll/list','Home_scroll@getHomeScrollList');
Route::get('homescroll/add','Home_scroll@create');
Route::get('homescroll/edit/{id}','Home_scroll@update');
Route::get('homescroll/delete/{id}','Home_scroll@destroy');


//quillinks
Route::get('quicklinks','Quick_links@index');
Route::get('quicklinks/add','Quick_links@create');
Route::post('quicklinks/add','Quick_links@store');
Route::get('quicklinks/update/{id}','Quick_links@edit');
Route::post('quicklinks/update/{id}','Quick_links@update');
Route::get('quicklinks/delete/{id}','Quick_links@destroy');
Route::get('getquicklinks','Quick_links@getQuickLinks');

//Contact form for front-end
Route::get('Contact_feedback/Contact','Contact_front@create');
Route::post('Contact_feedback/add_contact','Contact_front@store');

//Contact-feedback for admin
Route::get('contact-feedback','Contact_feedback@index');
Route::post('contact-feedback','Contact_feedback@contact_list');
Route::get('contact_feedback/edit/{id}','Contact_feedback@edit');
Route::post('Contact_feedback/edit/{id}','Contact_feedback@update');
Route::get('contact_feedback/delete/{id}','Contact_feedback@destroy');
Route::get('Contact-feedback/respond/{id}','Contact_feedback@respond');
Route::post('Contact-feedback/update_respond/{id}','Contact_feedback@update_respond');
Route::get('Contact-feedback/forward/{id}','Contact_feedback@forward');
Route::post('Contact-feedback/update_forward/{id}','Contact_feedback@update_forward');


//Staff members for front-end
//Route::get('Staff_members/Staff_directory','Staff_members_front@index');

//Staff member intro
Route::get('getStaffIntroList','Staff_intro@getStaffIntroList');
Route::get('staff_intro_listing','Staff_intro@index');
Route::get('staff_intro_update/edit/{edit}','Staff_intro@edit');
Route::post('staff_intro_update/edit/{edit}','Staff_intro@update');

//Doorways
Route::resource('Doorway','Doorway');
Route::get('getDoorwayList','Doorway@getDoorwayList');

//Alert Message
Route::get('alert_message/add','Alert_message@create');
Route::post('alert_message/add','Alert_message@store');
Route::get('getAlertMessageList','Alert_message@getAlertMessageList');
Route::get('alert_message','Alert_message@index');
Route::get('alert_message/edit/{edit}','Alert_message@edit');
Route::post('alert_message/edit/{edit}','Alert_message@update');
Route::get('alert_message/delete/{delete}','Alert_message@destroy');

//homepage Banners
Route::get('banner_insert','homepage_banners@create');
Route::post('banner_store','homepage_banners@store');

Route::get('banner_listing','homepage_banners@index');

Route::get('banner_edit/{id}','homepage_banners@edit');
Route::post('banner_update/{id}','homepage_banners@update');

Route::get('banner_delete/{id}','homepage_banners@destroy');
Route::get('banner/deleteImage/{id}','homepage_banners@deleteImage');
//get all in list
Route::get('getBanner','homepage_banners@getBanner');

//calendar_event Image Tab
Route::get('calendar_event/create_image/{id}','Calendar_event@createImage');
Route::post('calendar_event/add_image/{id}','Calendar_event@storeImage');
Route::get('calendar_event/delete_image/{id}/{image_id}','Calendar_event@destroyImage');

//calendar_event File tab
Route::get('calendar_event/create_file/{id}','Calendar_event@createFile');
Route::post('calendar_event/add_file/{id}','Calendar_event@storeFile');
Route::get('calendar_event/delete_file/{id}/{file_id}','Calendar_event@destroyFile');

//calendar_event Link tab
Route::get('calendar_event/create_link/{id}','Calendar_event@createLink');
Route::post('calendar_event/add_link/{id}','Calendar_event@storeLink');
Route::get('calendar_event/delete_link/{id}/{link_id}','Calendar_event@destroyLink');

//calendar_event Recur tab
Route::get('calendar_event/create_recur/{id}','Calendar_event@createRecur');
Route::post('calendar_event/update_recur/{id}','Calendar_event@updateRecur');

//delete calendar event
Route::get('calendar_event/delete_view/{id}','Calendar_event@delete_view');
Route::post('calendar_event/destroy/{id}','Calendar_event@destroy');

//Search Statistics module: Admin Side
Route::resource('Search_statistics','Search_statistics');
Route::post('getSearchList','Search_statistics@getSearchList');

//Search Statistics module: Admin Side
Route::get('search','Search_statistics_front@create');
Route::get('searchs','Search_statistics_front@store');
//Search Statistics module: Front Side
Route::get('search/edit/{edit}','Search_statistics_front@edit');
Route::get('searchs/edit/{edit}','Search_statistics_front@update');
//search header
Route::get('search_header','Search_statistics_front@search_header');

Route::post('getSearchFrontList','Search_statistics_front@getSearchFrontList');
//Route::post('search/header','Search_statistics_front@search_header');

//slide show
Route::resource('Slide_show_category','Slide_show_category');
Route::get('getSlideShowCategory/{location_id}','Slide_show_category@getSlideShowCategory');
Route::get('Slide_show_category/delete/{delete}','Slide_show_category@destroy');
Route::resource('Slide_show','Slide_show');
Route::get('getSlideShowList','Slide_show@getSlideShowList');
Route::post('Slide_show/{edit}/edit','Slide_show@addimg');
Route::get('Slide_show/{update}/Slide_show/update/{id}','Slide_show@editdata');
Route::post('Slide_show/{update}/Slide_show/update/{id}','Slide_show@updateimage');
Route::get('Slide_show/{id}/Slide_show/delete/{delete}','Slide_show@deleteimage');
Route::get('Slide_show/Index/{index}','Slide_show_front_controller@index');
Route::get('Slide_show/viewGallery/{index}','Slide_show_front_controller@viewGallery');

//Form Creator
Route::resource('Form_creator', 'Form_creator');
Route::get('getFormList','Form_creator@getFormList');
Route::get('Form_creator_delete/{id}','Form_creator@delete');
Route::get('Form_creator_update_limit/{id}','Form_creator@edit_limit');
Route::any('Form_creator_limit/update/{id}',['as' => 'Form_creator_limit.update', 'uses'=>'Form_creator@update_limit']);
Route::get('Form_creator_front/{id}', 'Form_creator_front@index');

//Form Question
Route::get('Form_question/create/{id}', 'Form_question@create');
Route::post('Form_question/add', 'Form_question@store');
Route::get('getQuestionList/{id}','Form_question@getQuestionList');
Route::get('Form_question/{id}','Form_question@index');
Route::get('Form_question/{id}/edit/form_id/{que_id}','Form_question@edit');
Route::any('Form_question/update/{que_id}',['as' => 'Form_question.update', 'uses'=>'Form_question@update']);
Route::get('Form_question/Delete_image/{name}/{id}/creator_id/{creator_id}','Form_question@delete_image');

//Export
Route::resource('Export','Export');

//Staff Directory module : Front side
Route::get('staff_directory','Staff_directory@index');
Route::post('staff_directory/index','Staff_directory@store');


//Url redirect
Route::resource('Redirect_url','Redirect_url');
Route::get('getRedirectList','Redirect_url@getRedirectList');
//website
Route::resource('Website','Website');
Route::get('getWebsite','Website@getWebsite');
Route::get('Website/deleteImage/{delete}','Website@deleteImage');

//email template
Route::resource('Email_template','Email_template');
Route::get('getEmailtemplate','Email_template@getEmailtemplate');

// Newsletter
Route::get('Newsletter','Newsletter@index');
Route::get('getNewsletterList','Newsletter@getNewsletterList');
Route::get('Newsletter/edit/{id}','Newsletter@update');
Route::get('Newsletter/delete/{id}','Newsletter@destroy');

//filling cabinet category
Route::resource('Filing_cabinet_category','Filing_cabinet_category');
Route::get('getFilingCabinetCategoryList/{id}','Filing_cabinet_category@getFilingCabinetCategoryList');
Route::get('Filing_cabinet_category/index/{id}','Filing_cabinet_category@index');

//filing cabinet category intro
Route::resource('Filing_cabinet_category_intro','Filing_cabinet_category_intro');
Route::get('getFilingCabinetCategoryIntroList','Filing_cabinet_category_intro@getFilingCabinetCategoryIntroList');

//filling cabinet file
Route::resource('Filing_cabinet','Filing_cabinet');
Route::get('Filing_cabinet/index/{id}','Filing_cabinet@index');
Route::get('Filing_cabinet/fileList/{id}','Filing_cabinet@fileList');
Route::get('getFileList/{id}','Filing_cabinet@getFileList');
//Route::get('getFilingCabinetCategoryList/{id}','Filing_cabinet@getFilingCabinetCategoryList');

//filing cabinet intro file
Route::resource('Filing_cabinet_intro','Filing_cabinet_intro');
Route::get('getFilingCabinetIntroList','Filing_cabinet_intro@getFilingCabinetIntroList');
//Route::get('Filing_cabinet_category','Filing_cabinet_category@create');
//Route::post('Filing_cabinet_category/add','Filing_cabinet_category@store');

//sitemap
Route::resource('Sitemap','Sitemap');
Route::post('generate','Sitemap@generate');

//server info
Route::resource('Server_info','Server_info');

//editor
Route::get('Editor/create','Editor@create');
//Route::resource('Editor','Editor');
Route::get('Editor/create/{data}','Editor@index');
Route::post('Editor/create/{data}','Editor@store');
Route::post('Editor/create','Editor@save_Data');
//Route::get('Editor/create/{data}','Editor@store');

//Block_ip
Route::get('block_ip','Block_ip@index');
Route::get('block_ip/getBlockIpList','Block_ip@getBlockIpList');
Route::get('block_ip/add','Block_ip@create');
Route::get('block_ip/edit/{id}','Block_ip@update');
Route::get('block_ip/delete/{id}','Block_ip@destroy');

//Contact feedback email
Route::get('contact_feedback_email','Contact_feedback_email@index');
Route::get('contact_feedback_email/getLocationList','Contact_feedback_email@getLocationList');
Route::get('contact_feedback_email/getAdditionalList','Contact_feedback_email@getAdditionalList');
Route::get('contact_feedback_email/add','Contact_feedback_email@create');
Route::get('contact_feedback_email/edit/{id}','Contact_feedback_email@update');
Route::get('contact_feedback_email/update/{id}','Contact_feedback_email@additional_update');
Route::get('contact_feedback_email/delete/{id}','Contact_feedback_email@destroy');

//download feedback
Route::get('contact_feedback/download_feedback','Contact_feedback@download_feedback');
Route::post('contact_feedback/get_download','Contact_feedback@get_download');

//contact feedbcak intro
Route::get('contact_feedback_intro','Contact_feedback_intro@index');
Route::get('contact_feedback_intro/edit/{edit}','Contact_feedback_intro@edit');
Route::post('contact_feedback_intro/edit/{edit}','Contact_feedback_intro@update');
Route::get('getContactIntroList','Contact_feedback_intro@getContactIntroList');
Route::get('Contact-feedback/deleteImage/{id}','Contact_feedback_intro@deleteImage');

//widget
Route::get('widget','Widget@index');
Route::get('widget/sidebar_widget/{id}','Widget@sidebar_widget');
Route::post('widget/update_sidebar/{id}','Widget@update_sidebar_widget');
Route::get('widget/delete_sidebar/{id}','Widget@delete_sidebar_widget');
Route::get('widget/footer_widget/{id}','Widget@footer_widget');
Route::post('widget/update_footer/{id}','Widget@update_footer_widget');
Route::get('widget/delete_footer/{id}','Widget@delete_footer_widget');
Route::post('widget/update_dashboard_widget/{id}','Widget@update_dashboard_widget');

//job preview
Route::get('Job/Index/{index}','job_front@index');