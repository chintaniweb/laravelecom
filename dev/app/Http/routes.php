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

//boces dashboard
Route::get('/dashboard', function () {
    return view('User/dashboard'); 
});
Route::get('admin','Auth\AuthController@loginForm');
Route::post('login','Auth\AuthController@login');
Route::get('logout','Auth\AuthController@logout');
Route::get('forgot_password','User@forgot_password');
Route::post('check_forgot_password','User@check_forgot_password');
Route::post('change_password/{id}','User@change_password');

//Route::get('user',['uses'=>'User@index','middleware' => ['permission:user-list|user-add|user-edit|user-delete']]);
////Route::get('user/getUser','User@getUser');
////Route::get('user/add','User@create');
////Route::post('user/add','User@store');
////Route::get('user/edit/{id}','User@edit');
////Route::post('user/edit/{id}','User@update');
//Route::get('user/getUser',['uses'=>'User@getUser','middleware' => ['permission:user-list|user-edit|user-delete']]);
//Route::get('user/add',['uses'=>'User@create','middleware' => ['permission:user-add']]);
//Route::post('user/add',['uses'=>'User@store','middleware' => ['permission:user-add']]);
//Route::get('user/edit/{id}',['uses'=>'User@edit','middleware' => ['permission:user-edit']]);
//Route::post('user/edit/{id}',['uses'=>'User@update','middleware' => ['permission:user-edit']]);
Route::get('user/delete/{id}','User@destroy');
Route::get('user/profile/{id}','User@view_profile');


Route::get('user',['uses'=>'User@index','middleware' => ['permission:user-list|user-create|user-edit|user-delete']]);
Route::get('user/getUser',['uses'=>'User@getUser','middleware' => ['permission:user-list']]);
Route::get('user/add',['uses'=>'User@create','middleware' => ['permission:user-create']]);
Route::post('user/add',['uses'=>'User@store','middleware' => ['permission:user-create']]);
Route::get('user/edit/{id}',['uses'=>'User@edit','middleware' => ['permission:user-edit']]);
Route::post('user/edit/{id}',['uses'=>'User@update','middleware' => ['permission:user-edit']]);

//location using permission
Route::get('location_listing',['uses'=>'Location@index','middleware' => ['permission:show-list|user-create|user-edit|user-delete']]);
Route::get('getLocation','Location@getLocation');
//Route::get('getLocation','Location@getLocation');
Route::get('location_insert',['uses'=>'Location@create','middleware' => ['permission:show-create']]);
Route::post('create_location','Location@store');
Route::get('location_update/{id}',['uses'=>'Location@edit','middleware' => ['permission:show-edit']]);
Route::post('location_update/{id}','Location@update');
Route::get('location_delete/{id}',['uses'=>'Location@destroy','middleware' => ['permission:show-delete']]);
Route::get('deleteImage/{name}/{id}','Location@deleteImage');
//Route::get('location_listing','Location@index');
//Route::get('getLocation','Location@getLocation');
//Route::get('location_insert','Location@create');
//Route::post('create_location','Location@store');
//Route::get('location_update/{id}','Location@edit');
//Route::post('location_update/{id}','Location@update');
//Route::get('location_delete/{id}','Location@destroy');
//Route::get('deleteImage/{name}/{id}','Location@deleteImage');

//spotlight story
Route::get('spotlight/add',['uses'=>'Spotlight@create','middleware' => ['permission:spotlight-create']]);
Route::post('spotlight/add','Spotlight@store');
Route::get('spotlight',['uses'=>'Spotlight@index','middleware' => ['permission:spotlight-list']]);
Route::get('spotlight/edit/{edit}',['uses'=>'Spotlight@edit','middleware' => ['permission:spotlight-edit']]);
Route::post('spotlight/edit/{edit}','Spotlight@update');
Route::get('spotlight/delete/{delete}',['uses'=>'Spotlight@destroy','middleware' => ['permission:spotlight-delete']]);
Route::get('spotlight_listing','Spotlight@index');
Route::get('getStory/{location_id}','Spotlight@getStory');
Route::post('getStorySearch','Spotlight@getStorySearch');
Route::get('getStorySearch','Spotlight@getStorySearch');
Route::get('spotlight/deleteImage/{delete}','Spotlight@deleteImage');

