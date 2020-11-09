@extends('layouts.app')

@section('title', 'اهلا بك زائرنا الكريم')
@section('header')
    {!! Html::style('website/cus/css/select2.min.css') !!}
    <link rel="stylesheet" href="{{ asset('website/main/css/reset.css') }}"> <!-- CSS reset -->
    <link rel="stylesheet" href="{{ asset('website/main/css/style.css') }}"> <!-- Resource style -->
{{--    <script src="{{ asset('website/main/js/modernizr.js') }}"></script> <!-- Modernizr -->--}}
    <style>
        .banner{
            background: url({{ getSetting('image') ? asset('images/imagesSetting/') . '/' . getSetting('image') : asset('imagesDefualt/banner.jpg') }}) no-repeat center;
        }
    </style>

@stop

@section('content')

    <div class="banner text-center">
        <div class="container">
            <div class="banner-info">
                <h1>اهلا بكم فى {{ getSetting() }} </h1>
                <div class="row">
                {!! Form::open(['method'=>'GET', 'action'=>'UsersViewsController@search']) !!}
                    <div class="col-lg-3">
                        {!! Form::select('bu_place', bu_place(), null, ['class'=>'form-control select2', 'placeholder'=>'اختر المحافظه ']) !!}
                    </div>
                    <div class="col-lg-3">
                        {!! Form::select('bu_rooms', rooms(), null, ['class'=>'form-control', 'placeholder'=>'عدد الغرف ']) !!}
                    </div>
                    <div class="col-lg-3">
                        {!! Form::text('bu_price_to', null, ['class'=>'form-control', 'placeholder'=>'سعر العقار الى']) !!}
                    </div>
                    <div class="col-lg-3">
                        {!! Form::text('bu_price_from', null, ['class'=>'form-control', 'placeholder'=>'سعر العقار من ']) !!}
                    </div>
                    <br><br>
                    <div class="col-lg-3">
                        {!! Form::submit('ابحث', ['class'=>'btn', 'style'=>'width:100%']) !!}
                    </div>
                    <div class="col-lg-3">
                        {!! Form::select('bu_rent',bu_rent(), null, ['class'=>'form-control', 'placeholder'=>'نوع العمليه ']) !!}
                    </div>
                    <div class="col-lg-3">
                        {!! Form::text('bu_square', null, ['class'=>'form-control', 'placeholder'=>'المساحه']) !!}
                    </div>
                    <div class="col-lg-3">
                        {!! Form::select('bu_type',bu_type(), null, ['class'=>'form-control', 'placeholder'=>'نوع العقار ']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
                <a class="banner_btn" href="{{ route('user.add.building') }}">اضف عقارك مجانا </a>
            </div>
        </div>
    </div>
    <div class="main">
        @foreach($bus->chunk(4) as $bu)
            <ul class="cd-items cd-container">

                @foreach($bu as $b)
                    <li class="cd-item">
                        <img src="{{ checkImage($b->image , '/buImages/') }}" alt="Item Preview">
                        <a href="#0" buId = '{{ $b->id }}' class="cd-trigger">عرض العقار</a>
                    </li>
                @endforeach
            </ul>
        @endforeach
                <div class="cd-quick-view">
                    <div class="cd-slider-wrapper">
                        <ul class="cd-slider">
                            <li class="selected"><img class="bu-image" src="" alt="Product 1"></li>
                        </ul> <!-- cd-slider -->
                    </div> <!-- cd-slider-wrapper -->
                    <div class="cd-item-info">
                        <h2 class="bu-name"></h2>
                        <p class="bu-dis"></p>

                        <ul class="cd-item-action">
                            <li><a href="" class="add-to-cart bu-price"></a></li>
                            <li><a class="bu-more" href="">عرض المزيد</a></li>
                        </ul> <!-- cd-item-action -->
                    </div> <!-- cd-item-info -->
                    <a href="#0" class="cd-close">Close</a>
                </div> <!-- cd-quick-view -->

    </div>

@stop
@section('footer')
    <script src="{{ asset('website/main/js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('website/main/js/velocity.min.js') }}"></script>
    <script>
        function rootViewBuild0() {
            return '{{ route('view.build') }}'
        }
        function tokenPost() {
            return '{{ csrf_token() }}'
        }
        function urlWebsite() {
            return '{{ url()->current() }}'
        }
    </script>

    <script src="{{ asset('website/main/js/main.js') }}"></script> <!-- Resource jQuery -->
    {!! Html::script('website/cus/js/select2.min.js') !!}
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                dir: "rtl"
            });
        });
    </script>



@stop
