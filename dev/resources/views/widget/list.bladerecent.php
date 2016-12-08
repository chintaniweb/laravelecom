@extends('layouts.master_admin')
@section('content')
{!! Html::style('resources/assets/css/jquery-ui.css') !!}
{!! Html::script('resources/assets/js/jquery-1.10.2.js') !!}
{!! Html::script('resources/assets/js/jquery-ui.js') !!}

<script type="text/javascript">

    $(document).ready(function () {
    $(function() {
    $("#shipping ol").sortable({ cursor: 'move', update: function() {
    var url = "widget/sort_sidebar/";
            //var id = $("#sidebar_list");
            var order = $(this).sortable("serialize") + '&update=update';
            //alert(order);
            $.post(url, order, function(theResponse){
            });
    }
    });
    });
            $(function() {
            $("#foter ol").sortable({ cursor: 'move', update: function() {
            var url = "widget/sort_footer/";
                    //var id = $("#sidebar_list");
                    var order = $(this).sortable("serialize") + '&update=update';
                    //alert(order);
                    $.post(url, order, function(theResponse){
                    });
            }
            });
            });
            $("#catalog").accordion();
            $("#catalog li").draggable({
    appendTo: "body",
            helper: "clone"
    });
            /**
             * SHIPPING BOX
             */
            $("#shipping ol").droppable({
    out: function (event, ui) {
    var self = ui;
            ui.helper.off('mouseup').on('mouseup', function () {
    $(this).remove();
            self.draggable.remove();
    });
            $.ajax({
            type: "GET",
                    async: false,
                    url: 'widget/delete_sidebar/' + $(ui.draggable).attr("id"),
                    dataType:'html',
                    success: function (data) {
                    window.location.reload();
                    }
            });
    },
            activeClass: "ui-state-default",
            //hoverClass: "ui-state-hover",
            accept: ":not(.dashboard):not(.ui-sortable-helper):not(.fot)",
            drop: function (event, ui) {
            if (ui.draggable.is('.side')) {
            $(this).removeClass("ui-state-hover");
                    return false;
            }
            else {
            $.ajax({
            type: "GET",
                    async: false,
                    url: 'widget/sidebar_widget/' + $(ui.draggable).attr("id"),
                    dataType:'html',
                    success: function (data) {
                    window.location.reload();
                    }
            });
            }
            if (ui.draggable.is('.dropped'))
                    return false;
                    $(this).find(".placeholder").remove();
                    var list_li = "<li class='sidebar' id=" + $(ui.draggable).attr('id') + "></li>";
                    $(list_li).text(ui.draggable.text()).appendTo(this).draggable({
            appendTo: "body",
                    helper: "clone"
            }).addClass('dropped');
            }
    }).sortable({
    //items: "li:not(.placeholder)",
    sort: function () {
                // gets added unintentionally by droppable interacting with sortable
                // using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
    $(this).removeClass("ui-state-default");
    }
    });
            /**
             * Footer BOX
             */
            $("#foter ol").droppable({
    out: function (event, ui) {
    var self = ui;
            ui.helper.off('mouseup').on('mouseup', function () {
    $(this).remove();
            self.draggable.remove();
    });
            $.ajax({
            type: "GET",
                    async: false,
                    url: 'widget/delete_footer/' + $(ui.draggable).attr("id"),
                    dataType:'html',
                    success: function (data) {
                    window.location.reload();
                    }
            });
    },
            activeClass: "ui-state-default",
            //hoverClass: "ui-state-hover",
            accept: ":not(.dashboard):not(.ui-sortable-helper):not(.side)",
            drop: function (event, ui) {
            if (ui.draggable.is('.fot')) {
            return false;
            }
            else {
            $.ajax({
            type: "GET",
                    async: false,
                    url: 'widget/footer_widget/' + $(ui.draggable).attr("id"),
                    dataType:'html',
                    success: function (data) {
                    window.location.reload();
                    }
            });
            }
            if (ui.draggable.is('.dropped'))
                    return false;
                    $(this).find(".placeholder").remove();
                    var list_li = "<li class='foter' id=" + $(ui.draggable).attr('id') + "></li>";
                    $(list_li).text(ui.draggable.text()).appendTo(this).draggable({
            appendTo: "body",
                    helper: "clone",
            }).addClass('dropped');
            }
    }).sortable({
    items: "li:not(.placeholder)",
            sort: function () {
            // gets added unintentionally by droppable interacting with sortable
            // using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options                
            $(this).removeClass("ui-state-default");
            }
    });
    });
</script>

<style>
    h1 {
        padding: .2em;
        margin: 0;
    }
    #products {
        float:left;
        width: 300px;
        margin-right: 1em;
    }
    #cart-outer {
        width: 400px;
        margin-right: 1em;
    }
    #cart {
        width: 400px;
        float: left;
        margin-top: 1em;
        margin-right: 1em;
    }
    #shipping {
        width: 400px;
        float: left;
        margin-top: 1em;
        margin-right: 1em;
    }
    #foter {
        width: 400px;
        float: left;
        margin-top: 1em;
        margin-right: 1em;
    }
    /* style the list to maximize the droppable hitarea */
    #cart ol {
        margin: 0;
        padding: 1em 0 1em 3em;
    }
    #shipping ol {
        margin: 0;
        padding: 1em 0 1em 3em;
    }
    #foter ol {
        margin: 0;
        padding: 1em 0 1em 3em;
    }