//Sitecontent
Route::get('sitecontent',['uses'=>'Sitecontent@index','middleware' => ['permission:sitecontent-list']]); 
Route::get('sitecontent_listing','Sitecontent@index'); 
Route::get('sitecontent_listing/{id}','Sitecontent@index');
Route::get('sitecontent_listing/{type}/{type_value}','Sitecontent@index');
Route::get('sitecontent/add',['uses'=>'Sitecontent@create','middleware' => ['permission:sitecontent-add']]); 
Route::post('sitecontent/add','Sitecontent@store');
Route::get('sitecontent/edit/{edit}',['uses'=>'Sitecontent@edit','middleware' => ['permission:sitecontent-edit']]);
Route::post('sitecontent/edit/{edit}','Sitecontent@update');
Route::get('sitecontent/delete/{delete}',['uses'=>'Sitecontent@destroy','middleware' => ['permission:sitecontent-delete']]);

//school board members
Route::get('school_board_members',['uses'=>'School_board_members@index','middleware' => ['permission:board-list']]);
Route::get('school_board_members/add',['uses'=>'School_board_members@create','middleware' => ['permission:board-create']]);
Route::get('getSchoolBoardMemberList',['uses'=>'School_board_members@getSchoolBoardMemberList','middleware' => ['permission:board-list']]);
//Route::get('school_board_members','School_board_members@index');
//Route::get('school_board_members/add','School_board_members@create');
Route::post('school_board_members/add','School_board_members@store');
Route::get('school_board_members/edit/{edit}',['uses'=>'School_board_members@edit','middleware' => ['permission:board-edit']]);
Route::post('school_board_members/edit/{edit}',['uses'=>'School_board_members@update','middleware' => ['permission:board-update']]);
Route::get('school_board_members/delete/{delete}',['uses'=>'School_board_members@destroy','middleware' => ['permission:board-delete']]);
Route::get('school_board_members/deleteImage/{delete}',['uses'=>'School_board_members@deleteImage','middleware' => ['permission:board-delete-image']]);
//get school board members list
//Route::get('getSchoolBoardMemberList','School_board_members@getSchoolBoardMemberList');
//school board intro
Route::get('school_board_intro','School_board_intro@index');
Route::get('school_board_intro/edit/{edit}','School_board_intro@edit');
Route::post('school_board_intro/edit/{edit}','School_board_intro@update');
Route::get('getSchoolBoardIntroList','School_board_intro@getSchoolBoardIntroList');
//delete individual image in school board intro
Route::get('school_board_intro/deleteImage/{delete}','School_board_intro@deleteImage');

//Job category
Route::get('job_category',['uses'=>'Job_category@index','middleware' => ['permission:job-category-list']]);
Route::get('job_category/getJobCategoryList',['uses'=>'Job_category@getJobCategoryList','middleware' => ['permission:job-category-list']]);
Route::get('job_category/add',['uses'=>'Job_category@create','middleware' => ['permission:job-category-create']]);
Route::get('job_category/edit/{id}',['uses'=>'Job_category@update','middleware' => ['permission:job-category-update']]);
Route::get('job_category/delete/{id}',['uses'=>'Job_category@destroy','middleware' => ['permission:job-category-delete']]);
//route for add link on job category index page
Route::get('job/add/{id}','Job@create');

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

Route::get('Sitecontent/set_website/{id}','Sitecontent@set_website');

//permission
Route::get('user_permission','User_permission@index');
Route::get('user_permission/getPermissionList','User_permission@getPermissionList');
Route::get('user_permission/edit/{id}','User_permission@update');
Route::get('user_permission/delete/{id}','User_permission@destroy');
Route::get('user_permission/add','User_permission@create');

//Calendar category
Route::get('calendar_category','Calendar_category@index');
Route::get('calendar_category/getCalendarCategoryList','Calendar_category@getCalendarCategoryList');
Route::get('calendar_category/add',['uses'=>'Calendar_category@create','middleware' => ['permission:calendar-category-create']]);
Route::get('calendar_category/edit/{id}',['uses'=>'Calendar_category@update','middleware' => ['permission:calendar-category-update']]);
Route::get('calendar_category/delete/{id}',['uses'=>'Calendar_category@destroy','middleware' => ['permission:calendar-category-delete']]);

