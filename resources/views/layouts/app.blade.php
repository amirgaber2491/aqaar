<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {!! Html::style('website/css/bootstrap.min.css') !!}
    {!! Html::style('website/css/flexslider.css') !!}
    {!! Html::style('website/css/style.css') !!}
    {!! Html::style('website/css/font-awesome.min.css') !!}
    {!! Html::script('website/js/jquery.min.js') !!}
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900' rel='stylesheet' type='text/css'>
    <title>
        {{ getSetting() }}
        |
        @yield('title')
    </title>
    @yield('header')

</head>
<body style="direction: rtl">
    <div class="header">
        <div class="container"> <a class="navbar-brand" href="{{ url('/') }}"><i class="fa fa-paper-plane"></i> ONE</a>
            <div class="menu pull-left"> <a class="toggleMenu" href="#"><img src="{{ asset('website/images/nav_icon.png') }}" alt="" /> </a>
                <ul class="nav" id="nav">
                    <li class="{{ classActive(url('/')) }}"><a href="{{ url('/') }}">الرئيسية</a></li>
                    <li class="{{ classActive(route('all.building')) }}"><a href="{{ route('all.building') }}">كل العقارات</a></li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            ايجار<span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('all/building/search?bu_rent=0&bu_type=0') }}">
                                شقه
                            </a>
                            <a class="dropdown-item" href="{{ url('all/building/search?bu_rent=0&bu_type=1') }}">
                                فيلا
                            </a>
                            <a class="dropdown-item" href="{{ url('all/building/search?bu_rent=0&bu_type=2') }}">
                                شاليه
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            تمليك<span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('all/building/search?bu_rent=1&bu_type=0') }}">
                                شقه
                            </a>
                            <a class="dropdown-item" href="{{ url('all/building/search?bu_rent=1&bu_type=1') }}">
                                فيلا
                            </a>
                            <a class="dropdown-item" href="{{ url('all/building/search?bu_rent=1&bu_type=2') }}">
                                شاليه
                            </a>
                        </div>
                    </li>
                    <li class="{{ classActive(route('contact.us')) }}"><a href="{{ route('contact.us') }}">اتصل بنا</a></li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">تسجيل الدخول</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}"> عضويه جديده</a>
                            </li>
                        @endif
                    @else
                        @if(Auth::user()->role == 1)
                            <li class="{{ classActive(route('admin.dashboard')) }}"><a href="{{ route('admin.dashboard') }}">صفحه التحكم</a></li>
                        @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    تسجيل الخروج
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    <div class="clear"></div>
                </ul>
            </div>
        </div>

        @yield('content')
        <div class="footer">
            <div class="footer_bottom">
                <div class="follow-us"> <a class="fa fa-facebook social-icon" href="{{ getSetting('facebook') }}"></a> <a class="fa fa-twitter social-icon" href="{{ getSetting('twitter') }}"></a>  <a class="fa fa-youtube social-icon" href="{{ getSetting('youtube') }}"></a> </div>
                <div class="copy">
                    <p>Copyright &copy; 2015 Company Name. Design by <a href="http://www.templategarden.com" rel="nofollow">TemplateGarden</a></p>
                </div>
            </div>
        </div>

    </div>
    {!! Html::script('website/js/bootstrap.min.js') !!}
    {!! Html::script('website/js/jquery.flexslider.js') !!}
    {!! Html::script('website/js/responsive-nav.js') !!}
    @include('sweetalert::alert')
    @yield('footer')
</body>
</html>
