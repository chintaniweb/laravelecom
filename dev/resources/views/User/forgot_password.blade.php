<html ng-app="app">
    <head>
        <meta charset="UTF-8">
        <title>wswheboces admin</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
        <link rel="apple-touch-icon" href="{{ url('resources/assets/images/152.png')}}">
        <meta name="apple-mobile-web-app-title" content="Sumo">
        <meta name="mobile-web-app-capable" content="yes">
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <meta name="keywords" content="Sumo">
        <meta name="description" content="Sumo">
        <meta name="author" content="Sumo">
        <meta name="copyright" content="Sumo">
        {!! Html::style('resources/assets/css/bootstrap.min.css') !!}
        {!! Html::style('resources/assets/css/core.css') !!}
        {!! Html::style('resources/assets/css/components.css') !!}
        {!! Html::style('resources/assets/css/icons.css') !!}
        {!! Html::style('resources/assets/css/style.css') !!}
        {!! Html::style('resources/assets/css/responsive.css') !!}
    </head>
    <body class="login">
        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class=" card-box">
                @if(Session::has('msg'))
                <p class="alert alert-success">{{ Session::get('msg') }}</p>
                @endif
                <div class="panel-heading text-center"> <img src="resources/assets/img/logo-login.png" alt="" title=""> </div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'check_forgot_password','class' => 'form-horizontal m-t-20']) !!}
                    <div class="form-group m-t-10 m-b-0">
                        <div class="col-sm-12">
                            <p class="text-dark"><b>Forgot your password?</b></p>
                            <p>Enter your email address below and we will send you instructions on how to change your password.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12  m-t-20">
                            {!! Form::text('email',null,['class'=>'form-control','placeholder' => 'Email Address']) !!}
                            @if ($errors->has('email')) 
                            <p class="text-danger col-sm-7">{{ $errors -> first('email')}}</p> 
                            @endif
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20 m-b-0">
                        <div class="col-xs-12">
                            {!! Form::submit('Reset',['class' => 'btn btn-primary btn-block text-uppercase waves-effect waves-light']) !!}
                        </div>
                    </div>
                    <div class="form-group m-t-20 m-b-0">
                        <div class="col-sm-12"> 
                            <a href="{{ url('admin')}}" class="text-dark">« Back to Login</a> 
                        </div>
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
        {!! Html::script('resources/assets/js/bootstrap.min.js') !!}
    </body>
</html> 

