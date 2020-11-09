@extends('administrator.layouts.master')
@section('header')

    <link rel="stylesheet" href="{{ asset('administrator/css/dashboard/AdminLTE.min.css') }}">

@stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <div class="huge">{{ countUser() }}</div>
                            <div>عدد اعضاء الموقع</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('users.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">عرض التفاصيل </span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <div class="huge">{{ getCountBuStatusActive() }}</div>
                            <div>عدد العقارات المفعله</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">عرض التفاصيل </span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <div class="huge">{{ getCountBuStatusNoActive() }}</div>
                            <div>عدد العقارات الغير مفعله</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">عرض التفاصيل </span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-support fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <div class="huge">{{ contactUsCount() }}</div>
                            <div>رسائل الموقع</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">عرض التفاصيل </span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <p class="text-center">
                                <strong>العقارات خلال سنه  {{ date('yy') }}</strong>
                            </p>

                            <div class="chart">
                                <!-- Sales Chart Canvas -->
                                <canvas id="salesChart" style="height: 180px;"></canvas>
                            </div>
                            <!-- /.chart-responsive -->
                        </div>
                        <!-- /.col -->
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- ./box-body -->
                <div class="box-footer">
                    <!-- /.row -->
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <!-- Left col -->
        <div class="col">
            <!-- MAP & BOX PANE -->
            <div class="box box-success">
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="row">
                        <div class="col-md-9 col-sm-8">
                            <div class="pad">
                                <!-- Map will be created here -->
                                <div id="world-map-markers" style="height: 325px;"></div>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-4">
                            <div class="pad box-pane-right bg-green" style="min-height: 280px">
                                <div class="description-block margin-bottom">
                                    <div class="sparkbar pad" data-color="#fff">عدد العقارات المفعله </div>
                                    <h5 class="description-header">{{ getCountBuStatusActive() }}</h5>
                                    <span class="description-text">عقار</span>
                                </div>
                                <!-- /.description-block -->
                                <div class="description-block margin-bottom">
                                    <div class="sparkbar pad" data-color="#fff">عدد العقارات الغير مفعله </div>
                                    <h5 class="description-header">{{ getCountBuStatusNoActive() }}</h5>
                                    <span class="description-text">عقار </span>
                                </div>
                                <!-- /.description-block -->
                                <div class="description-block">
                                    <div class="sparkbar pad" data-color="#fff">كل العقارات </div>
                                    <h5 class="description-header">{{ contactBu() }}</h5>
                                    <span class="description-text">عقار</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <div class="row">
                <div class="col-md-6">
                    <!-- USERS LIST -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">اخر 8 رسائل</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            @if(count($lastContactUs) > 0)
                            @foreach($lastContactUs->chunk(3) as $contacts)
                                <div class="users-list">
                                    @foreach($contacts as $contact)
                                        <p class="pull-right">
                                            <a href="{{ route('admin.contact.edit', $contact->id) }}">{{ $contact->contact_name }}</a>
                                        </p>
                                        <p class="pull-left">
                                            {{ $contact->created_at->diffForHumans() }}
                                        </p>
                                    @endforeach
                                </div>
                        @endforeach
                        @else
                                <h1>لا يوجد رسائل حاليا</h1>
                        @endif

                        <!-- /.users-list -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a href="{{ route('admin.contact') }}" class="uppercase">عرض كل الرسائل</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!--/.box -->
                </div>
                <!-- /.col -->

                <div class="col-md-6">
                    <!-- USERS LIST -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">اخر 8 اعضاء متسجلين</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">

                            @foreach($lastUser->chunk(3) as $users)
                                <ul class="users-list">
                                    @foreach($users as $user)
                                        <li>
                                            <img src="dist/img/user1-128x128.jpg" alt="User Image">
                                            <a class="users-list-name" href="{{ route('users.edit', $user->id) }}">{{ $user->name }}</a>
                                            <span class="users-list-date">{{ $user->created_at->diffForHumans() }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endforeach

                            <!-- /.users-list -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a href="{{ route('users.index') }}" class="uppercase">عرض كل الاعضاء</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!--/.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">اخر 8 عقارات</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>اسم العقار</th>
                                <th>الحاله</th>
                                <th>اضيف فى</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($lastBuilding) > 0)
                            @foreach($lastBuilding as $bu)
                            <tr>
                                <td><a href="pages/examples/invoice.html">{{ $bu->id }}</a></td>
                                <td>{{ $bu->bu_name }}</td>
                                <td>
                                    @if($bu->bu_status == 0)
                                    <span class="label label-danger">غير مفعل</span>
                                    @else
                                        <span class="label label-success">مفعل</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">{{ $bu->created_at->diffForHumans() }}</div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <h1>لا يوجد عقارات حاليا </h1>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="{{ route('bu.index') }}">عرض كل العقارات</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->


        <!-- /.col -->
    </div>

@stop
@section('footer')

    <script src="{{ asset('administrator/js/dashboard/fastclick.js') }}"></script>
    <script src="{{ asset('administrator/js/dashboard/adminlte.js') }}"></script>
    <script src="{{ asset('administrator/js/dashboard/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('administrator/js/dashboard/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('administrator/js/dashboard/jquery-jvectormap-world-mill-en.js  ') }}"></script>
    <script src="{{ asset('administrator/js/dashboard/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('administrator/js/dashboard/Chart.js') }}"></script>
    <script src="{{ asset('administrator/js/dashboard/dashboard2.js') }}"></script>
    <script src="{{ asset('administrator/js/dashboard/demo.js') }}"></script>
    <script>
        $('#world-map-markers').vectorMap({
            map              : 'world_mill_en',
            normalizeFunction: 'polynomial',
            hoverOpacity     : 0.7,
            hoverColor       : false,
            backgroundColor  : 'transparent',
            regionStyle      : {
                initial      : {
                    fill            : 'rgba(210, 214, 222, 1)',
                    'fill-opacity'  : 1,
                    stroke          : 'none',
                    'stroke-width'  : 0,
                    'stroke-opacity': 1
                },
                hover        : {
                    'fill-opacity': 0.7,
                    cursor        : 'pointer'
                },
                selected     : {
                    fill: 'yellow'
                },
                selectedHover: {}
            },
            markerStyle      : {
                initial: {
                    fill  : '#00a65a',
                    stroke: '#111'
                }
            },
            markers          : [
                @foreach($maps as $map)
                { latLng: [{{ $map->bu_Latitude }}, {{ $map->bu_longitude }}], name: '{{ $map->bu_name }}' },
                @endforeach
                // { latLng: [13.16, -59.55], name: 'Barbados' }

            ],


        });
        var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
        // This will get the first returned node in the jQuery collection.
        var salesChart       = new Chart(salesChartCanvas);

        var salesChartData = {
            labels  : [
                'يناير',
                'فبراير',
                'مارس',
                'ابرسل',
                'مايو',
                'يونيو',
                'يوليو',
                'اغسطس',
                'سبتمبر',
                'اكتوبر',
                'نوفمبر',
                'ديسمبر',
            ],
            datasets: [


                {
                    label               : 'Digital Goods',
                    fillColor           : 'rgba(60,141,188,0.9)',
                    strokeColor         : 'rgba(60,141,188,0.8)',
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : [
                        @foreach($new as $c)
                        @if(is_array($c))
                            {{ $c['counting'] }},
                        @else
                        {{ $c }},
                        @endif
                        @endforeach
                    ]
                }
            ]
        };


    </script>
@stop
