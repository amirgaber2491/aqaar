@extends('administrator.layouts.master')

@section('header')

    {!! Html::style('website/cus/css/select2.min.css') !!}

@stop

@section('content')
    <hr>
    <h2></h2>
    <hr>
        {!! Form::model($contact, ['method'=>'PATCH', 'action'=>['ContactUsController@update', $contact->id], 'files'=>true]) !!}
    <div class="group">
        <label for="">اسم المستخدم :</label>
        {!! Form::text('contact_name', null, ['class'=>'form-control']) !!}
    </div>
    @error('contact_name')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror
    <br>
    <div class="group">
        <label for="">البريد الالكترونى : </label>
        {!! Form::email('contact_email', null, ['class'=>'form-control']) !!}
    </div>
    @error('contact_email')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror
    <br>

    <div class="group">
        <label for="">الرساله : </label>
        {!! Form::textarea('contact_message', null, ['class'=>'form-control']) !!}
    </div>
    @error('contact_message')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror
    <br>
    <div class="group">
        <label for="">الحاله : </label>
        {!! Form::select('contact_type',typeContactUs(),  null, ['class'=>'form-control']) !!}
    </div>
    @error('contact_type')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror
    <br>
    <div class="form-group">
        {!! Form::submit('حفظ التعديلات' , ['class'=>'btn btn-success']) !!}
    </div>


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