//Calendar Event
Route::get('calendar_event/add',['uses'=>'Calendar_event@create','middleware' => ['permission:calendar-event-create']]);
Route::post('calendar_event/add','Calendar_event@store');
Route::get('calendar_event',['uses'=>'Calendar_event@index','middleware' => ['permission:calendar-event-list']]);
Route::get('calendar_event/edit/{edit}',['uses'=>'Calendar_event@edit','middleware' => ['permission:calendar-event-edit']]);
Route::post('calendar_event/edit/{edit}','Calendar_event@update');
Route::get('calendar_event/delete/{delete}',['uses'=>'Calendar_event@destroy','middleware' => ['permission:calendar-event-delete']]);
//Route::get('calendar_event/deleteImage/{delete}','School_board_members@deleteImage');

//get calendar event list
Route::get('getCalendarEventList/{id}',['uses'=>'Calendar_event@getCalendarEventList','middleware' => ['permission:calendar-event-list']]);
Route::post('calendar_event/getEventSearch','Calendar_event@getEventSearch');
Route::get('calendar_event/getEventSearch','Calendar_event@getEventSearch');
//Job 
Route::get('job',['uses'=>'Job@index','middleware' => ['permission:job-list']]);
Route::get('job/add',['uses'=>'Job@create','middleware' => ['permission:job-create']]);
Route::post('job/add','Job@store');
Route::get('job/edit/{id}',['uses'=>'Job@edit','middleware' => ['permission:job-edit']]);
Route::post('job/edit/{id}','Job@update');
Route::get('job/delete/{id}',['uses'=>'Job@destroy','middleware' => ['permission:job-delete']]);

// get job list
Route::get('job/getJobList/{id}',['uses'=>'Job@getJobList','middleware' => ['permission:job-list']]);
Route::post('job/getJobSearch','Job@getJobSearch');
Route::get('job/getJobSearch','Job@getJobSearch');


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
Route::get('page/{page_name}','Sitecontent_front@show');
Route::post('check_password/{name}','Sitecontent_front@check_password');

//view story for front
Route::get('view_story/{id}','Spotlight_front@show');
Route::post('view_story_by_location','Spotlight_front@frontShowStoryByLocation');

//news for front
Route::get('school_news/view_news/{id}','School_news_front@frontShowNews');
Route::post('school_news/searchNews','School_news_front@frontSearchNews');
Route::get('school_news/searchNews','School_news_front@frontallNews');
Route::get('school_news/allNews','School_news_front@frontallNews');

//events for front
Route::get('calendar_event/front_calendar_event_data/{id}','Calender_evvent_front@showEvent');
Route::get('calendar_event/front_calendar','Calender_evvent_front@frontCalendar');

//Driving directions for front-end
Route::get('Driving_directions/Direction','Driving_direction_front@showDirection');
Route::post('Driving_directions/searchDirection','Driving_direction_front@searchDirection');
Route::get('Driving_directions/searchDirection','Driving_direction_front@showDirection');

//Location for front
Route::get('Location/Location','Location_front@showLocation');


