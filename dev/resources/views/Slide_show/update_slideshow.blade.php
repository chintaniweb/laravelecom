
@extends('layouts.master_admin')
@section('content')
<style>
    .form-main-box .alert.alert-error {padding:10px 0 0 10px !important; margin:0 !important; border:0px !important; border-radius:0 !important;}

    #form label.error {
        color:red;
    }
    #form input.error {
        border:1px solid red;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <h4 class="page-title">Updated Slide Show</h4>
        </div>
         <?php
                      
        $slide_show_id = Request::segment(2);
       ?>
       <div class="info-title page-info page-info-title">View Slide Show: <a target="_blank" href="{{url('/').'/Slide_show/Index/' . $slide_show_id}}">{{url('/').'/Slide_show/Index/' . $slide_show_id}}</a></div>
    </div>
    <div class="row">
        {!! Form::model($data, array('route' => array('Slide_show.update', $data->slide_show_id), 'method' => 'PUT','files'=>'true','class' => 'form-horizontal','id'=>'myForm')) !!}
        <div class="col-xs-12 col-sm-12 m-t-20">
       
            
                <div class="card-box m-b-0">
                    <div class="row">
                        <div class=" col-sm-12 col-xs-12 p-t-b-10">
                             @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('message') }}</p>
                        @endif
                            <div class="form-group row form-main-box">
                                {!!Form::label('Slide Show Title','Slide Show Title',['class'=>'control-label col-md-4 text-right','style'=>'padding-top:8px'])!!}
                                <div class="col-md-7">
                                    {!!Form::text('title',null,['class'=>'form-control','id'=>'title'])!!}
                                     @if ($errors->has('title'))<p class="text-danger col-md-7 m-0 p-0">{{ $errors->first('title') }}</p>@endif 
                                </div>
                             </div>
                            <div class="form-group row form-main-box">
                                {!!Form::label('Transitions','Transitions',['class'=>'control-label col-md-4 text-right','style'=>'padding-top:8px'])!!}
                                <div class="col-md-7">
                                    {!! Form::select('transitions', ['Flash' => 'Flash','Fade' => 'Fade','Pulse'=>'Pulse','Slide'=>'Slide','Fadeslide'=>'Fadeslide'] ,null,['class' => 'form-control']) !!}
                                    <div class="text-left m-b-10"><span><b>Instructions:</b></br> Enter your title and optional description - you will be able to reference this Slide Show from any page as well as direct individuals to your slide show area to view all the available shows. You can add 99 photos to each slide show - up to 5 photos at a time. Each photo will be resized to fit the slide show viewer.</span></div>
                                </div>
                            </div> 
                        <div class="form-group row form-main-box">
                            {!!Form::label('slide_show_category_id','Category',['class'=>'control-label col-sm-4 text-right','style'=>'padding-top:8px'])!!} 

                            <div class="col-sm-7">
                                {!! Form::select('slide_show_category_id',$category,null,array('class' => 'form-control')) !!}   

                            </div>

                        </div>
                            <div class="form-group row form-main-box">
                                {!!Form::label('Slide Show Password','Slide Show Password',['class'=>'control-label col-md-4 text-right','style'=>'padding-top:8px'])!!}
                                 <div class="col-md-7">
                                     {!!Form::password('password',['class'=>'form-control','id'=>'password'])!!}
                                     @if ($errors->has('password')) <p class="help-block text-danger">{{ $errors->first('password') }}</p> @endif
                                </div>
                              </div>
                            <div class="form-group row form-main-box">
                                {!!Form::label('Sort','Sort',['class'=>'control-label col-md-4 text-right','style'=>'padding-top:8px'])!!}
                                <div class="col-md-7">
                                    {!!Form::text('slide_show_sort',null,['class'=>'form-control','id'=>'slide_show_sort'])!!}
                                     @if ($errors->has('slide_show_sort')) <p class="help-block text-danger">{{ $errors->first('slide_show_sort') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                               {!!Form::label('on_site_date','Start Date',['class'=>'control-label col-md-4 text-right','style'=>'padding-top:8px'])!!}
                                
                                <div class="col-md-7">
                                    {!! Form::hidden('on_site_date',null,['class' => 'form-control','id' => 'hidden_on_site_date']) !!}
                                    
                                    <div id='on_site_date' name="on_site_date">&nbsp;</div>
                                </div>
                            </div>
                            <div class="form-group row form-main-box">
                               {!!Form::label('off_site_date','End Date',['class'=>'control-label col-md-4 text-right','style'=>'padding-top:8px'])!!}
                                
                                <div class="col-md-7">
                                    {!! Form::hidden('off_site_date',null,['class' => 'form-control','id' => 'hidden_off_site_date']) !!}
                                    
                                    <div id='off_site_date' name="off_site_date">&nbsp;</div>
                                </div>
                            </div>   
                            <div class="form-group row form-main-box">
                                {!!Form::label('Description','Description',['class'=>'control-label col-md-4 text-right','style'=>'padding-top:8px'])!!}
                                
                                <div class="col-md-7">
                                    {!!Form::textarea('description',null,['class'=>'form-control','id'=>'description','rows' => 2, 'cols' => 40])!!}
                                    
                                    <div class="text-left m-b-10"><span>description is optional, it appears before the pictures</span></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10">
                                {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
                            </div>
                            
                        </div>
                        <div style="position:relative;">
            <div class="navbar-fixed-bottom fix-b-list">
                <div class="card-box " style="background-color:#f5f5f5;">
                    <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center"> 
                        {!! Form::submit('Save ',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
                        <!--a class="adminlink btn btn-danger btn-rect btn-sm" href="javascript: if (confirm('Are you sure you want to delete this page?')) { if (confirm('This will remove all data related to this page. (Including Backup)')) {document.location.href='manage.php?p=page_mng&amp;a=delete&amp;PageId=147&amp;RetFlg=&amp;page=1&amp;perPage=50&amp;PageTypeS=All&amp;box_search=';}}"><i style="font-size:14px" class="icon-minus-circle"></i>Cancel</a--> </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
                        {!!Form::close()!!}
                        <div class="col-sm-12 col-xs-12 p-t-b-10">
                        <!-- Delete Form --> 
                        {!! Form::open(array('url' => 'Slide_show/' . $data->slide_show_id)) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::submit('Delete', array('class' => 'btn btn-primary btn-rect btn-sm','onclick' => 'return confirm("Are you sure you want to delete this item?")')) !!}
                         {!! Form::close() !!}

                        click here to delete slide show 
                    </div>
                        <?php
                          $id=Request::segment(2);
                        
                        ?>
                        
                        
                        {!!Form::open(['url'=> 'Slide_show/'.$id.'/Slide_show/update/'.$data1->slide_show_images_id,'files'=>'true'])!!}
                       
                        
                                <div class="card-box m-b-0">
                                    <br>
                                    <div class="row">

                                        <div class="col-sm-12 col-xs-12 p-t-b-10"><strong></strong></div>
                                        <div class="col-md-12 col-xs-12">
                                            <div class="info-title page-info page-info-title">Image (Add:Edit)</div>    

                                            <div class="form-group row form-main-box">
                                                {!!Form::label('Upload File','Upload File',['class'=>'control-label col-sm-4 text-right','style'=>'padding-top:8px'])!!}
                                                  <div class="col-sm-7">
                                                       {!! Form::file('image', ['class' => 'btn btn-block btn-grey', 'autocomplete' => 'off']),null !!}
                                                    <img width="248 " height="150 " alt="" src="{{ url('resources/views/Slide_show/slide_show_file/'.$data1->image) }}">
                                                    
                                                    
                                                </div>
                                               
                                            </div>
                                            <div class="form-group row form-main-box">
                                                {!!Form::label('Sort','Sort',['class'=>'control-label col-sm-4','style'=>'padding-top:8px'])!!}
                                                
                                                <div class="col-sm-7">
                                                    {!!Form::text('image_sort',$data1->image_sort,['class'=>'form-control','id'=>'image_sort'])!!}
                                                    
                                                </div>
                                            </div>                        
                                            <div class="form-group row form-main-box">
                                                {!!Form::label('Image Caption','Image Caption',['class'=>'control-label col-sm-4','style'=>'padding-top:8px'])!!}
                                               
                                                <div class="col-sm-7">
                                                    {!!Form::text('image_caption',$data1->image_caption,['class'=>'form-control','id'=>'title'])!!}
                                                    
                                                </div>
                                            </div>                        
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10">
                                             {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
                                        </div>
                                        
                                        <div class="clearfix"></div>
                                        <br>
                                        <div class="info-title page-info page-info-title">Current Images</div>
                                   
                                    @foreach($data2 as $row) 
                                       @if(($row->image != "") && (file_exists("resources/views/Slide_show/slide_show_file/" . $row->image)))
                                      
                                             
                                           
                                            <div align="center"><br><br>
                                                <img width="150px" src="<?php echo url('/'). "/resources/views/Slide_show/slide_show_file/" . $row->image; ?>" alt="small image" border="0"><br><br>
                                                <?php echo $row->image_caption; ?><br>
                                                <font face="verdana" size="-1" color="000000">
                                                <?php
                                                $id=Request::segment(2);
                                                ?>
                                                 <a href="{{ url('Slide_show/'.$id.'/Slide_show/update/'.$row->slide_show_images_id) }}">Edit</a>
                                                 |<a target="_blank" href="<?php echo url('/') . "/resources/views/Slide_show/slide_show_file/" . $row->image; ?>">Click here to see Large Image</a>
                                                 |<a href="{{ url('Slide_show/'.$id.'/Slide_show/delete/'.$row->slide_show_images_id) }}" onclick="return confirm('Are you sure you want to delete this item?');">
                                                  Delete Image</a>  
                                                

                                                </font>
                                                
                                            </div>
                                       @endif
                                    @endforeach
                                    
                                </div>
                                    </div>
                           {!!Form::close()!!}
                           
                    </div>
                </div>
        </div>

        
    </div>
</div>
    
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcore.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxcalendar.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/jqxdatetimeinput.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/plugins/jqwidgets/globalization/globalize.js"></script> 
<script type="text/javascript" src="<?php echo url('/'); ?>/resources/assets/js/custom.js"></script> 
    


    <!-- jQuery Form Validation code -->
   <script>

    
    $(document).ready(function () {
      
        //get value from PHP - hidden element
        hidden_on_site_date = $("#hidden_on_site_date").val();
        hidden_off_site_date = $("#hidden_off_site_date").val();
      
        //set updated date
        if (hidden_on_site_date != "01/01/1970")
            $('#on_site_date').jqxDateTimeInput('setDate', hidden_on_site_date);
        if (hidden_off_site_date != "01/01/1970")
            $('#off_site_date').jqxDateTimeInput('setDate', hidden_off_site_date);
    
    });
    
        
    $("#on_site_date").jqxDateTimeInput({width: '300px', height: '30px', formatString: "MM/dd/yyyy"})
    $("#off_site_date").jqxDateTimeInput({width: '300px', height: '30px', formatString: "MM/dd/yyyy"})
        
    
</script>
    @stop
