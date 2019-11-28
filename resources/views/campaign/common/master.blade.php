<!DOCTYPE html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatiable" content="IE=edge">
    {{--<meta name="viewport" content="width=device-width,initial-scale=1">--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @section('title')
            <title>UpCAT</title>
        @show

        @section('style')
            <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.min.css')}}">
        @show
    </head>

    <body>
        @section('body')
        @show

        @section('js')
            <!-- jQuery 文件 -->
            <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
            <!-- Bootstrap 文件 -->
            <script  href="{{asset('js/bootstrap/bootstrap.min.js')}}"></script>
        @show

        @section('loginForm')
        @show
    </body>
</html>