//Menu category
Route::get('menu_category',['uses'=>'Menu_category@index','middleware' => ['permission:menu-category-list']]);
Route::get('menu_category/getMenuCategoryList',['uses'=>'Menu_category@getMenuCategoryList','middleware' => ['permission:menu-category-list']]);
Route::get('menu_category/add',['uses'=>'Menu_category@create','middleware' => ['permission:menu-category-create']]);
Route::get('menu_category/edit/{id}',['uses'=>'Menu_category@update','middleware' => ['permission:menu-category-edit']]);
Route::get('menu_category/delete/{id}',['uses'=>'Menu_category@destroy','middleware' => ['permission:menu-category-delete']]);
//Menu
Route::get('menu/add',['uses'=>'Menu@create','middleware' => ['permission:menu-create']]);
Route::post('menu/add','Menu@store');
Route::post('menu/menucreate','Menu@menucreate');
Route::get('menu/menucreate','Menu@create');
Route::get('menu',['uses'=>'Menu@index','middleware' => ['permission:menu-list']]);
Route::get('menu/edit/{edit}',['uses'=>'Menu@edit','middleware' => ['permission:menu-edit']]);
Route::post('menu/edit/{edit}','Menu@update');
Route::get('menu/delete/{delete}',['uses'=>'Menu@destroy','middleware' => ['permission:menu-delete']]);
Route::get('getMenuList/{year}/{month}','Menu@getMenuList');
Route::post('menu/list','Menu@menu_list');
Route::get('menu/list','Menu@index');
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
Route::get('departments',['uses'=>'Departments@index','middleware' => ['permission:staff-departments-list']]);
Route::get('departments/edit/{id}',['uses'=>'Departments@update','middleware' => ['permission:staff-departments-edit']]);
Route::get('departments/delete/{id}',['uses'=>'Departments@destroy','middleware' => ['permission:staff-departments-delete']]);

//staff postition
Route::get('positions/getStaffPositionsList','Staff_positions@getStaffPositionsList');
Route::get('positions',['uses'=>'Staff_positions@index','middleware' => ['permission:staff-positions-list']]);
Route::get('positions/edit/{id}',['uses'=>'Staff_positions@update','middleware' => ['permission:staff-positions-edit']]);
Route::get('positions/delete/{id}',['uses'=>'Staff_positions@destroy','middleware' => ['permission:staff-positions-delete']]);

//staff member
Route::get('staff_members/add',['uses'=>'Staff_members@create','middleware' => ['permission:staff-members-create']]);
Route::post('staff_members/add','Staff_members@store');
Route::get('getStaffMemberList','Staff_members@getStaffMemberList');
Route::get('staff_members',['uses'=>'Staff_members@index','middleware' => ['permission:staff-members-list']]);
Route::get('staff_members/edit/{edit}',['uses'=>'Staff_members@edit','middleware' => ['permission:staff-members-edit']]);
Route::post('staff_members/edit/{edit}','Staff_members@update');
Route::get('staff_members/delete/{delete}',['uses'=>'Staff_members@destroy','middleware' => ['permission:staff-members-delete']]);

Route::get('staff_members/set_website/{id}','Staff_members@set_website');

//Contact form for front-end
Route::get('Contact_feedback/Contact','Contact_front@create');
Route::post('Contact_feedback/add_contact','Contact_front@store');

//schoolnews
Route::get('schoolnews/list',['uses'=>'Schoolnews@index','middleware' => ['permission:schoolnews-list']]);
Route::get('schoolnews/add',['uses'=>'Schoolnews@create','middleware' => ['permission:schoolnews-create']]);
Route::post('schoolnews/add','Schoolnews@store');
Route::get('schoolnews/update/{id}',['uses'=>'Schoolnews@edit','middleware' => ['permission:schoolnews-edit']]);
Route::post('schoolnews/update/{id}','Schoolnews@update');
Route::get('schoolnews/delete/{id}','Schoolnews@delete');
Route::post('schoolnews/delete/{id}',['uses'=>'Schoolnews@destory','middleware' => ['permission:schoolnews-delete']]);
Route::get('getSchoolnews/{location_id}','Schoolnews@getSchoolnews');
Route::post('getNewsSearch','Schoolnews@getNewsSearch');
Route::get('getNewsSearch','Schoolnews@getNewsSearch');

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




//Calendar category
Route::get('calendar_category','Calendar_category@index');
Route::get('calendar_category/getCalendarCategoryList','Calendar_category@getCalendarCategoryList');
Route::get('calendar_category/add',['uses'=>'Calendar_category@create','middleware' => ['permission:calendar-category-create']]);
Route::get('calendar_category/edit/{id}',['uses'=>'Calendar_category@update','middleware' => ['permission:calendar-category-update']]);
Route::get('calendar_category/delete/{id}',['uses'=>'Calendar_category@destroy','middleware' => ['permission:calendar-category-delete']]);



