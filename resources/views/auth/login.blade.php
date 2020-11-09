@extends('layouts.app')

@section('title', 'صفحه تسجيل الدخول')
@section('content')
<div class="container">
    <div class="contact_bottom">
        <hr>
        <h3>تسجيل الدخول</h3>
        <hr>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="contact-to">

                    <input id="" style="width: 100%" type="email" class="form-control " name="email" value="" required autocomplete="email" autofocus placeholder="ادخل الايميل">
                <br>
                <input id="" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="ادخل الباسورد">
                <br>
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="">تذكرنى</label>
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-warning">
                    تسجيل
                </button>
                @if (Route::has('password.request'))
                    <a class="btn btn-primary" href="{{ route('password.request') }}">
                        هل نسيت كلمه المرور؟
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