</style>

</head>
<!-----------------------------------HEADLINE START------------------------------------------->
<div id="products" >
    <h1 class="ui-widget-header">Widgets</h1>
    <div id="catalog">
        <h2 ><a href="#">Sidebar</a></h2>
        <div>
            <ul>
                <li id='LIKE_BOX' class="sidebar">Like Box</li>
                <li id='SEARCH' class="sidebar">Search Box</li>
                <li id='RECENT_POST' class="sidebar">Recent Post</li>
                <li id='ARCHIVES' class="sidebar">Archives</li>
                <li id='NEWSLETTER' class="sidebar">NEWSLETTER</li>
            </ul>
        </div>
        <h2><a href="#">Common Widget</a></h2>
        <div>
            <ul>
                <li class="foter" id='text' >Text</li>
            </ul>
        </div>
    </div>
</div>
<!-----------------------------------HEADLINE END---------------------------------------------->

<div class="pull-left" id="cart-outer">
    <!------------------------------DASHBOARD WIDGET START----------------------------------------->
    <div id="cart" >
        <h1 class="ui-widget-header">Dashboard</h1>
        <div class=" ui-widget-content">
            <ol>
                @foreach ($data['dashboard_data'] as $dashboard) 
                <li class="dashboard" id="{{ $dashboard->widget_id }}" >
                    @if($dashboard->widget_id == 'UPDATED_PAGES')  
                    <div class="publish-con">
                        {!! Form::open(['url' => 'widget/update_dashboard_widget/'.$dashboard->widget_id,'class' => 'form-horizontal','id' => 'myForm']) !!}
                        <div class="bg-muted p-10">Last 5 Updated Pages: 
                            <span id="page_status">
                                {{ $dashboard->status }}
                            </span> 
                            <span class="edit-show m-l-10">
                                <a href="#" title="">Edit</a>  
                            </span>
                        </div>
                        <div id="published" class="p-t-10" hidden="true">
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Title</label>
                                <div class="col-sm-12">
                                    {!! Form::text('title',$dashboard->tile,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Status</label>
                                <div class="col-sm-12">
                                    {!! Form::select('status',['Yes' => 'Yes','No' => 'No'],$dashboard->status,['class' => 'form-control','style' => 'width:100%; display:inline;']) !!}
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Number of pages</label>
                                <div class="col-sm-12">
                                    {!! Form::text('option',$dashboard->option,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="p-0 m-t-15">
                                <span class="btn-right"><a id="btn" onclick="myFunction()"  class="btn btn-primary btn-rect btn-sm" href="javascript:void(0)"><i style="font-size:14px" class="icon-save"></i> Save Page</a></span>
                                <span id="cancel" class="m-l-10"><a href="#" title="">Cancel</br></a></span> 
                                <div class="clearfix"></div>                               
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @endif
                    @if($dashboard->widget_id == 'SEO_INFORMATION')
                    <div class="publish-con1">
                        {!! Form::open(['url' => 'widget/update_dashboard_widget/'.$dashboard->widget_id],['class' => 'form-horizontal','id' => 'myForm1']) !!}
                        <div class="bg-muted p-10">SEO Information: 
                            <span id="page_status1">
                                {{ $dashboard->widget_id }}
                            </span> 
                            <span class="edit-show1 m-l-10">
                                <a href="#" title="">Edit</a>  
                            </span>
                        </div>
                        <div id="published1" class="p-t-10" hidden="true">
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Title</label>
                                <div class="col-sm-12">
                                    {!! Form::text('title',$dashboard->title,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Status</label>
                                <div class="col-sm-12">
                                    {!! Form::select('status',['Yes' => 'Yes','No' => 'No'],$dashboard->status,['class' => 'form-control','style' => 'width:100%; display:inline;']) !!}                            
                                </div>
                            </div>
                            <div class="p-0 m-t-15">
                                <span class="btn-right">
                                    {!! Form::submit('Save Page',array('class' => 'btn btn-primary btn-rect btn-sm', 'onclick' => 'submitSeo()','id' => 'btn')) !!}
                                    <span id="cancel1" class="m-l-10"><a href="#" title="">Cancel</br></a></span>    
                                    <div class="clearfix"></div>                               
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @endif
                    @if($dashboard->widget_id == 'RECENTLY_VISITED_PAGES')
                    <div class="publish-con2">
                        {!! Form::open(['url' => 'widget/update_dashboard_widget/'.$dashboard->widget_id],['class'=>'form-horizontal','id' => 'myForm2']) !!}
                        <div class="bg-muted p-10">Recently Visited Pages: 
                            <span id="page_status2">
                                {{ $dashboard->status }}
                            </span> 
                            <span class="edit-show2 m-l-10">
                                <a href="#" title="">Edit</a>  
                            </span>
                        </div>
                        <div id="published2" class="p-t-10" hidden="true">
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Title</label>
                                <div class="col-sm-12">
                                    {!! Form::text('title',$dashboard->title,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Status</label>
                                <div class="col-sm-12">
                                    {!! Form::select('status',['Yes' => 'Yes','No' => 'No'],$dashboard->status,['class' => 'form-control','style' => 'width:100%; display:inline;']) !!}                            
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Number of pages</label>
                                <div class="col-sm-12">
                                    {!! Form::text('option',$dashboard->option,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="p-0 m-t-15">
                                <span class="btn-right">
                                    {!! Form::submit('Save Page',array('class' => 'btn btn-primary btn-rect btn-sm', 'onclick' => 'submitRecentlyViewPage()','id' => 'btn')) !!}
                                    <span id="cancel2" class="m-l-10"><a href="#" title="">Cancel</br></a></span>
                                    <div class="clearfix"></div>                               
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>   
                    @endif
                    @if($dashboard->widget_id == 'TOP_VISITED')
                    <div class="publish-con3">
                        {!! Form::open(['url' => 'widget/update_dashboard_widget/'.$dashboard->widget_id],['class' => 'form-horizontal','id' =>'myForm3']) !!}
                        <div class="bg-muted p-10">Top 5 visited Pages: 
                            <span id="page_status3">
                                {{ $dashboard->status }}
                            </span> 
                            <span class="edit-show3 m-l-10">
                                <a href="#" title="">Edit</a>  
                            </span>
                        </div>
                        <div id="published3" class="p-t-10" hidden="true">
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Title</label>
                                <div class="col-sm-12">
                                    {!! Form::text('title',$dashboard->tile,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Status</label>
                                <div class="col-sm-12">
                                    {!! Form::select('status',['Yes' => 'Yes','No' => 'No'],$dashboard->status,['class' => 'form-control','style' => 'width:100%; display:inline;']) !!}                            
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Number of pages</label>
                                <div class="col-sm-12">
                                    {!! Form::text('option',$dashboard->option,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="p-0 m-t-15">
                                <span class="btn-right">
                                    {!! Form::submit('Save Page',array('class' => 'btn btn-primary btn-rect btn-sm', 'onclick' => 'submitTopViewPage()','id' => 'btn')) !!}
                                    <span id="cancel3" class="m-l-10"><a href="#" title="">Cancel</br></a></span>    
                                    <div class="clearfix"></div>                               
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @endif
                </li>
                @endforeach
            </ol>
        </div>
    </div>
    <!------------------------------DASHBOARD WIDGET END---------------------------------------------->
    
    <!------------------------------SIDEBAR WIDGET START---------------------------------------------->
    <div id="shipping"><br>
        <h1 class="ui-widget-header">Sidebar</h1>

        <div class="ui-widget-content">
            <ol>
                @foreach($data['sidebar_data'] as $sidebar)
                <li class='side' id="{{ 'page_'.$sidebar->id }}">
                    @if($sidebar->widget_id == 'SEARCH') 
                    <div class="publish-con5">
                        {!! Form::open(['url' =>'widget/update_sidebar/'.$sidebar->widget_id , 'id' => 'myForm5'],['class' => 'form-horizontal' , 'id' => 'myForm5']) !!}
                        <div class="bg-muted p-10">Search Box : 
                            <span id="page_status4">
                                {{ $sidebar->status }}
                            </span> 
                            <span class="edit-show5 m-l-10">
                                <a href="#" title="">Edit</a>  
                            </span>
                            <span>
                                |  <a onclick="return confirm('Are you sure you want to delete this item?');" href="widget/delete_sidebar/{{ $sidebar->widget_id }}">Delete</a>
                            </span>
                        </div>
                        <div id="published5" class="p-t-10" hidden="true">
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Title</label>
                                <div class="col-sm-12">
                                    {!! Form::text('title',$sidebar->title,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Status</label>
                                <div class="col-sm-12">
                                    {!! Form::select('status',['Yes' => 'Yes','No' => 'No'],$sidebar->status,['class' => 'form-control','style' => 'width:100%; display:inline;']) !!}                                                        
                                </div>
                            </div>
                            <div class="p-0 m-t-15">
                                <span class="btn-right"><a id="btn" onclick="submitSearch()"  class="btn btn-primary btn-rect btn-sm" href="javascript:void(0)"><i style="font-size:14px" class="icon-save"></i> Save Page</a></span>
                                <span id="cancel5" class="m-l-10"><a href="#" title="">Cancel</br></a></span> 
                                <div class="clearfix"></div>                               
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @endif
                    <?php $str = strpbrk($sidebar->widget_id, 'stext') ?>
                    @if($str)
                    <div class="<?php echo 'publish' . $str; ?>">
                        {!! Form::open(['url' =>'widget/update_sidebar/'.$sidebar->widget_id, 'id' => 'form'.$str],['class' => 'form-horizontal' ]) !!}
                        <div class="bg-muted p-10">Text : 
                            <span id="page_status">
                                {{ $sidebar->title }}
                            </span> 
                            <span class="edit-{{ $str }} m-l-10">
                                <a href="#" title="">Edit</a>  
                            </span>
                            <span>
                                |  <a onclick="return confirm('Are you sure you want to delete this item?');" href="widget/delete_sidebar/{{ $sidebar->widget_id }}">Delete</a>
                            </span>
                        </div>
                        <div id="published{{$str}}" class="p-t-10" hidden="true">
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Title</label>
                                <div class="col-sm-12">
                                    {!! Form::text('title',$sidebar->title,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Content</label>
                                <div class="col-sm-12">
                                    {!! Form::textarea('content',$sidebar->content,['class' => 'form-control' , 'id' => '$sidebar->widgetId' ]) !!}
                                </div>
                            </div>
                            <div class="p-0 m-t-15">
                                <span class="btn-right"><a id="btn" onclick="{{ $str.'()' }}"  class="btn btn-primary btn-rect btn-sm" href="javascript:void(0)"><i style="font-size:14px" class="icon-save"></i> Save</a></span>
                                <span id="{{ 'cancel'.$str }}" class="m-l-10"><a href="#" title="">Cancel</br></a></span> 
                                <div class="clearfix"></div>                               
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @endif                
                    @if($sidebar->widget_id == 'RECENT_POST')
                    <div class="publish-con6">
                        {!! Form::open(['url' => 'widget/update_sidebar/'.$sidebar->widget_id, 'id' => 'myForm6'],['class' => 'form-horizontal' ]) !!}
                        <div class="bg-muted p-10">Recent Posts: 
                            <span id="page_status6">
                                {{ $sidebar->status }}
                            </span> 
                            <span class="edit-show6 m-l-10">
                                <a href="#" title="">Edit</a>  
                            </span>
                            <span>
                                |  <a onclick="return confirm('Are you sure you want to delete this item?');" href="widget/delete_sidebar/{{ $sidebar->widget_id }}">Delete</a>
                            </span>
                        </div>
                        <div id="published6" class="p-t-10" hidden="true">
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Title</label>
                                <div class="col-sm-12">
                                    {!! Form::text('title',$sidebar->title,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Status</label>
                                <div class="col-sm-12">
                                    {!! Form::select('status',['Yes' => 'Yes','No' => 'No'],$sidebar->status,['class' => 'form-control','style' => 'width:100%; display:inline;']) !!}
                                </div>
                            </div>
                            <div class="p-0 m-t-15">
                                <span class="btn-right"><a id="btn" onclick="submitRecentPost()"  class="btn btn-primary btn-rect btn-sm" href="javascript:void(0)"><i style="font-size:14px" class="icon-save"></i> Save Page</a></span>
                                <span id="cancel6" class="m-l-10"><a href="#" title="">Cancel</br></a></span>    
                                <div class="clearfix"></div>                               
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @endif
                    @if($sidebar->widget_id == 'LIKE_BOX')
                    <div class="publish-con7">
                        {!! Form::open(['url' => 'widget/update_sidebar/'.$sidebar->widget_id, 'id' => 'myForm4'],['class' => 'form-horizontal' ]) !!}
                        <div class="bg-muted p-10">LikeBox: 
                            <span id="page_status7">
                                {{ $sidebar->status }}
                            </span> 
                            <span class="edit-show7 m-l-10">
                                <a href="#" title="">Edit</a>  
                            </span>
                            <span>
                                |  <a onclick="return confirm('Are you sure you want to delete this item?');" href="widget/delete_sidebar/{{ $sidebar->widget_id }}">Delete</a>
                            </span>
                        </div>
                        <div id="published7" class="p-t-10" hidden="true">
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Title</label>
                                <div class="col-sm-12">
                                    {!! Form::text('title',$sidebar->title,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Status</label>
                                <div class="col-sm-12">
                                    {!! Form::select('status',['Yes' => 'Yes','No' => 'No'],$sidebar->status,['class' => 'form-control','style' => 'width:100%; display:inline;']) !!}                          
                                </div>
                            </div>
                            <div class="p-0 m-t-15">
                                <span class="btn-right"><a id="btn" onclick="submitLikeBox()"  class="btn btn-primary btn-rect btn-sm" href="javascript:void(0)"><i style="font-size:14px" class="icon-save"></i> Save Page</a></span>
                                <span id="cancel7" class="m-l-10"><a href="#" title="">Cancel</br></a></span>    
                                <div class="clearfix"></div>                               
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @endif
                    @if($sidebar->widget_id == 'ARCHIVES')
                    <div class="publish-con8">
                        {!! Form::open(['url' => 'widget/update_sidebar/'.$sidebar->widget_id, 'id' => 'myForm8'],['class' => 'form-horizontal' ]) !!}
                        <div class="bg-muted p-10">Archives: 
                            <span id="page_status8">
                                {{ $sidebar->status }}
                            </span> 
                            <span class="edit-show8 m-l-10">
                                <a href="#" title="">Edit</a>  
                            </span>
                            <span>
                                |  <a onclick="return confirm('Are you sure you want to delete this item?');" href="widget/delete_sidebar/{{ $sidebar->widget_id }}">Delete</a>
                            </span>
                        </div>
                        <div id="published8" class="p-t-10" hidden="true">
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Title</label>
                                <div class="col-sm-12">
                                    {!! Form::text('title',$sidebar->title,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Status</label>
                                <div class="col-sm-12">
                                    {!! Form::select('status',['Yes' => 'Yes','No' => 'No'],$sidebar->status,['class' => 'form-control','style' => 'width:100%; display:inline;']) !!}
                                </div>
                            </div>
                            <div class="p-0 m-t-15">
                                <span class="btn-right"><a id="btn" onclick="submitArchives()"  class="btn btn-primary btn-rect btn-sm" href="javascript:void(0)"><i style="font-size:14px" class="icon-save"></i> Save Page</a></span>
                                <span id="cancel8" class="m-l-10"><a href="#" title="">Cancel</br></a></span>    
                                <div class="clearfix"></div>                               
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @endif
                    @if($sidebar->widget_id == 'TAG')
                    <div class="publish-con9">
                        {!! Form::open(['url' => 'widget/update_sidebar/'.$sidebar->widget_id, 'id' => 'myForm9'],['class' => 'form-horizontal' , 'id' => 'myForm9']) !!}
                        <div class="bg-muted p-10">Tag : 
                            <span id="page_status7">
                                {{ $sidebar->status }}
                            </span> 
                            <span class="edit-show9 m-l-10">
                                <a href="#" title="">Edit</a>  
                            </span>
                            <span>
                                |  <a onclick="return confirm('Are you sure you want to delete this item?');" href="widget/delete_sidebar/{{ $sidebar->widget_id }}">Delete</a>
                            </span>
                        </div>
                        <div id="published9" class="p-t-10" hidden="true">
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Title</label>
                                <div class="col-sm-12">
                                    {!! Form::text('title',$sidebar->title,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Status</label>
                                <div class="col-sm-12">
                                    {!! Form::select('status',['Yes' => 'Yes','No' => 'No'],$sidebar->status,['class' => 'form-control','style' => 'width:100%; display:inline;']) !!}
                                </div>
                            </div>
                            <div class="p-0 m-t-15">
                                <span class="btn-right"><a id="btn" onclick="submitTag()"  class="btn btn-primary btn-rect btn-sm" href="javascript:void(0)"><i style="font-size:14px" class="icon-save"></i> Save Page</a></span>
                                <span id="cancel9" class="m-l-10"><a href="#" title="">Cancel</br></a></span>    
                                <div class="clearfix"></div>                               
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @endif
                    @if($sidebar->widget_id == 'NEWSLETTER')
                    <div class="publish-con10">
                        {!! Form::open(['url' => 'widget/update_sidebar/'.$sidebar->widget_id, 'id' => 'myForm10'],['class' => 'form-horizontal' ]) !!}
                        <div class="bg-muted p-10">NEWS LETTER : 
                            <span id="page_status7">
                                {{ $sidebar->status }}
                            </span> 
                            <span class="edit-show10 m-l-10">
                                <a href="#" title="">Edit</a>  
                            </span>
                            <span>
                                |  <a onclick="return confirm('Are you sure you want to delete this item?');" href="widget/delete_sidebar/{{ $sidebar->widget_id }}">Delete</a>
                            </span>
                        </div>
                        <div id="published10" class="p-t-10" hidden="true">
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Title</label>
                                <div class="col-sm-12">
                                    {!! Form::text('title',$sidebar->title,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Status</label>
                                <div class="col-sm-12">
                                    {!! Form::select('status',['Yes' => 'Yes','No' => 'No'],$sidebar->status,['class' => 'form-control','style' => 'width:100%; display:inline;']) !!}
                                </div>
                            </div>
                            <div class="p-0 m-t-15">
                                <span class="btn-right"><a id="btn" onclick="submitNewsLetter()"  class="btn btn-primary btn-rect btn-sm" href="javascript:void(0)"><i style="font-size:14px" class="icon-save"></i> Save Page</a></span>
                                <span id="cancel10" class="m-l-10"><a href="#" title="">Cancel</br></a></span>    
                                <div class="clearfix"></div>                               
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @endif
                </li>
                @endforeach
            </ol>
        </div>
    </div>
    <!------------------------------SIDEBAR WIDGET END---------------------------------------------->
</div>
<div>
    <!------------------------------FOOTER WIDGET START--------------------------------------------->
    <div id="foter">
        <h1 class="ui-widget-header">Footer</h1>
        <div class="ui-widget-content">
            <ol>
                @foreach($data['footer_data'] as $footer) 
                <li class='fot' id="page_{{ $footer->id }}">
                    <?php $str = strpbrk($footer->widget_id, 'ftext'); ?>
                    @if($str) 
                    <div class="publish{{ $str }}">
                        {!! Form::open(['url' => 'widget/update_footer/'.$footer->widget_id, 'id' => 'form'. $str],['class' => 'form-horizontal' ]) !!}
                        <div class="bg-muted p-10">Text : 
                            <span id="page_status">
                                {{ $footer->title }}
                            </span>
                            <span class="edit-{{ $str }} m-l-10">
                                <a href="#" title="">Edit</a> 
                            </span>
                            <span>
                                |  <a onclick="return confirm('Are you sure you want to delete this item?');" href="widget/delete_footer/{{ $footer->widget_id }}">Delete</a>
                            </span>
                        </div>
                        <div id="published{{ $str }}" class="p-t-10" hidden="true">
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Title</label>
                                <div class="col-sm-12">
                                    {!! Form::text('title',$footer->title,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Content</label>
                                <div class="col-sm-12">
                                    {!! Form::textarea('content',$footer->content,['class' => 'form-control' , 'id' => 'footer->widgetId' ]) !!}
                                </div>
                            </div>
                            <div class="p-0 m-t-15">
                                <span class="btn-right"><a id="btn" onclick="{{ $str.'()'}}"  class="btn btn-primary btn-rect btn-sm" href="javascript:void(0)"><i style="font-size:14px" class="icon-save"></i> Save</a></span>
                                <span id="cancel{{ $str }}" class="m-l-10"><a href="#" title="">Cancel</br></a></span> 
                                <div class="clearfix"></div>                               
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @endif
                    @if($footer->widget_id == 'SEARCH')
                    <div class="publish-con5">
                        {!! Form::open(['url' =>'widget/update_footer/'.$footer->widget_id, 'id' => 'fmyForm5'],['class' => 'form-horizontal' ]) !!}
                        <div class="bg-muted p-10">Search Box : 
                            <span id="page_status4">
                                {{ $footer->status }}
                            </span> 
                            <span class="fedit-show5 m-l-10">
                                <a href="#" title="">Edit</a>  
                            </span>
                            <span>
                                |  <a onclick="return confirm('Are you sure you want to delete this item?');" href="Widget/delete_footer/{{ $footer->widget_id }}">Delete</a>
                            </span>
                        </div>
                        <div id="fpublished5" class="p-t-10" hidden="true">
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Title</label>
                                <div class="col-sm-12">
                                    {!! Form::text('title',$footer->title,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Status</label>
                                <div class="col-sm-12">
                                    {!! Form::select('status',['Yes' => 'Yes','No' => 'No'],$footer->status,['class' => 'form-control','style' => 'width:100%; display:inline;']) !!}
                                </div>
                            </div>
                            <div class="p-0 m-t-15">
                                <span class="btn-right"><a id="btn" onclick="fsubmitSearch()"  class="btn btn-primary btn-rect btn-sm" href="javascript:void(0)"><i style="font-size:14px" class="icon-save"></i> Save Page</a></span>
                                <span id="fcancel5" class="m-l-10"><a href="#" title="">Cancel</br></a></span> 
                                <div class="clearfix"></div>                               
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @endif
                    @if($footer->widget_id == 'RECENT_POST') 
                    <div class="fpublish-con6">
                        {!! Form::open(['url' =>'widget/update_footer/'.$footer->widget_id, 'id' => 'fmyForm6'],['class' => 'form-horizontal' ]) !!}
                        <div class="bg-muted p-10">Recent Posts: 
                            <span id="page_status6">
                                {{ $footer->status }}
                            </span> 
                            <span class="fedit-show6 m-l-10">
                                <a href="#" title="">Edit</a>  
                            </span>
                            <span>
                                |  <a onclick="return confirm('Are you sure you want to delete this item?');" href="widget/delete_footer/{{ $footer->widget_id }}">Delete</a>
                            </span>
                        </div>
                        <div id="fpublished6" class="p-t-10" hidden="true">
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Title</label>
                                <div class="col-sm-12">
                                    {!! Form::text('title',$footer->title,['class' => 'form-control']) !!}                                   
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Status</label>
                                <div class="col-sm-12">
                                    {!! Form::select('status',['Yes' => 'Yes','No' => 'No'],$footer->status,['class' => 'form-control','style' => 'width:100%; display:inline;']) !!}
                                </div>
                            </div>
                            <div class="p-0 m-t-15">
                                <span class="btn-right"><a id="btn" onclick="fsubmitRecentPost()"  class="btn btn-primary btn-rect btn-sm" href="javascript:void(0)"><i style="font-size:14px" class="icon-save"></i> Save Page</a></span>
                                <span id="fcancel6" class="m-l-10"><a href="#" title="">Cancel</br></a></span>    
                                <div class="clearfix"></div>                               
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @endif

                    @if($footer->widget_id == 'ARCHIVES')                    
                    <div class="fpublish-con8">
                        {!! Form::open(['url' =>'widget/update_footer/'.$footer->widget_id, 'id' => 'fmyForm8'],['class' => 'form-horizontal' ]) !!}                    
                        <div class="bg-muted p-10">Archives: 
                            <span id="page_status8">
                                {{$footer->status}}
                            </span> 
                            <span class="fedit-show8 m-l-10">
                                <a href="#" title="">Edit</a>  
                            </span>
                            <span>
                                |  <a onclick="return confirm('Are you sure you want to delete this item?');" href="widget/delete_footer/{{$footer->widget_id}}">Delete</a>
                            </span>
                        </div>
                        <div id="fpublished8" class="p-t-10" hidden="true">
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Title</label>
                                <div class="col-sm-12">
                                    {!! Form::text('title',$footer->title,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Status</label>
                                <div class="col-sm-12">
                                    {!! Form::select('status',['Yes' => 'Yes','No' => 'No'],$footer->status,['class' => 'form-control','style' => 'width:100%; display:inline;']) !!}                            
                                </div>
                            </div>
                            <div class="p-0 m-t-15">
                                <span class="btn-right"><a id="btn" onclick="fsubmitArchives()"  class="btn btn-primary btn-rect btn-sm" href="javascript:void(0)"><i style="font-size:14px" class="icon-save"></i> Save Page</a></span>
                                <span id="fcancel8" class="m-l-10"><a href="#" title="">Cancel</br></a></span>    
                                <div class="clearfix"></div>                               
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @endif
                    @if($footer->widget_id == 'TAG')
                    <div class="fpublish-con9">
                        {!! Form::open(['url' =>'widget/update_footer/'.$footer->widget_id, 'id' => 'fmyForm9'],['class' => 'form-horizontal' ]) !!}                   
                        <div class="bg-muted p-10">Tag : 
                            <span id="page_status7">
                                {{$footer->status}}
                            </span> 
                            <span class="fedit-show9 m-l-10">
                                <a href="#" title="">Edit</a>  
                            </span>
                            <span>
                                |  <a onclick="return confirm('Are you sure you want to delete this item?');" href="widget/delete_footer/{{$footer->widget_id}}">Delete</a>
                            </span>
                        </div>
                        <div id="fpublished9" class="p-t-10" hidden="true">
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Title</label>
                                <div class="col-sm-12">
                                    {!! Form::text('title',$footer->title,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Status</label>
                                <div class="col-sm-12">
                                    {!! Form::select('status',['Yes' => 'Yes','No' => 'No'],$footer->status,['class' => 'form-control','style' => 'width:100%; display:inline;']) !!}
                                </div>
                            </div>
                            <div class="p-0 m-t-15">
                                <span class="btn-right"><a id="btn" onclick="fsubmitTag()"  class="btn btn-primary btn-rect btn-sm" href="javascript:void(0)"><i style="font-size:14px" class="icon-save"></i> Save Page</a></span>
                                <span id="fcancel9" class="m-l-10"><a href="#" title="">Cancel</br></a></span>    
                                <div class="clearfix"></div>                               
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @endif
                    @if($footer->widget_id == 'NEWSLETTER')
                    <div class="fpublish-con10">
                        {!! Form::open(['url' =>'widget/update_footer/'.$footer->widget_id, 'id' => 'fmyForm10'],['class' => 'form-horizontal' ]) !!}
                        <div class="bg-muted p-10">NEWS LETTER : 
                            <span id="page_status7">
                                {{$footer->status}}
                            </span> 
                            <span class="fedit-show10 m-l-10">
                                <a href="#" title="">Edit</a>  
                            </span>
                            <span>
                                |  <a onclick="return confirm('Are you sure you want to delete this item?');" href="widget/delete_footer/{{$footer->widget_id}}">Delete</a>
                            </span>
                        </div>
                        <div id="fpublished10" class="p-t-10" hidden="true">
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Title</label>
                                <div class="col-sm-12">
                                    {!! Form::text('title',$footer->title,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                                <label class="control-label col-sm-12" for="site">Status</label>
                                <div class="col-sm-12">
                                    {!! Form::select('status',['Yes' => 'Yes','No' => 'No'],$footer->status,['class' => 'form-control','style' => 'width:100%; display:inline;']) !!}
                                </div>
                            </div>

                            <div class="p-0 m-t-15">
                                <span class="btn-right"><a id="btn" onclick="fsubmitNewsLetter()"  class="btn btn-primary btn-rect btn-sm" href="javascript:void(0)"><i style="font-size:14px" class="icon-save"></i> Save Page</a></span>
                                <span id="fcancel10" class="m-l-10"><a href="#" title="">Cancel</br></a></span>    
                                <div class="clearfix"></div>                               
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @endif
                </li>
                @endforeach
            </ol>
        </div>
    </div>
    <!------------------------------FOOTER WIDGET END---------------------------------------------->
</div>
<div class="clearfix"></div>
<script type="text/javascript">
            $(document).ready(function () {

    $(".edit-show").click(function () {
    $("#published").slideToggle();
            $('.edit-show').hide();
    });
            $(".edit-show1").click(function () {
    $("#published1").slideToggle();
            $('.edit-show1').hide();
    });
            $(".edit-show2").click(function () {
    $("#published2").slideToggle();
            $('.edit-show2').hide();
    });
            $(".edit-show3").click(function () {
    $("#published3").slideToggle();
            $('.edit-show3').hide();
    });
            $(".edit-show4").click(function () {
    $("#published4").slideToggle();
            $('.edit-show4').hide()
    });
            $(".edit-show5").click(function () {
    $("#published5").slideToggle();
            $('.edit-show5').hide()
    });
            $(".edit-show6").click(function () {
    $("#published6").slideToggle();
            $('.edit-show6').hide()
    });
            $(".edit-show7").click(function () {
    $("#published7").slideToggle();
            $('.edit-show7').hide()
    });
            $(".edit-show8").click(function () {
    $("#published8").slideToggle();
            $('.edit-show8').hide()
    });
            $(".edit-show9").click(function () {
    $("#published9").slideToggle();
            $('.edit-show9').hide()
    });
            $(".edit-show10").click(function () {
    $("#published10").slideToggle();
            $('.edit-show10').hide()
    });
            $(".fedit-show4").click(function () {
    $("#fpublished4").slideToggle();
            $('.fedit-show4').hide()
    });
            $(".fedit-show5").click(function () {
    $("#fpublished5").slideToggle();
            $('.fedit-show5').hide()
    });
            $(".fedit-show6").click(function () {
    $("#fpublished6").slideToggle();
            $('.fedit-show6').hide()
    });
            $(".fedit-show7").click(function () {
    $("#fpublished7").slideToggle();
            $('.fedit-show7').hide()
    });
            $(".fedit-show8").click(function () {
    $("#fpublished8").slideToggle();
            $('.fedit-show8').hide()
    });
            $(".fedit-show9").click(function () {
    $("#fpublished9").slideToggle();
            $('.fedit-show9').hide()
    });
            $(".fedit-show10").click(function () {
    $("#fpublished10").slideToggle();
            $('.fedit-show10').hide()
    });
            @foreach ($data['sidebar_data'] as $sidebar)
            @if (strpbrk($sidebar -> widget_id, 'stext'))
            $("<?php echo '.edit-' . $sidebar->widget_id; ?>").click(function () {
    $("<?php echo '#published' . $sidebar->widget_id; ?>").slideToggle();
            $('<?php echo '.edit-' . $sidebar->widget_id; ?>').hide()
    });
            @endif
            @endforeach

            @foreach ($data['footer_data'] as $footer)
            @if (strpbrk($footer -> widget_id, 'ftext'))
            $("<?php echo '.edit-' . $footer->widget_id; ?>").click(function () {
    $("<?php echo '#published' . $footer->widget_id; ?>").slideToggle();
            $('<?php echo '.edit-' . $footer->widget_id; ?>').hide()
    });
            @endif
            @endforeach

            $("#cancel").click(function () {
    $("#published").slideUp();
            $('.edit-show').show()
    });
            $("#cancel1").click(function () {
    $("#published1").slideUp();
            $('.edit-show1').show()
    });
            $("#cancel2").click(function () {
    $("#published2").slideUp();
            $('.edit-show2').show()
    });
            $("#cancel3").click(function () {
    $("#published3").slideUp();
            $('.edit-show3').show()
    });
            $("#cancel4").click(function () {
    $("#published4").slideUp();
            $('.edit-show4').show()
    });
            $("#cancel5").click(function () {
    $("#published5").slideUp();
            $('.edit-show5').show()
    });
            $("#cancel6").click(function () {
    $("#published6").slideUp();
            $('.edit-show6').show()
    });
            $("#cancel7").click(function () {
    $("#published7").slideUp();
            $('.edit-show7').show()
    });
            $("#cancel8").click(function () {
    $("#published8").slideUp();
            $('.edit-show8').show()
    });
            $("#cancel9").click(function () {
    $("#published9").slideUp();
            $('.edit-show9').show()
    });
            $("#cancel10").click(function () {
    $("#published10").slideUp();
            $('.edit-show10').show()
    });
            $("#fcancel4").click(function () {
    $("#fpublished4").slideUp();
            $('.fedit-show4').show()
    });
            $("#fcancel5").click(function () {
    $("#fpublished5").slideUp();
            $('.fedit-show5').show()
    });
            $("#fcancel6").click(function () {
    $("#fpublished6").slideUp();
            $('.fedit-show6').show()
    });
            $("#fcancel7").click(function () {
    $("#fpublished7").slideUp();
            $('.fedit-show7').show()
    });
            $("#fcancel8").click(function () {
    $("#fpublished8").slideUp();
            $('.fedit-show8').show()
    });
            $("#fcancel9").click(function () {
    $("#fpublished9").slideUp();
            $('.fedit-show9').show()
    });
            $("#fcancel10").click(function () {
    $("#fpublished10").slideUp();
            $('.fedit-show10').show()
    });
            @foreach ($data['sidebar_data'] as $sidebar)
            @if (strpbrk($sidebar -> widget_id, 'stext'))
            $("<?php echo '#cancel' . $sidebar->widget_id; ?>").click(function () {
    $("<?php echo '#published' . $sidebar->widget_id; ?>").slideUp();
            $('<?php echo '.edit-' . $sidebar->widget_id; ?>').show()
    });
            @endif
            @endforeach

            @foreach ($data['footer_data'] as $footer)
            @if (strpbrk($footer -> widget_id, 'ftext'))
            $("<?php echo '#cancel' . $footer->widget_id; ?>").click(function () {
    $("<?php echo '#published' . $footer->widget_id; ?>").slideUp();
            $('<?php echo '.edit-' . $footer->widget_id; ?>').show()
    });
            @endif
            @endforeach
    });
            /* right box script */
</script>         

<script type="text/javascript">
                    function popup(url) {
                    window.open(url, 'popUpWindow', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100width=600,height=600');
                    }
            function myFunction() {

            document.getElementById("myForm").submit();
            }
            function submitSeo() {

            document.getElementById("myForm1").submit();
            }
            function submitRecentlyViewPage() {

            document.getElementById("myForm2").submit();
            }

            function submitTopViewPage() {

            document.getElementById("myForm3").submit();
            }
            function  submitLikeBox() {

            document.getElementById("myForm4").submit();
            }
            function  submitSearch() {

            document.getElementById("myForm5").submit();
            }

            function  submitRecentPost() {

            document.getElementById("myForm6").submit();
            }

            function  submitBlogCategory() {

            document.getElementById("myForm7").submit();
            }
            function  submitArchives() {

            document.getElementById("myForm8").submit();
            }

            function  submitTag() {

            document.getElementById("myForm9").submit();
            }

            function  submitNewsLetter() {

            document.getElementById("myForm10").submit();
            }

            // Footer

            function  fsubmitLikeBox() {

            document.getElementById("fmyForm4").submit();
            }

            function  fsubmitSearch() {

            document.getElementById("fmyForm5").submit();
            }

            function  fsubmitRecentPost() {

            document.getElementById("fmyForm6").submit();
            }

            function  fsubmitBlogCategory() {

            document.getElementById("fmyForm7").submit();
            }
            function  fsubmitArchives() {

            document.getElementById("fmyForm8").submit();
            }

            function  fsubmitTag() {

            document.getElementById("fmyForm9").submit();
            }

            function  fsubmitNewsLetter() {

            document.getElementById("fmyForm10").submit();
            }

            @foreach ($data['sidebar_data'] as $sidebar)
                    @if (strpbrk($sidebar -> widget_id, 'stext'))
                    function  <?php echo $sidebar->widget_id . '()'; ?> {
                    document.getElementById("<?php echo 'form' . $sidebar->widget_id; ?>").submit();
                    }
            @endif
                    @endforeach

                    @foreach ($data['footer_data'] as $footer)
                    @if (strpbrk($footer -> widget_id, 'ftext'))
                    function  <?php echo $footer->widget_id . '()'; ?> {
                    document.getElementById("<?php echo 'form' . $footer->widget_id; ?>").submit();
                    }
            @endif
                    @endforeach
</script>

@stop