//Home_scroll
Route::get('home_scroll',['uses'=>'Home_scroll@index','middleware' => ['permission:home-scroll-list']]);
Route::get('homescroll/list','Home_scroll@getHomeScrollList');
Route::get('homescroll/add',['uses'=>'Home_scroll@create','middleware' => ['permission:home-scroll-create']]);
Route::get('homescroll/edit/{id}',['uses'=>'Home_scroll@update','middleware' => ['permission:home-scroll-edit']]);
Route::get('homescroll/delete/{id}',['uses'=>'Home_scroll@destroy','middleware' => ['permission:home-scroll-delete']]);

//quillinks
Route::get('quicklinks',['uses'=>'Quick_links@index','middleware' => ['permission:quick-links-list']]);
Route::get('quicklinks/add',['uses'=>'Quick_links@create','middleware' => ['permission:quick-links-create']]);
Route::post('quicklinks/add','Quick_links@store');
Route::get('quicklinks/update/{id}',['uses'=>'Quick_links@edit','middleware' => ['permission:quick-links-edit']]);
Route::post('quicklinks/update/{id}','Quick_links@update');
Route::get('quicklinks/delete/{id}',['uses'=>'Quick_links@destroy','middleware' => ['permission:quick-links-delete']]);
Route::get('getquicklinks','Quick_links@getQuickLinks');

//Contact form for front-end
Route::get('Contact_feedback/Contact','Contact_front@create');
Route::post('Contact_feedback/add_contact','Contact_front@store');

//Contact-feedback for admin
Route::get('contact-feedback',['uses'=>'Contact_feedback@index','middleware' => ['permission:contact-feedback-list']]);
Route::post('contact-feedback','Contact_feedback@contact_list');
Route::get('contact_feedback/edit/{id}',['uses'=>'Contact_feedback@edit','middleware' => ['permission:contact-feedback-edit']]);
Route::post('Contact_feedback/edit/{id}','Contact_feedback@update');
Route::get('contact_feedback/delete/{id}',['uses'=>'Contact_feedback@destroy','middleware' => ['permission:contact-feedback-delete']]);
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
Route::get('alert_message/add',['uses'=>'Alert_message@create','middleware' => ['permission:alert-message-create']]);
Route::post('alert_message/add','Alert_message@store');
Route::get('getAlertMessageList','Alert_message@getAlertMessageList');
Route::get('alert_message',['uses'=>'Alert_message@index','middleware' => ['permission:alert-message-list']]);
Route::get('alert_message/edit/{edit}',['uses'=>'Alert_message@edit','middleware' => ['permission:alert-message-edit']]);
Route::post('alert_message/edit/{edit}','Alert_message@update');
Route::get('alert_message/delete/{delete}',['uses'=>'Alert_message@destroy','middleware' => ['permission:alert-message-delete']]);

//homepage Banners
Route::get('banner_insert',['uses'=>'homepage_banners@create','middleware' => ['permission:homepage-banner-create']]);
Route::post('banner_store','homepage_banners@store');

Route::get('banner_listing',['uses'=>'homepage_banners@index','middleware' => ['permission:homepage-banner-list']]);

Route::get('banner_edit/{id}',['uses'=>'homepage_banners@edit','middleware' => ['permission:homepage-banner-edit']]);
Route::post('banner_update/{id}','homepage_banners@update');

Route::get('banner_delete/{id}',['uses'=>'homepage_banners@destroy','middleware' => ['permission:homepage-banner-delete']]);
Route::get('banner/deleteImage/{id}','homepage_banners@deleteImage');
//get all in list
Route::get('getBanner',['uses'=>'homepage_banners@getBanner','middleware' => ['permission:homepage-banner-list']]);

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
Route::post('Search_statistic/index','Search_statistics@getSearchList');
Route::get('Search_statistic/index','Search_statistics@index');

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

Route::get('Slide_show/set_website/{id}','Slide_show@set_website');

//Form Creator
Route::resource('Form_creator', 'Form_creator');
Route::get('getFormList','Form_creator@getFormList');
Route::get('Form_creator_delete/{id}','Form_creator@delete');
Route::get('Form_creator_update_limit/{id}','Form_creator@edit_limit');
Route::any('Form_creator_limit/update/{id}',['as' => 'Form_creator_limit.update', 'uses'=>'Form_creator@update_limit']);
Route::get('Form_creator_front/{id}', 'Form_creator_front@index');
Route::post('Form_creator_front/{id}', 'Form_creator_front@store');

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
Route::get('staff_directory','Staff_directory_front@index');
Route::post('staff_directory/index','Staff_directory_front@store');


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


