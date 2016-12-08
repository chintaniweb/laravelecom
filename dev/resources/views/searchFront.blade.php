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
                            <li><a href="<?php echo url('/').'/staff_directory'?>" title="">Staff Directory</a></li>
                            <li><a href="<?php echo url('/').'/page/boces-job-opportunities'?>" title="">Employment Opps</a></li>
                            <li><a href="<?php echo url('/').'/page/code-of-conduct'?>" title="">Code of Conduct</a></li>
                            <li><a href="https://schooltoolweb.wswheboces.org/schooltoolweb/" title="">School Tool</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-8 col-xs-12 content-area left-side-bar-on">
                    <div class="content-area-desc">
                        <div style="margin-top: 10px;">Please use the search page to search by keyword for information on our site.</div><br>
                        <div><strong>You are currently searching for:<div class="search">{{$keyword}}</div></strong></div>

                        <!---------------------------------------------------SEARCH START--------------------------------------------->

                        <!----------SEARCH SITECONTENT START----------------->
                        <?php
                        if (count($sitecontent_result) != 0) {
                            echo "<br>";
                            $i = 1;
                            echo "<strong>" . 'Sitecontent' . '</strong><br><br>';
                            foreach ($sitecontent_result as $row) {
                                echo $i . ". ";
                                ?>
                                <?php if (isset($row->sitecontent_id)) { ?>
                                    <?php
                                    $link = $row->access_url;
                                    if (stristr($link, 'http')) {
                                        $link = $row->access_url;
                                    } else {
                                        $link = url('/') . '/page/' . $row->access_url;
                                    }
                                    ?>
                                    <a href="<?php echo $link; ?>"><?php echo $row->page_title; ?></a>
                                    <?php
                                }
                                echo "<br>";
                                $i++;
                            }
                        }
                        ?>
                        <!----------SEARCH SITECONTENT END-------------------> 
                        <!----------SEARCH SCHOOL NEWS START-----------------> 
                        <?php
                        if (count($news_result) != 0) {
                            echo "<br>";
                            $i = 1;
                            echo "<strong>" . 'News Articles' . '</strong><br><br>';
                            foreach ($news_result as $row) {
                                echo $i . ". ";
                                ?>
                                <?php
                                if (isset($row->school_news_id)) {
                                    $news_link = url('/') . "School_news/School_news/index/" . $row->school_news_id;
                                    ?>
                                    <a href="<?php echo $news_link; ?>"><?php echo $row->headline; ?></a>
                                    <?php
                                }
                                echo "<br>";
                                $i++;
                            }
                        }
                        ?>
                        <!----------SEARCH SCHOOL NEWS END----------------->
                        <!------------SEARCH CALENDAR EVENT START----------> 
                        <?php
                        if (count($calendar_result) != 0) {
                            echo "<br>";
                            $i = 1;
                            echo "<strong>" . 'Calendar Events' . '</strong><br><br>';
                            foreach ($calendar_result as $row) {
                                echo $i . ". ";
                                ?>
                                <?php if (isset($row->calendar_event_id)) {
                                    $event_link = url('/') . "Sitecontent/get_calendar_event_data/" . $row->calendar_event_id;
                                    ?>
                                    <a href="<?php echo $event_link; ?>"><?php echo $row->headline; ?></a>
                                    <?php
                                }
                                echo "<br>";
                                $i++;
                            }
                        }
                        ?>
                        <!------------SEARCH CALENDAR EVENT END------------>

                        <!-------------------------------------------------SEARCH END---------------------------------------------->
                        <div><br>
                            {!! Form::model($data, array('url' => array('searchs/edit', $data->site_search_id), 'method' => 'get','class' => 'form-horizontal','id'=>'myForm')) !!}
                            <div><b>What are you searching for?</b></div>
                            <div class="form-group m-b-10">
                                <div class="row">
                                    <div class="col-md-5 col-sm-7 col-xs-12 mob-inline-1" style="margin-left:15px;">
                                        {!! Form::text('search_for', $data->search_for, array('class' => 'form-control','id' => 'search_for')) !!}
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12 mob-inline-2">
                                        {!! Form::submit('Search',array('class' => 'btn btn-primary btn-rect btn-sm','name'=>'search')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="head">SEARCH IN:</div>
                            <div  class="checkbox-inline">
                            <?php $selected = (isset($data[0]->module) && ($data[0]->module != "")) ? $data[0]->module : ""; ?>
                                <input type="checkbox" checked="checked" name="module[]" <?php echo ($selected !== "") ? "checked" : ""; ?>  value="Sitecontent">Site Content<br>
                                <input type="checkbox" name="module[]" <?php echo ($selected !== "") ? "checked" : ""; ?>  value="School_news">News<br>
                                <input type="checkbox" name="module[]" <?php echo ($selected !== "") ? "checked" : ""; ?>  value="Calendar_event">Calendar Of Events<br>
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
    $('.modal').on('hidden.bs.modal', function (e)
    {
        $(this).removeData();
    });
</script>
@endsection
