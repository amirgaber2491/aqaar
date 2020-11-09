<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->

    <link href="{{ asset('administrator/css/rtl/bootstrap.min.css') }}" rel="stylesheet">

    <!-- not use this in ltr -->
    <link href="{{ asset('administrator/css/rtl/bootstrap.rtl.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('administrator/css/plugins/metisMenu/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="{{ asset('administrator/css/plugins/timeline.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('administrator/css/rtl/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ asset('administrator/css/plugins/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('administrator/css/font-awesome/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
{{--    <link href="{{ asset('administrator/cus/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">--}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <![endif]-->
    @yield('header')

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">لوحه التحكم</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="badge badge-danger ml-2">{{ viewContactUs() }}</span>
                    <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>

                </a>
                <ul class="dropdown-menu dropdown-tasks">
                    @forelse(msgContactUs() as $contact)
                    <li>
                        <a href="{{ route('admin.contact.edit', $contact->id) }}">
                            <div>
                                <p>
                                    <span class="pull-right">{{ $contact->contact_name }}</span>
                                    <span class="pull-left">{{ $contact->created_at->diffForHumans() }}</span>
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="clearfix"></li>
                    <li class="divider"></li>

                    @empty
                        <li>
                            <div>
                                <p>
                                    <span class="">لديك {{ viewContactUs() }} غير مقرؤه</span>
                                </p>
                            </div>
                        </li>
                    @endforelse
                        <li>
                            <a class="text-center" href="{{ route('admin.contact') }}">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                </ul>
                <!-- /.dropdown-tasks -->
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="badge badge-danger ml-2">{{ getCountBuStatusNoActive() }}</span>
                    <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>

                </a>
                <ul class="dropdown-menu dropdown-tasks">
                    @forelse(getBuStatusNoActive() as $bu)
                        <li>
                            <a href="{{ route('bu.edit', $bu->id) }}">

                                <span class="pull-right">{{ $bu->bu_name }}</span>
                                <span class="pull-left">
                                    {!! Form::open(['method'=>'PATCH', 'action'=>['BuController@buStatusActive', $bu->id]]) !!}
                                    {!! Form::submit('تفعيل', ['class'=>'btn btn-primary']) !!}
                                    {!! Form::close() !!}
                                </span>
                            </a>
                        </li>
                        <li class="clearfix"></li>
                        <li class="divider"></li>

                    @empty
                        <li>
                            <div>
                                <p>
                                    <span class="">لديك {{ getCountBuStatusNoActive() }} طلب غير مفعل </span>
                                </p>
                            </div>
                        </li>
                    @endforelse
                    <li>
                        <a class="text-center" href="{{ route('bu.index') }}">
                            <strong>See All Tasks</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-tasks -->
            </li>
            <!-- /.dropdown -->

            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="{{ route('users.edit', Auth::id()) }}"><i class="fa fa-user fa-fw"></i>الصفحه الشخصيه</a>
                    </li>
                    <li><a href="{{ route('site.setting') }}"><i class="fa fa-gear fa-fw"></i>الاعدادات</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-fw"></i>
                                تسجيل الخروج
                        </a>
                        {!! Form::open(['method'=>'PATCH', 'action'=>'AdminController@logout','id'=>'logout-form', 'style'=>'display: none']) !!}
                        {!! Form::close() !!}
{{--                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">--}}
{{--                            @csrf--}}
{{--                            @method('PATCH')--}}
{{--                        </form>--}}
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a class="active" href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> لوحه التحكم</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fas fa-users"></i> التحكم فى الاعضاء<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ route('users.create') }}">اضف عضو</a>
                            </li>
                            <li>
                                <a href="{{ route('users.index') }}">كل الاعضاء</a>
                            </li>
                        </ul>

                    </li>
                    <li>
                        <a href="#"><i class="fa far fa-building"></i> التحكم فى العقارات<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ route('bu.create') }}">اضف عقار</a>
                            </li>
                            <li>
                                <a href="{{ route('bu.index') }}">كل العقارات</a>
                            </li>
                        </ul>

                    </li>
                    <li>
                        <a href="{{ route('admin.contact') }}"><i class="fa fa-envelope fa-fw"></i>رسائل الموقع</a>
                    </li>
                    <li>
                        <a href="{{ route('site.setting') }}"><i class="fa fa-gear fa-fw"></i>اعدادات الموقع</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">

            @yield('content')
        </div>

    <!-- /#page-wrapper -->

<!-- /#wrapper -->

<!-- jQuery Version 1.11.0 -->
<script src="{{ asset('administrator/js/jquery-1.11.0.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('administrator/js/bootstrap.min.js') }}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{ asset('administrator/js/metisMenu/metisMenu.min.js') }}"></script>

<!-- Morris Charts JavaScript -->
<script src="{{ asset('administrator/js/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('administrator/js/morris/morris.min.js') }}"></script>

<!-- Custom Theme JavaScript -->
<script src="{{ asset('administrator/js/sb-admin-2.js') }}"></script>
@include('sweetalert::alert')

@yield('footer')
</body>

</html>
