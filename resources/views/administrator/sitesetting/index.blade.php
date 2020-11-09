@extends('administrator.layouts.master')


@section('content')

    <h1>تعديل اعدادات الموقع</h1>
    <hr>
    {!! Form::open(['method'=>'POST', 'action'=>'SiteSettingController@store', 'files'=>true]) !!}
        @foreach($settings as $setting)
        <div class="group">
            <label for="">{{ $setting->slug }} : </label>
            @if($setting->type == 0)
                {!! Form::text($setting->namesetting, $setting->value, ['class'=>'form-control'])!!}
            @elseif($setting->type == 1)
                {!! Form::textarea($setting->namesetting, $setting->value, ['class'=>'form-control']) !!}
            @elseif($setting->type == 2)
                <br>
                <img src="{{ asset('images/imagesSetting') . '/' . $setting->value }}" alt=""  height="100">
                <br><br>
                {!! form::file($setting->namesetting, ['class'=>'form-control']) !!}
            @endif
        </div>
        @error('value')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        @endforeach
        <br>
        <div class="form-group">
            {!! Form::submit('حفظ الاعدادات', ['class'=>'btn btn-primary']) !!}
        </div>
{!! Form::close() !!}
@stop