Route::get('Newsletter',['uses'=>'Newsletter@index','middleware' => ['permission:newsletter-list']]);
Route::get('getNewsletterList','Newsletter@getNewsletterList');
Route::get('Newsletter/edit/{id}',['uses'=>'Newsletter@update','middleware' => ['permission:newsletter-edit']]);
Route::get('Newsletter/delete/{id}',['uses'=>'Newsletter@destroy','middleware' => ['permission:newsletter-delete']]);

//filling cabinet category
Route::resource('Filing_cabinet_category','Filing_cabinet_category');
Route::get('getFilingCabinetCategoryList/{id}','Filing_cabinet_category@getFilingCabinetCategoryList');
Route::get('Filing_cabinet_category/index/{id}','Filing_cabinet_category@index');

//filing cabinet category intro
Route::resource('Filing_cabinet_category_intro','Filing_cabinet_category_intro');
Route::get('getFilingCabinetCategoryIntroList','Filing_cabinet_category_intro@getFilingCabinetCategoryIntroList');
Route::get('Filing_cabinet_category_intro/deleteImage/{id}','Filing_cabinet_category_intro@deleteImage');


//filling cabinet file
Route::resource('Filing_cabinet','Filing_cabinet');
Route::get('Filing_cabinet/index/{id}','Filing_cabinet@index');
Route::get('Filing_cabinet/fileList/{id}','Filing_cabinet@fileList');
Route::get('getFileList/{id}','Filing_cabinet@getFileList');
Route::get('Filing_cabinet/deleteImage/{id}','Filing_cabinet@deleteImage');
//Route::get('getFilingCabinetCategoryList/{id}','Filing_cabinet@getFilingCabinetCategoryList');

//filing cabinet intro file
Route::resource('Filing_cabinet_intro','Filing_cabinet_intro');
Route::get('getFilingCabinetIntroList','Filing_cabinet_intro@getFilingCabinetIntroList');
Route::get('Filing_cabinet_intro/deleteImage/{id}','Filing_cabinet_intro@deleteImage');
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
Route::post('Editor/create/{data}',['uses'=>'Editor@store','middleware' => ['permission:editor-edit']]);
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
Route::get('widget',['uses'=>'Widget@index','middleware' => ['permission:widget-list']]);
Route::get('widget/sidebar_widget/{id}','Widget@sidebar_widget');
Route::post('widget/update_sidebar/{id}','Widget@update_sidebar_widget');
Route::get('widget/delete_sidebar/{id}','Widget@delete_sidebar_widget');
Route::get('widget/footer_widget/{id}','Widget@footer_widget');
Route::post('widget/update_footer/{id}','Widget@update_footer_widget');
Route::get('widget/delete_footer/{id}','Widget@delete_footer_widget');
Route::post('widget/update_dashboard_widget/{id}','Widget@update_dashboard_widget');

//job preview 
Route::get('Job/Index/{index}','job_front@index');
Route::get('Job_intro/deleteImage/{delete}','Job_intro@deleteImage');

//delete image 
Route::get('staff_intro/deleteImage/{delete}','Staff_intro@deleteImage');

//school board member preview
Route::get('school_board_members/Index/{index}','School_board_members_front@index');

//video intor

Route::resource('Video_intro','Video_intro');
Route::get('getVideoIntroList','Video_intro@getVideoIntroList');
Route::get('video','Video_intro_front@index');
//Route::get('Filing_cabinet_category_intro/deleteImage/{id}','Filing_cabinet_category_intro@deleteImage');


//add roles
Route::resource('Roles','Roles');
Route::get('getRoleList','Roles@getRoleList');
Route::get('Roles/set_website/{id}','Roles@set_website');
Route::get('Roles/delete/{delete}','Roles@destroy');
Route::get('Roles/update/{id}','Roles@permissionEdit');
Route::post('Roles/update/{id}','Roles@updateRoles');



