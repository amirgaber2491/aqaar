@extends('layouts.app')

@section('title', 'صفحه تسجيل عضويه جديده')
@section('content')
    <div class="container">
        <div class="contact_bottom">
            <hr>
            <h3>تسجيل عضوية جديده</h3>
            <hr>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="contact-to">
                    <input id="name" style="width: 100%;" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="اسم المستخدم">
                    <br>
                    @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="البريد الالكترونى">
                    <br>
                    @error('email')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="كلمة المرور">
                    <br>
                    @error('password')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="تكرار كلمه المرور">

                </div>
                <br>
                <div>
                    <button type="submit" class="btn btn-warning">تسجيل عضوية جديدة</button>
                </div>
            </form>
        </div>
    </div>

@endsection
