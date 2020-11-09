@extends('layouts.app')

@section('header')

    {!! Html::style('website/cus/side-menu.min.css') !!}
    {!! Html::style('website/cus/ecommerce.css') !!}
    {!! Html::style('website/cus/css/select2.min.css') !!}
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxxPg8KdqwqZcSP9My8yDIg0Wxbrtvg7w&callback=initMap&libraries=&v=weekly"
        defer
    ></script>
    <style type="text/css">
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
@stop

@section('content')
    <div class='container'>
        <div class='span8 main'>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('all/building')}}">الرئيسيه </a></li>
                <li class="breadcrumb-item"><a href="{{ route('all.building')}}">كل العقارات </a></li>

            </ol>
            <h1>{{ $bu->bu_name }}</h1>
            <hr>
            <div class="btn-group" role="group" aria-label="..." style="direction:rtl">
                <a href="{{ url('all/building/search?bu_type=') . $bu->bu_type }}" class="btn btn-default" style="float: right;margin-left: 10px">نوع العقار : {{ bu_type()[$bu->bu_type] }}</a>
                <a href="{{ url('all/building/search?bu_rent=') . $bu->bu_rent }}" class="btn btn-default" style="float: right;margin-left: 10px">نوع العمليه : {{ bu_rent()[$bu->bu_rent] }}</a>
                <a href="{{ url('all/building/search?bu_rooms=') . $bu->bu_rooms }}" class="btn btn-default" style="float: right;margin-left: 10px">عدد الغرف : {{ $bu->bu_rooms }}</a>
                <a href="{{ url('all/building/search?bu_place=') . $bu->bu_place }}" class="btn btn-default" style="float: right; margin-left: 10px">المنطقه : {{ bu_place()[$bu->bu_place] }}</a>
                <a href="{{ url('all/building/search?bu_square=') . $bu->bu_square }}" class="btn btn-default" style="float: right;margin-left: 10px">المساحه : {{ $bu->bu_square }}</a>
                <a href="{{ url('all/building/search?bu_price=') . $bu->bu_price }}" class="btn btn-default" style="float: right;margin-left: 10px">السعر : {{ $bu->bu_price }} جنيه</a>

            </div>
            <hr>
            <div style="word-break: break-word;">
            {!! $bu->bu_large_dis !!}
            </div>
            <br>
            <img src="{{ checkImage($bu->image, '/buImages/') }}" alt="">
            <br>
            <br>
            <div id="map" style="width:100%;height:400px"></div>
            <br>
            @if(isset($bu_price) && count($bu_price) > 0)
                <h3> اخترنالك من حيث السعر : {{ $bu->bu_price }} </h3>
                @include('website.includes.building', ['bus'=>$bu_price])
            @endif
            @if(isset($bu_type) && count($bu_type) > 0)
                <h3> اخترنالك من حيث نوع العقار : {{ bu_type()[$bu->bu_type] }} </h3>
                @include('website.includes.building', ['bus'=>$bu_type])
            @endif
            @if(isset($bu_rent) && count($bu_rent) > 0)
                <h3> اخترنالك من حيث نوع العمليه : {{ bu_rent()[$bu->bu_rent] }} </h3>
                @include('website.includes.building', ['bus'=>$bu_rent])
            @endif
            @if(isset($bu_rooms) && count($bu_rooms) > 0)
                <h3> اخترنالك من حيث عدد الغرف : {{ $bu->bu_rooms }} </h3>
                @include('website.includes.building', ['bus'=>$bu_rooms])
            @endif
            @if(isset($bu_place) && count($bu_place) > 0)
                <h3> اخترنالك من حيث منطقه : {{ bu_place()[$bu->bu_place] }} </h3>
                @include('website.includes.building', ['bus'=>$bu_place])
            @endif
            @if(isset($bu_square) && count($bu_square) > 0)
                <h3> اخترنالك من حيث المساحه : {{ $bu->bu_square }} </h3>
                @include('website.includes.building', ['bus'=>$bu_square])
            @endif



        </div>

        <div class='span2 sidebar'>
            <h3>البحث المتقدم</h3>
            {!! Form::open(['method'=>'GET', 'action'=>'UsersViewsController@search']) !!}
            <ul class="nav nav-tabs nav-stacked">
                <li>
                    {!! Form::text('bu_price_from', null, ['class'=>'form-control', 'placeholder'=>'سعر العقار من ']) !!}
                </li>
                <li>
                    {!! Form::text('bu_price_to', null, ['class'=>'form-control', 'placeholder'=>'سعر العقار الى']) !!}
                </li>
                <li>
                    {!! Form::select('bu_rooms', rooms(), null, ['class'=>'form-control', 'placeholder'=>'عدد الغرف ']) !!}
                </li>
                <li>
                    {!! Form::select('bu_place', bu_place(), null, ['class'=>'form-control select2', 'placeholder'=>'اختر المحافظه ']) !!}
                </li>
                <li>
                    {!! Form::select('bu_type',bu_type(), null, ['class'=>'form-control', 'placeholder'=>'نوع العقار ']) !!}
                </li>
                <li>
                    {!! Form::select('bu_rent',bu_rent(), null, ['class'=>'form-control', 'placeholder'=>'نوع العمليه ']) !!}
                </li>
                <li>
                    {!! Form::text('bu_square', null, ['class'=>'form-control', 'placeholder'=>'المساحه']) !!}
                </li>
                <li>
                    {!! Form::submit('ابحث', ['class'=>'btn btn-success']) !!}
                </li>

            </ul>
            {!! Form::close() !!}

            <h3>خيارات العقارات</h3>
            <ul class="nav nav-tabs nav-stacked">
                <li><a href='{{ route('all.building') }}'>كل العقارات</a></li>
                <li><a href="{{ route('all.building.rent', 0) }}">ايجار</a></li>
                <li><a href="{{ route('all.building.rent', 1) }}">تمليك</a></li>
                <li><a href='{{ route('all.building.type', 0) }}'>الشقق</a></li>
                <li><a href='{{ route('all.building.type', 1) }}'>الفيلل</a></li>
                <li><a href='{{ route('all.building.type', 2) }}'>الشليهات</a></li>
            </ul>

        </div>
    </div>



@stop
@section('footer')
    {!! Html::script('website/cus/js/select2.min.js') !!}
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                dir: "rtl"
            });
        });
    </script>
    <script>
        (function(exports) {
            "use strict";

            function initMap() {
                exports.map = new google.maps.Map(document.getElementById("map"), {
                    center: {
                        lat: 31.038725,
                        lng: 31.375366
                    },
                    zoom: 8
                });
            }

            exports.initMap = initMap;
        })((this.window = this.window || {}));
    </script>

@stop
