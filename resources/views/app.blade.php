<!doctype html>
<html lang="es">
    <head>
        <script>var base = "{{url('')}}";</script>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>COVID 19</title>

        <link rel="stylesheet" href="{{url('css/app.css')}}">
        <link rel="stylesheet" href="{{url('css/dashboard.css')}}?v=<?=date('YmdHis').rand(1,1253);?>">
        <!--
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        -->
        <script src="{{url('/js/jquery/jquery.min.js')}}"></script>
        <script src="{{url('/js/jquery/jquery.validate.min.js')}}"></script>
        <script src="{{url('/js/jquery/messages_es.js')}}"></script>

        <script src="{{url('js/bootstrap/bootstrap.min.js')}}"></script>
        <script src="{{url('js/bootstrap/bootstrap.bundle.min.js')}}"></script>
        <script src="{{url('js/functions.js')}}"></script>
    </head>
    <body id="page-top">
        <div id="app"></div>
        <script src="{{asset('js/app.js')}}?v=<?=date('iHsdmY') ?>"></script>
    </body>
</html>
