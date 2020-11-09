@auth
    <h3>خيارات العضو</h3>
    <ul class="nav nav-tabs nav-stacked">
        <li class="{{ classActive(route('user.profile'))}}"><a href='{{ route('user.profile') }}'>تعديل المعلومات الشخصيه</a></li>
        <li class="{{ classActive(route('user.all.building'))}}"><a href="{{ route('user.all.building') }}">عقاراتى</a></li>
        <li class="{{ classActive(route('user.building.active'))}}"><a href="{{ route('user.building.active') }}">العقارات المفعله</a></li>
        <li class="{{ classActive(route('user.building.waiting'))}}"><a href="{{ route('user.building.waiting') }}">العقارات فى انتظارالتفعيل</a></li>
        <li class="{{ classActive(route('user.add.building'))}}"><a href="{{ route('user.add.building') }}">اضف عقار</a></li>
    </ul>
    <br>
@endauth
