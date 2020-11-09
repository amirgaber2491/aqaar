@extends('layouts.app')

@section('title', 'اتصل بنا')
@section('header')

    {!! Html::style('website/cus/contactUs.css') !!}
@stop
@section('content')

    <div class="jumbotron jumbotron-sm" style="background: none">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="well well-sm">
                        {!! Form::open(['method'=>'POST', 'action'=>'ContactUsController@store']) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Message</label>
                                        {!! Form::textarea('contact_message', null, ['class'=>'form-control', 'cols'=>25, 'placeholder'=>'من فضلك ادخل الرساله']) !!}
                                        @error('contact_message')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            <br>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">الاسم : </label>
                                        {!! Form::text('contact_name', null, ['class'=>'form-control', 'placeholder'=>'من فضلك ادخل الاسم ']) !!}
                                        @error('contact_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                    <label for="email">البريد الالكترونى : </label>
                                    <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                        {!! Form::email('contact_email', null, ['class'=>'form-control', 'placeholder'=>'من فضلك ادخل البريد الالكترونى ', 'id'=>'email']) !!}
                                    </div>
                                        @error('contact_email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                 </div>
                                    <div class="form-group">
                                        <label for="subject"> العنوان </label>
                                        {!! Form::select('contact_type',  typeContactUs(), null, ['class'=>'form-control', 'placeholder'=>'اختر']) !!}
                                        @error('contact_subject')
                                        <br>
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        <br>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    {!! Form::submit('ارسال الرساله', ['class'=>'btn btn-primary pull-right']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <form>
                        <h3>اتصل بنا</h3>
                        <legend><i class="fa fas fa-outdent" aria-hidden="true"></i> مكتبنا</legend>
                        <address>
                            {{ getSetting('address') }}
                            <br>
                            ت : {{ getSetting('mobile') }}
                        </address>
                        <address>
                            <strong>{{ getSetting() }}</strong><br>
                            <a href="mailto:#">{{ getSetting('email') }}</a>
                        </address>
                    </form>
                </div>
            </div>
        </div>
    </div>


@stop
