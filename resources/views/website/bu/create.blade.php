@extends('layouts.app')

@section('header')

    {!! Html::style('website/cus/side-menu.min.css') !!}
    {!! Html::style('website/cus/ecommerce.css') !!}
    {!! Html::style('website/cus/css/select2.min.css') !!}

@stop
<?php
$lat = !empty(old('lat')) ? old('lat') : '30.06277690073326';
$lang = !empty(old('lang')) ? old('lang') : '31.269337654113762';
?>

@section('content')
    <div class='container'>
        <div class='span8 main'>
            @include('website.includes.requestSearch')
            <hr>
            <h1>اضافه عقار جديد </h1>
            <hr>
            {!! Form::open(['method'=>'POST', 'action'=>'BuController@userBuildingStore', 'files'=>true]) !!}
            <div class="group">
                <label for="">اسم العقار :</label>
                {!! Form::text('bu_name', null, ['class'=>'form-control', 'placeholder'=>'ادخل اسم العقار']) !!}
            </div>
            @error('bu_name')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <br>
            <div class="group">
                <label for="">عدد الغرف : </label>
                {!! Form::select('bu_rooms', rooms(), null, ['class'=>'form-control', 'placeholder'=>'ادخل عدد الغرف']) !!}
            </div>
            @error('bu_rooms')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <br>
            <div class="group">
                <label for="">سعر العقار : </label>
                {!! Form::text('bu_price', null, ['class'=>'form-control', 'placeholder'=>'ادخل سعر العقار ']) !!}
            </div>
            @error('bu_price')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <br>
            <div class="group">
                <label for="">منطقه العقار : </label>
                {!! Form::select('bu_place', bu_place(), null, ['class'=>'form-control select2', 'placeholder'=>'اختر المنطقه']) !!}
            </div>
            @error('bu_place')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <br>
            <div class="group">
                <label for="">نوع العمليه : </label>
                {!! Form::select('bu_rent', [''=>'اختار نوع العمليه'] + bu_rent(), null, ['class'=>'form-control']) !!}
            </div>
            @error('bu_rent')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <br>
            <div class="group">
                <label for="">مساحه العقار : </label>
                {!! Form::text('bu_square', null, ['class'=>'form-control', 'placeholder'=>'ادخل مساحه العقار ']) !!}
            </div>
            @error('bu_square')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <br>
            <div class="group">
                <label for="">نوع العقار : </label>
                {!! Form::select('bu_type', [''=>'اختار نوع العقار'] + bu_type(), null, ['class'=>'form-control']) !!}
            </div>
            @error('bu_type')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <br>
            <div class="form-group">
                <label for="">اختر الصوره : </label>
                {!! Form::file('image', ['class'=>'form-control']) !!}
            </div>
            <div class="group">
                <label for="">الكلمات الدلاليه : </label>
                {!! Form::textarea('bu_small_dis', null, ['class'=>'form-control', 'placeholder'=>'ادخل الكلمات الدلاليه', 'rows'=>5, 'maxlength'=>200]) !!}
                <div class="input-length"><span class="count">0</span> / 200</div>
            </div>
            @error('bu_small_dis')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <br>
            <div class="group">
                <label for="">وصف العقار لمحركات البحث : </label>
                {!! Form::textarea('bu_meta', null, ['class'=>'form-control', 'placeholder'=>'ادخل وصف العقار لمحركات البحث ', 'rows'=>5, 'maxlength'=>160]) !!}
                <div class="input-length"><span class="count">0</span> / 160</div>
            </div>
            @error('bu_meta')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <div class="alert alert-warning">لا يجب ان يكون عدد حروف الوصف اكثر من 160 حرف </div>
            <br>
            <div class="form-group">
                <div id="us1" style="width: 100%; height: 400px;"></div>
                {!! Form::hidden('bu_Latitude', null, ['id'=>'lat']) !!}
                {!! Form::hidden('bu_longitude', null, ['id'=>'lang']) !!}
            </div>
            <br>
            <div class="group">
                <label for="">وصف مطول للعقار : </label>
                {!! Form::textarea('bu_large_dis', null, ['class'=>'form-control', 'placeholder'=>'ادخل الوصف ', 'rows'=>10]) !!}
            </div>
            @error('bu_large_dis')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <br>

            <div class="group">
                <input type="submit" value="اضافه عقار جديد" class="btn btn-warning">
            </div>
            <br>
            {!! Form::close() !!}
        </div>
        <div class='span2 sidebar'>

            @include('website.includes.userInfo')
            <h3>خيارات العقارات</h3>
            <ul class="nav nav-tabs nav-stacked">
                <li><a href='{{ route('all.building') }}'>كل العقارات</a></li>
                <li><a href="{{ route('all.building.rent', 0) }}">ايجار</a></li>
                <li><a href="{{ route('all.building.rent', 1) }}">تمليك</a></li>
                <li><a href='{{ route('all.building.type', 0) }}'>الشقق</a></li>
                <li><a href='{{ route('all.building.type', 1) }}'>الفيلل</a></li>
                <li><a href='{{ route('all.building.type', 2) }}'>الشليهات</a></li>
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
    <script>
        let lenthPreview = function(el) {
            el.siblings('.input-length').find('.count').html(el.val().length)
            console.log('sss')
        }

        $('textarea[maxlength]').bind('input propertychange', function() {
            lenthPreview($(this))
        });
        $('textarea[maxlength]').each( function() {
            lenthPreview($(this))
        });
    </script>
    <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyA9_ve_oT3ynCaAF8Ji4oBuDjOhWEHE92U'></script>
    <script src="{{ asset('js/locationpicker.jquery.js') }}"></script>
    <script type="text/javascript">
        $('#us1').locationpicker({
            location: {
                latitude: {{ $lat }},
                longitude: {{ $lang }}
            },
            radius: 300,
            markerIcon: '{{ asset('administrator/images/map-marker-2-xl.png') }}',
            inputBinding: {
                latitudeInput: $('#lat'),
                longitudeInput: $('#lang'),
                // radiusInput: $('#us2-radius'),
                // locationNameInput: $('.address')
            }
        });
    </script>

@stop
