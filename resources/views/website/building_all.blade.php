@extends('layouts.app')
@section('title', 'كل العقارات')
@section('header')

{!! Html::style('website/cus/side-menu.min.css') !!}
{!! Html::style('website/cus/ecommerce.css') !!}
{!! Html::style('website/cus/css/select2.min.css') !!}

@stop

@section('content')
    <div class='container'>
            <div class='span8 main'>
                @include('website.includes.requestSearch')
                @include('website.includes.building', compact('bus'))
                <div class="text-center">{!! $bus->appends(Request::except('page'))->render() !!}</div>

            </div>
        <div class='span2 sidebar'>
            @include('website.includes.userInfo')
            <h3>خيارات العقارات</h3>
            <ul class="nav nav-tabs nav-stacked">
                <li class="{{ classActive(route('all.building'))}}"><a href='{{ route('all.building') }}'>كل العقارات</a></li>
                <li class="{{ classActive(route('all.building.rent', 0))}}"><a href="{{ route('all.building.rent', 0) }}">ايجار</a></li>
                <li class="{{ classActive(route('all.building.rent', 1))}}"><a href="{{ route('all.building.rent', 1) }}">تمليك</a></li>
                <li class="{{ classActive(route('all.building.type', 0))}}" ><a href='{{ route('all.building.type', 0) }}'>الشقق</a></li>
                <li class="{{ classActive(route('all.building.type', 1))}}"><a href='{{ route('all.building.type', 1) }}'>الفيلل</a></li>
                <li class="{{ classActive(route('all.building.type', 2))}}"><a href='{{ route('all.building.type', 2) }}'>الشليهات</a></li>
            </ul>
            @include('website.includes.formSearch')
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

@stop
