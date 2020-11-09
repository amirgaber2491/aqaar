@extends('layouts.app')

@section('header')

    {!! Html::style('website/cus/side-menu.min.css') !!}
    {!! Html::style('website/cus/ecommerce.css') !!}
    {!! Html::style('website/cus/css/select2.min.css') !!}

@stop

@section('content')
    <div class='container'>
        <div class='span8 main'>
            @include('website.includes.requestSearch')
            {!! Form::model($user, ['method'=>'PATCH', 'action'=>'AdminUsersController@profileUpdate']) !!}
            <div class="form-group">
                {!! Form::label('الاسم : ') !!}
                {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'ادخلا السم الجديد ']) !!}
            </div>
            @error('name')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <div class="form-group">
                {!! Form::label('البريد الالكترونى : ') !!}
                {!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=>'ادخل البريد الالكترونى الجديد ']) !!}
            </div>
            @error('email')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <div class="form-group">
                {!! Form::submit('تنفيذ', ['class'=>'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
            <br>
            {!! Form::open(['method'=>'PATCH', 'action'=>'AdminUsersController@profileChangePassword']) !!}
            <div class="form-group">
                {!! Form::label('كلمه المرور القديمه : ') !!}
                {!! Form::password('current_password', ['class'=>'form-control', 'placeholder'=>'ادخل كلمه المرور القديمه ']) !!}
            </div>
            @error('current_password')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <div class="form-group">
                {!! Form::label('كلمه المرور الجديده : ') !!}
                {!! Form::password('new_password', ['class'=>'form-control', 'placeholder'=>'ادخل كلمه المرور الجديده  ']) !!}
            </div>
            @error('new_password')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <div class="form-group">
                {!! Form::label('تكرار كلمه المرور الجديده : ') !!}
                {!! Form::password('new_confirm_password', ['class'=>'form-control', 'placeholder'=>'تكرار كلمه المرور الجديده  ']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('تنفيذ', ['class'=>'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>

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

@stop
