@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Телепрограмма</title>
    <link href="/bootstrap-3.0.0/dist/css/bootstrap.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=PT+Serif&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href="/css/font-awesome.css" rel="stylesheet">
    <link href="/js/swiperjs/idangerous.swiper.css" rel="stylesheet">
    <link href="/js/big-video/css/bigvideo.css" rel="stylesheet">
</head>
<body>
<div class="content-wrap" >
    <div class="main-container">
        <header>
            <nav>
                <ul>
                    <li  style="margin-left:20px;">
                        <a href="/home">Главная</a>
                    </li>
                    <li>
                        <a href="/channels/allChannels">Телеканалы</a>
                    </li>
                    <li>
                        <a href="/allTelecasts">Телепрограмма</a>
                    </li>
                    <li>
                        <a href="/statistic">Статистика</a>
                    </li>
                    <li>
                        <a href="/myChannels">Мои телеканалы</a>
                    </li>
                    @auth()
                        @if(Auth::user()->is_admin == 1)
                            <li class="current-item">
                                <a href="/admin/index">Работа с данными</a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </nav>
        </header>
        <span class="clear"></span>
        <div class="row" >
            <div class="col-md-8" style = "margin-left: 170px;">
                <ul class="news-list half-image">
                    <li>
                        <h4><a href="channels">Добавить канал</a></h4>
                        <br>
                        <h4><a href="telecasts">Добавить телеперадачу</a></h4>
                        <br>
                        <h4>Добавить показ телепередачи для телеканала: </h4>
                        <br>
                        <form action="{{ url('admin/telecastShow') }}">
                            <select name="channel" class="select-css">
                                <option value="0">Любой</option>
                                @foreach($channels as $channel)
                                    <option value="{{$channel->id}}">{{$channel->name}}</option>
                                @endforeach
                            </select>
                            <br>
                            <input type="submit" value="Добавить">
                        </form>
                        <br>
                        <br>
                        <br>
                        <h4>Добавить сотрудника для телеканала: </h4>
                        <br>
                        <form action="{{ url('admin/staff') }}">
                            <select name="channel" class="select-css">
                                <option value="0">Любой</option>
                                @foreach($channels as $channel)
                                    <option value="{{$channel->id}}">{{$channel->name}}</option>
                                @endforeach
                            </select>
                            <br>
                            <input type="submit" value="Добавить">
                        </form>
                        <br>
                        <br>
                        <br>
                        <h4>Добавить участника телепередачи для телеканала: </h4>
                        <br>
                        <form action="{{ url('admin/telecastStaff') }}">
                            <select name="channel" class="select-css">
                                <option value="0">Любой</option>
                                @foreach($channels as $channel)
                                    <option value="{{$channel->id}}">{{$channel->name}}</option>
                                @endforeach
                            </select>
                            <br>
                            <input type="submit" value="Добавить">
                        </form>
                        <br>
                        <br>
                        <br>
                        @if (session()->has('message'))
                            <div class="alert alert-info">
                                {{ session('message') }}
                            </div>
                        @endif
                    </li>
                </ul>

                <span class="clear"></span>
            </div>
        </div>
        <span class="clear"></span>
    </div>
    <footer>
        <div class="row">
            <div class="col-md-4">
                <div class="bluebox-heading">
                    <h3>Зайцева А.В. ИСм-19</h3>
                </div>
                <span class="clear"></span>
            </div>
        </div>
    </footer>
</div>
<div class="footer-logo">
</div>
<script src="/bootstrap-3.0.0/assets/js/jquery.js"></script>
<script src="/bootstrap-3.0.0/dist/js/bootstrap.min.js"></script>
<script type="/text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="/text/javascript" src="js/jquery-ui-1.10.3.min.js"></script>
<script type="/text/javascript" src="js/custom.js"></script>
<script type="/text/javascript" src="js/jplayer/jquery.jplayer.min.js"></script>
<script type="/text/javascript" src="js/swiperjs/idangerous.swiper.js"></script>
<script src="/js/modernizr-2.5.3.min.js"></script>
<script src="/js/video.js"></script>
<script src="/js/big-video/lib/bigvideo.js"></script>
<script src="/js/imagesloaded.pkgd.js"></script>
</body>
</html>
@endsection
