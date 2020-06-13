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
                    <li class="current-item" style="margin-left:20px;">
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
                            <li>
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
                    <div class="bb-slider-2 bluebox-slider" data-direction-nav=".arrow-links-wrap" data-control-nav=".slider-control-nav">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="/images/1.png" class=" img-preload" alt="sample image" data-aspectratio="1.3333" id="img-52552406dfa3e">
                                </div>
                                <div class="swiper-slide">
                                    <img src="/images/2.png" class=" img-preload" alt="2-20100201195917" style="display: none;" data-aspectratio="1.3719" id="img-52552406e0e11">
                                </div>
                                <div class="swiper-slide">
                                    <img src="/images/1.png" class=" img-preload" alt="sample image" style="display: none;" data-aspectratio="1.3333" id="img-52552406e2e77">
                                </div>
                            </div>
                        </div>
                        <div class="bullets-wrap">
                            <ul class="slider-control-nav">
                                <li class="current"><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                            </ul>
                        </div>
                        <div class="arrow-links-wrap">
                            <a href="#" class="arrow-left-link prev">
                                <span></span>
                                <span></span>
                            </a>
                            <a href="#" class="arrow-right-link next">
                                <span></span>
                                <span></span>
                            </a>
                        </div>
                    </div>
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
<script src="bootstrap-3.0.0/assets/js/jquery.js"></script>
<script src="bootstrap-3.0.0/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="js/swiperjs/idangerous.swiper.js"></script>
<script src="js/modernizr-2.5.3.min.js"></script>
<script src="js/video.js"></script>
<script src="js/big-video/lib/bigvideo.js"></script>
<script src="js/imagesloaded.pkgd.js"></script>
</body>
</html>
@endsection
