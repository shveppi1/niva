<!DOCTYPE html>
<html lang="ru">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Церковь христиан в Липецке, Христианская церковь Липецк, Евангельская церковь Липецк, Христиане Липецк">
    <meta name="description" content="Христианская церковь веры евангельской Липецк">

    <link rel="apple-touch-icon" sizes="57x57" href="/images/fav/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/fav/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/fav/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/fav/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/fav/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/fav/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/fav/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/fav/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/fav/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/images/fav/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/fav/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/fav/favicon-16x16.png">
    <link rel="manifest" href="/images/fav/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/images/fav/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">


    <title>БожьяНива.рф Церковь христиан «Божья Нива»</title>

    @if (env('APP_ENV') === 'production')
        <link rel="stylesheet" href="{{env('STATIC_FILES', '')}}{{ mix('/css/styles.min.css', 'dist') }}">
    @else
        <link rel="stylesheet" href="{{env('STATIC_FILES', '')}}{{ mix('/css/styles.css', 'src') }}">
    @endif
    @yield('css')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,300' rel='stylesheet' type='text/css'>

</head>

<body id="top" data-spy="scroll" @if( !isset($_REQUEST['res']) ) class="matrix" @endif data-offset="50" data-target=".navbar-collapse">


<div class="preloader">
    <div class="sk-spinner sk-spinner-pulse"></div>
</div>

@include('block.header');


@yield('content')
{{--
<?
if(isset($_REQUEST['res'])){
    switch ($_REQUEST['res']) {
        case 'confed':
            require_once('confed.php');
            break;
        case 'peredacha-dannih':
            require_once('dannie.php');
            break;
        case 'requizit':
            require_once('requizit.php');
            break;

        /*default:
            require_once('main.php');
            break;*/
    }
} else {
    require_once('main.php');
}

?>

--}}



<footer>
    <div class="container">

        <div class="row">

            <div class="col-md-12 col-sm-12">

                <ul class="social-icon">
                    <li><a href="//vk.com/nivachurch" class="fa fab fa-vk wow fadeInUp" data-wow-delay="0.8s"></a></li>
                </ul>

                <p class="wow fadeInUp animated" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;"><a href="/upload/Politika_v_otnoshenii_obrabotki_peronalnykh_dannykh.pdf" >Политика в отношении обработки персональных данных</a></p>

            </div>

        </div>

    </div>
</footer>





<a href="#" class="go-top"><i class="fa fa-angle-up"></i></a>

<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/vegas.min.js"></script>
<script src="/assets/js/modernizr.custom.js"></script>
<script src="/assets/js/toucheffects.js"></script>
<script src="/assets/js/owl.carousel.min.js"></script>
<script src="/assets/js/smoothscroll.js"></script>
<script src="/assets/js/wow.min.js"></script>
<script src="/assets/js/custom.js?v=2"></script>

@yield('scripts')
@if (env('APP_ENV') === 'production')
    <script src="{{env('STATIC_FILES', '')}}{{ mix('/js/all.min.js', 'dist') }}"></script>
@else
    <script src="{{env('STATIC_FILES', '')}}{{ mix('/js/all.js', 'src') }}"></script>
@endif


<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter54589693 = new Ya.Metrika({
                    id:54589693,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>

<script type="text/javascript">
    $('#myTabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
</script>

<noscript><div><img src="https://mc.yandex.ru/watch/54589693" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</body>
</html>
