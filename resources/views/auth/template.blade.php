<?php $app = DB::table('setting')->first(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ (!empty($app->title)?$app->title:null) }} :: {{ Lang::label('Login') }}</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset(!empty($app->favicon)?$app->favicon:'public/assets/images/icons/favicon.ico') }}" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="{{ asset('public/assets/css/waves.min.css') }}" rel="stylesheet">
    <!-- Animation Css -->
    <link href="{{ asset('public/assets/css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom Css -->
    <link href="{{ asset('public/assets/css/admin.bsb.min.css') }}" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>{{ (!empty($app->title)?$app->title:null) }}</b></a>
            <small>{{ (!empty($app->description)?$app->description:null) }}</small>
        </div>
        <div class="card">
            <div class="body"> 
                @include('alert::alert')
                @yield('content')
            </div> 
        </div>
    </div>

    <div class="container text-white">
    </div>

    <!-- Jquery Core Js -->
    <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
    <!-- Bootstrap Core Js -->
    <script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('public/assets/js/waves.min.js') }}"></script>
    <!-- Validation Plugin Js -->
    <script src="{{ asset('public/assets/js/jquery.validate.min.js') }}"></script>

    <!-- Custom Js -->
    <script type="text/javascript">
        $(function () {
            $('#login').validate({
                rules: {
                    'terms': {
                        required: true
                    },
                    'confirm': {
                        equalTo: '[name="password"]'
                    }
                },
                highlight: function (input) {
                    console.log(input);
                    $(input).parents('.form-line').addClass('error');
                },
                unhighlight: function (input) {
                    $(input).parents('.form-line').removeClass('error');
                },
                errorPlacement: function (error, element) {
                    $(element).parents('.input-group').append(error);
                    $(element).parents('.form-group').append(error);
                }
            });


            $('table tbody tr').on('click', function() {
                $("input[name=email]").val($(this).children().first().text());
                $("input[name=password]").val($(this).children().first().next().text());
            }); 

        });
    </script>
    @yield('alert')
</body>
</html>

 
