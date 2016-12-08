@extends('layouts.master_front')
@section('content')
<style>
    .search {color:red};
</style>
<section>
    <div class="inner-content-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-xs-12 left-side-bar side-bar">
                    <div class="side-menu">
                        <div class="side-menu-title">Quick Links</div>
                        <ul>
                            <li><a href="http://www.wswheboces.org/documents.cfm?id=14.39" title="">Board Agendas/Minutes</a></li>
                            <li><a href="<?php echo url('/') . 'Staff_members/Staff_directory' ?>" title="">Staff Directory</a></li>
                            <li><a href="<?php echo url('/') . 'boces-job-opportunities' ?>" title="">Employment Opps</a></li>
                            <li><a href="<?php echo url('/') . 'code-of-conduct' ?>" title="">Code of Conduct</a></li>
                            <li><a href="https://schooltoolweb.wswheboces.org/schooltoolweb/" title="">School Tool</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-8 col-xs-12 content-area left-side-bar-on">
                    <div class="content-area-desc">
                        
                        <div><br>
                             {!! Form::open(array('url' => 'Search_statistics_front','class' => 'form-horizontal','id'=>'myForm')) !!}
                            
                                <div><b>What are you searching for?</b></div>
                                <div class="form-group m-b-10">
                                    <div class="row">
                                        <div class="col-md-5 col-sm-7 col-xs-12 mob-inline-1" style="margin-left:15px;">
                                        
                                             {!! Form::text('search_for', null, array('class' => 'form-control','id' => 'search_for')) !!}
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12 mob-inline-2">
                                            {!! Form::submit('Save',array('class' => 'btn btn-primary btn-rect btn-sm','name'=>'search')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="head">SEARCH IN:</div>
                                <div  class="checkbox-inline">
                                    <input type="checkbox" checked="checked" name="module[]"   value="Sitecontent">Site Content<br>
                                    <input type="checkbox" name="module[]"  value="School_news">News<br>
                                    <input type="checkbox" name="module[]"  value="Calendar_event">Calendar Of Events<br>
                                </div>
                             {!! Form::close() !!}
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(function () {
        $('#btn').click(function (e) {
            e.preventDefault();
            //alert('hello');
            $("#myForm").submit();
        });
    });
</script>
<script>
   $('.modal').on('hidden.bs.modal', function(e)
    { 
        $(this).removeData();
    }) ;
</script>
@endsection
