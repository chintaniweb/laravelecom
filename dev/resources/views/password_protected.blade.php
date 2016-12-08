@extends('layouts.master_front')

@section('content')
    {!! Form::open(array('url' => url('/').'/check_password/'.$name,'class' => 'form-horizontal')) !!}
    {!! Form::hidden('_token', csrf_token(), array('class' => 'form-control')) !!}
    </br>
    </br>
   
    <div class="container">
        <span style="margin-left: 50px;"> <strong> <h4>  Protected Page </h4></strong> </span>
    <div class="row">
         
    <div class="form-group row form-main-box">
                                            
         {!! Form::label('Protected Page Password', 'Protected Page Password *',array('class' => 'control-label col-md-4')) !!}
        <div class="col-md-7">
            {!! Form::password('password', array('class' => 'form-control','id' => 'password')) !!}
        </div>
        
     </div>
    <div class="col-sm-12 col-md-12 col-xs-12 text-center m-t-10"> 
          {!! Form::submit('Enter &gt;',array('class' => 'btn btn-default')) !!}
    </div>
    </div>
</div>
    </br>
    </br>

 {!! Form::close() !!}

@endsection