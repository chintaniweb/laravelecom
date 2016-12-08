@extends('layouts.master_front')
@section('content')
<section>
  <div class="inner-content-section">
  	<div class="container">
	  <div class="row">
        <div class="col-sm-4 col-xs-12 left-side-bar side-bar">
          <div class="side-menu">
          	<div class="side-menu-title">Quick Links</div>
                <ul>
                    <li><a href="http://www.wswheboces.org/documents.cfm?id=14.39" title="">Board Agendas/Minutes</a></li>
                    <li><a href="<?php echo url('/') . '/staff_directory' ?>" title="">Staff Directory</a></li>
                    <li><a href="<?php echo url('/') . '/page/boces-job-opportunities' ?>" title="">Employment Opps</a></li>
                    <li><a href="<?php echo url('/') . '/page/code-of-conduct' ?>" title="">Code of Conduct</a></li>
                    <li><a href="https://schooltoolweb.wswheboces.org/schooltoolweb/" title="">School Tool</a></li>
                </ul>
          </div>
        </div>
        <div class="col-sm-8 col-xs-12 content-area left-side-bar-on">
              @if(Session::has('msg'))
                   <p class="alert-success {{ Session::get('alert-class', 'alert-success') }}" style="padding:10px">{{ Session::get('msg') }}</p>
              @endif
          <div class="content-area-title">

          </div>
          <div class="content-area-desc">
            <p> We would like to hear from you. Please send your comments by filling out the form below; your comments will be sent to the appropriate person.</p>
            <div>
              {!! Form::open(array('url' => 'Form_creator_front/'.$data[0]->form_creator_id,'class' => 'form-horizontal','id'=>'myForm','files'=>'true')) !!}
              	<div class="form-group row form-main-box">
                    <div class="col-md-12">
                        <label class="control-label"><strong>Name</strong></label>
                    </div>
                    <div class="col-md-5">
                        {!! Form::text('name', null,array('class' => 'form-control','id' => 'name')) !!} 
                    </div>
                </div>
                <div class="form-group row form-main-box">
                    <div class="col-md-12">
                        <label class="control-label"><strong>Work Email</strong></label>
                    </div>
                    <div class="col-md-5">
                        {!! Form::text('work_email', null,array('class' => 'form-control','id' => 'work_email')) !!}
                    </div>
                </div>
                <div class="form-group row form-main-box">
                    <div class="col-md-12">
                        <label class="control-label"><strong>Home Email</strong></label>
                    </div>
                    <div class="col-md-5">
                        {!! Form::text('home_email', null,array('class' => 'form-control','id' => 'home_email')) !!}
                    </div>
                </div>
                <div class="form-group row form-main-box">
                    <div class="col-md-12">
                        <label class="control-label"><strong>Phone No</strong></label>
                    </div>
                    <div class="col-md-5">
                        {!! Form::text('phone_no', null,array('class' => 'form-control','id' => 'phone_no')) !!}
                    </div>
                </div>
            </div>
                <div class="form-group">
                  <div class="row">
                  	<div class="col-md-12 col-sm-12 col-xs-12">
              <?php
              if(count($data) > 0){
                         
                foreach ($data as $row) {
                    echo '<h5><strong>' . $row->question . "</strong></h5>";
                    if ($row->answer_type == 'MultipleChoice') {
                        if ($row->questionphrase == 'select1answer') {
                            $multiple = preg_split('/,|[\r\n]/', $row->multiplechoicetext);

                            foreach ($multiple as $text) {
                                echo '<div class="p-l-10">'
                                . '<label class="control-label">'
                                        . '<input type="radio" class="form-control" id="question[' . $row->form_questions_id . ']" name="question[' . $row->form_questions_id . '][]" value="' . $text . '" >' . $text . '<input type="text" class="form-control" id="question[' . $row->form_questions_id . ']" name="question[' . $row->form_questions_id . '][]">'
                                        . '</label>'
                                        . '</div>';
                            }
                        } elseif ($row->questionphrase == 'selectmultiple') {
                            $multiple = preg_split('/,|[\r\n]/', $row->multiplechoicetext);
                            foreach ($multiple as $text) {
                                echo '<div class="p-l-10"><label class="control-label"><input type="checkbox" id="question[' . $row->form_questions_id . ']" name="question[' . $row->form_questions_id . '][]" value="' . $text . '">' . $text . '</label></div>';
                            }
                        } elseif ($row->questionphrase == 'select1') {
                            $multiple = preg_split('/,|[\r\n]/', $row->multiplechoicetext);
                            foreach ($multiple as $text) {
                                echo '<div class="p-l-10"><label class="control-label"><input type="radio" id="question[' . $row->form_questions_id . ']" name="question[' . $row->form_questions_id . ']" value="' . $text . '" >' . $text . '</label></div>';
                            }
                        } elseif ($row->questionphrase == 'select1list') {
                            $multiple = preg_split('/,|[\r\n]/',  $row->multiplechoicetext);
                            echo '<select id="question' . $row->form_questions_id . '" name="question[' . $row->form_questions_id . ']">';
                            echo '<option>select</option>';
                            foreach ($multiple as $text) {
                                echo '<option value="' . $text . '">' . $text . '</option>';
                            }
                            echo '</select></br><br>';
                        } elseif ($row->questionphrase == 'selectmultipleanswer') {
                            $multiple = preg_split('/,|[\r\n]/',  $row->multiplechoicetext);
                            foreach ($multiple as $text) {
                                echo '<div class="p-l-10"><label class="control-label"><input type="checkbox" id="question[' . $row->form_questions_id . ']" name="question[' . $row->form_questions_id . '][]" value="' . $text . '">' . $text . '<input type="text" id="question[' . $row->form_questions_id. ']" name="question[' . $row->form_questions_id . '][]"></br></label></div><br>';
                            }
                        }
                    } elseif ($row->answer_type == 'ShortAnswer') {

                        $short_answer = '<div class="p-l-10"><label class="control-label"><input type="text" class="form-control" id="question[' . $row->form_questions_id . ']" name="question[' . $row->form_questions_id . ']"></label></div>';
                        echo $short_answer ;
                    } elseif ($row->answer_type == 'MediumAnswer') {

                        $medium_answer = '<div class="p-l-10"><label class="control-label"><input type="text" class="form-control"  id="question[' . $row->form_questions_id . ']" name="question[' . $row->form_questions_id . ']" size="50">';
                        echo $medium_answer . "</label></div>";
                    } elseif ($row->answer_type == 'InfoOnly') {

                        $info_only = '<div class="p-l-10"><label class="control-label">' . $row->question . '</label>';
                        echo $info_only . "</label></div></br><br>";
                    } elseif ($row->answer_type == 'LongAnswer') {
                        
                        $long_answer = '<div class="p-l-10"><label class="control-label"><textarea id="question[' . $row->form_questions_id . ']" name="question[' . $row->form_questions_id . ']" cols="55" rows="10"></textarea>';
                        echo $long_answer . '</label></div><br>';
                    } elseif ($row->answer_type == 'DateFormat') {

                        $date_format = '<div class="p-l-10"><label class="control-label"><input type="text" class="form-control" id="question[' . $row->form_questions_id . ']" name="question[' . $row->form_questions_id. ']" size="10">';
                        echo $date_format . '(mm/dd/yyyy)' . "</label></div></br><br>";
                    } elseif ($row->answer_type == 'EmailFormat') {
                        
                        $email_format = '<div class="p-l-10"><label class="control-label"><input type="email" class="form-control" id="question[' . $row->form_questions_id . ']" name="question[' . $row->form_questions_id . ']">';
                        echo $email_format . '</label></div><br>';
                    } elseif ($row->answer_type == 'FileUpload') {
                        
                        $file_upload = '<div class="p-l-10"><label class="control-label"><input type="file"  class="form-control" id="question[' . $row->form_questions_id . ']" name="question[' . $row->form_questions_id . ']">';
                        echo $file_upload . '</label></div><br>';
                    } elseif ($row->answer_type == 'TrueFalse') {
                        
                        echo '<div class="p-l-10"><label class="control-label"><input type="radio" id="question[' . $row->form_questions_id . ']" name="question[' . $row->form_questions_id . ']" value="True" >True</label></div>';
                        echo '<div class="p-l-10"><label class="control-label"><input type="radio" id="question[' . $row->form_questions_id . ']" name="question[' . $row->form_questions_id . ']" value="False" >False</label></div>';
                    }
                }
              }?> 
                    </div>
                    
                  </div>
                </div>  
                
                <div class="form-group last">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                       {!! Form::submit('Save form',array('class' => 'btn btn-primary btn-rect btn-sm')) !!}
                    </div>
                  </div>
                </div>
              {!! Form::close() !!}
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
            $("#myForm").submit();
        });
    });
</script>
@endsection