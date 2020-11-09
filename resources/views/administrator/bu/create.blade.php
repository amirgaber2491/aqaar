@extends('administrator.layouts.master')

@section('header')

    {!! Html::style('website/cus/css/select2.min.css') !!}

@stop


@section('content')
    <hr>
    <h1>اضافه عقار جديد </h1>
    <hr>
        {!! Form::open(['method'=>'POST', 'action'=>'BuController@store', 'files'=>true]) !!}
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
            {!! Form::select('bu_rooms', rooms() , null, ['class'=>'form-control', 'placeholder'=>'ادخل عدد الغرف']) !!}
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
        <div class="group">
            <label for="">حاله العقار : </label>
            {!! Form::select('bu_status', [''=>'اختار حاله العقار'] + bu_status(), null, ['class'=>'form-control']) !!}
        </div>
        @error('bu_status')
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
            {!! Form::textarea('bu_small_dis', null, ['class'=>'form-control', 'placeholder'=>'ادخل الكلمات الدلاليه', 'rows'=>5]) !!}
        </div>
        @error('bu_small_dis')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <br>
        <div class="group">
            <label for="">وصف العقار لمحركات البحث : </label>
            {!! Form::textarea('bu_meta', null, ['class'=>'form-control', 'placeholder'=>'ادخل وصف العقار لمحركات البحث ', 'rows'=>5]) !!}
        </div>
        @error('bu_meta')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <div class="alert alert-warning">لا يجب ان يكون عدد حروف الوصف اكثر من 160 حرف </div>
        <br>
        <div class="group">
            <label for="">خط الطول : </label>
            {!! Form::text('bu_longitude', null, ['class'=>'form-control', 'placeholder'=>'ادخل خط الطول  ']) !!}
        </div>
        @error('bu_longitude')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <br>
        <div class="group">
            <label for="">خط العرض : </label>
            {!! Form::text('bu_Latitude', null, ['class'=>'form-control', 'placeholder'=>'ادخل خط العرض  ']) !!}
        </div>
        @error('bu_Latitude')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
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
