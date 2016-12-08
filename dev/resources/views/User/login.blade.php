<html>
    <head>
        <meta charset="UTF-8">
        <title>wswheboces admin</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
        <link rel="apple-touch-icon" href="assets/ico/152.png">
        <meta name="apple-mobile-web-app-title" content="Sumo">
        <meta name="mobile-web-app-capable" content="yes">
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="copyright" content="">
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


    </head>
    <body class="login">
        <div class="wrapper-page">
            <div class=" card-box">
                @if(Session::has('msg'))
                <p class="alert alert-success">{{ Session::get('msg') }}</p>
                @endif
                <div class="panel-heading text-center"> <img src="resources/assets/images/logo-login.png" alt="" title=""> </div>
                <div class="panel-body">
                    {!! Form::open(array('url' => 'login','class'=>'form-horizontal m-t-20','id'=>'myForm')) !!}
                    <div class="form-group">
                        <div class="col-xs-12 m-b-10">
                            {!! Form::text('email', null, ['class' => 'form-control','placeholder' => 'Enter Email Id']) !!}
                            @if ($errors->has('email')) 
                            <p class="text-danger col-md-8 m-0 p-0">{{ $errors->first('email') }}</p> 
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 m-b-10">
                            {!! Form::password('password', ['class' => 'form-control','placeholder' => 'Password']) !!}
                            @if ($errors->has('password')) 
                            <p class="text-danger col-md-8 m-0 p-0">{{ $errors->first('password') }}</p> 
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 m-b-10">
                            {!! Form::select('website_id',$website,null,array('class' => 'form-control')) !!}
                            @if ($errors->has('website_id')) 
                            <p class="text-danger col-md-8 m-0 p-0">{{ $errors->first('website_id') }}</p> 
                            @endif
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            {!! Form::submit('Log In',['class'=>'btn btn-primary btn-block text-uppercase waves-effect waves-light']) !!}
                        </div>
                    </div>
                    <div class="form-group m-t-20 m-b-0">
                        <div class="col-sm-12"> <a href="{{ url('forgot_password') }}" class="text-dark"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a> </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center login-bottom-links">
                    <p>&copy; 2016 wswheboces.org</p>
                </div>
            </div>
        </div>
        {!! Html::script('resources/assets/js/jquery-1.11.1.min.js') !!}
        {!! Html::script('resources/assets/js/jquery-ui.js') !!}
        {!! Html::script('resources/assets/js/bootstrap.min.js') !!}
    </body>
</html>

<script src="<?php echo url('/'); ?>/resources/assets/js/jquery.validate.min.js" type="text/javascript"></script>
  <script>
$(document).ready(function () {
    $("#myForm").validate({
        rules: {
            email: {required: true},
            password: {required: true}
        },
        messages: {
            email: "The Email field is required",
            password: "The Password field is required",
        },
        errorElement: 'div'

    });
});
  </script>