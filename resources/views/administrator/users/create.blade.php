@extends('administrator.layouts.master')



@section('content')
    <hr>
    <h1>اضافه عضو جديد </h1>
    <hr>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="group">
            <label for="">اسم المستخدم :</label>
            <input type="text" class="form-control" name="name" placeholder="ادخل اسم المستخدم">
        </div>
        @error('name')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
        <br>
        <div class="group">
            <label for="">البريد الالكترونى : </label>
            <input type="email" name="email" class="form-control" placeholder="ادخل البريد الالكترونى ">
        </div>
        @error('email')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <br>
        <div class="group">
            <label for="">الصلحيات : </label>
            {!! Form::select('role', [''=>'اختار الصلحيه', '0'=>'عضو', '1'=>'مشرف'], null, ['class'=>'form-control']) !!}
        </div>
        <br>
        <div class="group">
            <label for="">كلمه المرور :</label>
            <input type="password" name="password" class="form-control" placeholder="ادخل كلمه المرور">
        </div>
        @error('password')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <br>
        <div class="group">
            <label for="">تكرار كلمه المرور : </label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="تكرار كلمه المرور">
        </div>
        <br>
        <div class="group">
            <input type="submit" value="اضافه عضو جديد" class="btn btn-warning">
        </div>


    </form>



@stop
