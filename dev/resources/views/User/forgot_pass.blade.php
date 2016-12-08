<html ng-app="app">
    <head>
        <meta charset="UTF-8">
        <title>wswheboces admin</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
        <link rel="apple-touch-icon" href="{{ url('resources/assets/ico/152.png')}}">
        <meta name="apple-mobile-web-app-title" content="Sumo">
        <meta name="mobile-web-app-capable" content="yes">
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <meta name="keywords" content="Sumo">
        <meta name="description" content="Sumo">
        <meta name="author" content="Sumo">
        <meta name="copyright" content="Sumo">
        <meta name="csrf-token" content="{{ csrf_token()}}">

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
                <div class="panel-heading text-center"> <img src="{{ url('resources/assets/img/logo-login.png')}}" alt="" title=""> </div>


                <div class="panel-body">
                    {!! Form::open(['url' => 'change_password/'.$encrypted_email , 'class' => 'form-horizontal']) !!}

                    <div class="card-box m-b-0">
                        <div class="row">
                            <div class="text-dark"><b>Change your password</b></div>
                            <div class=" col-sm-12 col-xs-12 p-t-b-10">
                                <div class="col-xs-12  m-t-20">
                                    {!! Form::password('password',['class' => 'form-control','placeholder' => 'New Password']) !!}
                                    <span id="confirmMessage">{{ $errors - > first('password')}}</span>
                                </div>
                                <div class="col-xs-12  m-t-20">
                                    {!! Form::password('cnfrm_password',['class' => 'form-control','placeholder' => 'Confirm Password']) !!}

                                </div>
                                <div class="col-sm-12 col-md-12 col-xs-12 pro-action-select text-center m-t-10"> 
                                    {!! Form::submit('Confirm Password',['class' => 'btn btn-primary btn-block text-uppercase waves-effect waves-light']) !!} 
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            </form>    
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
                <script>
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                </script>


