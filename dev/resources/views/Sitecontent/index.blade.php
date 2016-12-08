@extends('layouts.master_admin')
@section('content')
<style>
    ul {
        padding:0px;
        margin: 0px;
    }
    #response {
        padding:10px;
        background-color:#9F9;
        border:2px solid #396;
        margin-bottom:20px;
    }
    #list li {
        margin: 0 0 3px;
        padding:8px;
        background-color:#e8e8e8;
        color:#000;
        list-style: none;
        font-size:13px;
    }
    .site-content-isting-bg ul {float:left; width: 100%; list-style: none; padding:0; margin: 0;}
    .site-content-isting-bg ul li {float:left; width: 100%;}
    .site-content-isting-box {background:#e9e9e9;}
    .site-content-isting-box span {padding-right:20px; font-size:13px; line-height:20px;}
</style>
<?php 
 if (Session::has('website_id')) {

    $website_id = Session::get('website_id');
    
 }
//echo $web;?>

<div class="container">
    <div class="row">
        <div class="col-xs-6 col-sm-6">
            <h4 class="page-title">Site Content Listing</h4>
        </div>
       <?php
       //website dropdown
       $dropdown=dropdown();
      print_r($dropdown);
       ?>
        
    </div>
    <div class="row">
        <div class="col-xs-12 m-t-20">
            <div class="card-box">
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
                @elseif(Session::has('msg'))
                    <p class="alert {{ Session::get('alert-class', 'alert alert-danger') }}">{{ Session::get('msg') }}</p>
                @endif
                <div class="row m-0">
                    <div role="grid" class="dataTables_wrapper site-content-grid" id="datatable-editable_wrapper">
                        <div class="col-lg-12 p-0">
                            
                            <?php 
                            if (isset($bread_crumb_link)) {
                                echo $bread_crumb_link; 
                            }?>
                            
                            <div class="massages text-center m-b-20">
                                <?php $class_action = 'class="active"';?>
                                <div class="badge"> <a href="<?php echo url('/'); ?>/sitecontent_listing/type/Schools" <?php echo ($page_type=="Schools")? $class_action:""; ?>>Schools</a> 
                                    | <a href="<?php echo url('/'); ?>/sitecontent_listing/type/MainPage" <?php echo ($page_type=="MainPage")? $class_action:""; ?>>Main Pages </a> 
                                    | <a href="<?php echo url('/'); ?>/sitecontent_listing/type/Internal" <?php echo ($page_type=="Internal")? $class_action:""; ?> >Internal Pages</a> </div>
                            </div>
                            
                            
                            <div class="text-right m-b-10"> <a class="btn btn-primary" href="{{url('/')}}/sitecontent/add">Add Page</a></div>
                            
                            <div id="list" class="site-content-isting-bg">
                                
                                <div class="col-sm-12 col-xs-12 m-b-10 p-10 site-content-isting-box">
                                    <span class="col-sm-1 col-xs-12"><strong>ID</strong></span>
                                    
                                    <span class="col-sm-2 col-xs-12"><strong><?php echo $page_type;?> Pages</strong></span>
                                    <span class="col-sm-2 col-xs-12"><strong>Sub Page</strong></span>
                                    
                                    <span class="col-sm-1 col-xs-12"><strong>Page Preview</strong></span>
                                    <span class="col-sm-2 col-xs-12 text-right"><strong>Last Updated On</strong></span>
                                    <span class="col-sm-2 col-xs-12 text-right"><strong>Last Updated By</strong></span>
                                    <span class="col-sm-1 col-xs-12 text-right"><strong>Publish</strong></span>
                                    
                                    <span class="col-sm-1 col-xs-12 text-right"><strong>Edit Page</strong></span>
                                </div>
                                <ul>
                                     @foreach ($data as $row)
                                     <?php 
                                        $id = stripslashes($row->sitecontent_id);
                                        $text = stripslashes($row->navigation_title);
                                        $sub_category_tot = stripslashes($row->sub_category_tot);
                                        ?>
                                        <li id="arrayorder_{{$id}}}">
                                            <span class="col-sm-1 col-xs-12"><a title="Edit Page" href="{{url('/')}}/sitecontent/edit/{{ $row->sitecontent_id }}">{{ $row->sitecontent_id }}</a></span> 
                                            <span class="col-sm-2 col-xs-12">
                                                <a title="Edit Page" href="{{url('/')}}/sitecontent/edit/{{ $row->sitecontent_id }}">{{ $row->navigation_title }}</a>
                                            </span>
                                            <span class="col-sm-2 col-xs-12"><a title="Sub Page"  href="<?php echo url('/').'/sitecontent_listing/'.$row->sitecontent_id;?>">
                                                    <?php 
                                                    if(isset($row->sub_category_tot)){
                                                    if($row->sub_category_tot>0) {
                                                        echo "Sub Page(".$row->sub_category_tot.")"; 
                                                    }}?>
                                                </a>
                                            </span>
                                            <span class="col-sm-1 col-xs-12 text-right">
                                                
                                                   <?php
                                            $page_type  = $row->page_type;
                                            $link = $row->access_url;
                                            
                                            if (stristr($link, 'http')) {
                                                $link = $row->access_url;
                                            } 
                                            else {
                                                if($page_type == "Typical Page"){
                                                    //comman function URL
                                                    //custom_url()
                                                    //return url base website 
                                                    $link = website_url() . '/page/' . $row->access_url;
                                                }
                                                else{
                                                    $link = website_url() . '/' . $row->access_url;
                                                }
                                            }
                                            
                                            ?>
                                                
                                                <a target="_blank" title="Page Preview" href="<?php echo $link; ?>">
                                                {{ $row->navigation_title }}</a>
                                            </span>
                                            <span class="col-sm-2 col-xs-12 text-right"><?php echo date(ADMIN_DATE_FORMAT,strtotime($row->updated_at)); ?></span>
                                            <span class="col-sm-2 col-xs-12 text-right">{{ $row->added_by }}</span>
                                            <span class="col-sm-1 col-xs-12 text-right">{{ $row->status }}</span>
                                            <?php if($website_id == 1){ ?>
                                            <span class="col-sm-1 col-xs-12 text-right"><a title="Edit Page" href="{{url('/')}}/sitecontent/edit/{{ $row->sitecontent_id }}">EDIT PAGE</a></span>
                                            <?php } else{ ?>
                                                 <span class="col-sm-1 col-xs-12 text-right"><a title="Edit Page" href="{{url('/')}}/sitecontent/edit/{{ $row->sitecontent_id }}">EDIT PAGE</a></span>
                                            <?php  } ?>
                                            <div class="clear"></div>
                                        </li>
                                    @endforeach
                                </ul>
                                
                            </div>
                            <div id="log"></div>
                            <div id="log2"></div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/config.js"></script> 
<script>
    function get_id(website_id)
    {
        //alert(website_id);
        window.location.href= BASE_URL + "Sitecontent/set_website/"+website_id;
    }
    </script>
@endsection