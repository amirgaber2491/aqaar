<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('all/building')}}">الرئيسيه </a></li>
    @if(Request::has('bu_price_from') && !empty(Request::input('bu_price_from')))
        <li class="breadcrumb-item"><a href="{{ url('all/building/search?bu_price_from=' . Request::input('bu_price_from'))}}">سعر العقار من => {{ Request::input('bu_price_from') }} </a></li>
    @endif
    @if(Request::has('bu_price_to') && !empty(Request::input('bu_price_to')))
        <li class="breadcrumb-item"><a href="{{ url('all/building/search?bu_price_to' . Request::input('bu_price_to'))}}">سعر العقار الى => {{ Request::input('bu_price_to') }} </a></li>
    @endif
    @if(Request::has('bu_rooms') && !empty(Request::input('bu_rooms')))
        <li class="breadcrumb-item"><a href="{{ url('all/building/search?bu_rooms=') . Request::input('bu_rooms')}}">عدد الغرف => {{ Request::input('bu_rooms') }} </a></li>
    @endif
    @if(Request::has('bu_type') && Request::input('bu_type') != '')
        <li class="breadcrumb-item"><a href="{{ url('all/building/search?bu_type=' . Request::input('bu_type'))}}"> نوع العقار => {{ bu_type()[Request::input('bu_type')] }} </a></li>
    @endif
    @if(Request::has('bu_rent') && Request::input('bu_rent') != '')
        <li class="breadcrumb-item"><a href="{{ url('all/building/search?bu_rent=') . Request::input('bu_rent')}}"> نوع العمليه => {{ bu_rent()[Request::input('bu_rent')] }} </a></li>
    @endif
    @if(Request::has('bu_square') && Request::input('bu_square') != '')
        <li class="breadcrumb-item"><a href="{{ url('all/building/search?bu_square=') . Request::input('bu_square')}}">المساحه => {{ Request::input('bu_square') }} </a></li>
    @endif
    @if(Request::has('bu_place') && Request::input('bu_place') != '')
        <li class="breadcrumb-item"><a href="{{ url('all/building/search?bu_place=') . Request::input('bu_place')}}"> منطقه العقار => {{ bu_place()[Request::input('bu_place')] }} </a></li>
    @endif
    @if(Request::has('bu_price') && Request::input('bu_price') != '')
        <li class="breadcrumb-item"><a href="{{ url('all/building/search?bu_price=') . Request::input('bu_price')}}"> سعر العقار => {{ Request::input('bu_price') }} </a></li>
    @endif
    @if(url()->current() == route('user.add.building'))
        <li class="breadcrumb-item"><a href="{{ route('user.add.building') }}"> اضافه عقار جديد {{ Request::input('bu_price') }} </a></li>
    @endif
    @if(url()->current() == route('user.all.building'))
        <li class="breadcrumb-item"><a href="{{url('all/building')}}">كل العقارات  </a></li>
        <li class="breadcrumb-item"><a href="{{route('user.all.building')}}">عقارات اليوزر {{ Auth::user()->email }}</a></li>
    @endif
    @if(url()->current() == route('all.building'))
        <li class="breadcrumb-item"><a href="{{url('all/building')}}">كل العقارات  </a></li>

    @endif
    @if(url()->current() == route('user.profile'))
        <li class="breadcrumb-item"><a href="{{route('user.profile')}}">تعديل المعلومات الشخصيه للعضو {{ Auth::user()->email }}</a></li>
    @endif
    @if(isset($bu))
        @if(url()->current() == route('user.building.edit', $bu->id))
            <li class="breadcrumb-item"><a href="{{route('user.building.edit', $bu->id)}}">تعديل العقار : {{ $bu->bu_name }}</a></li>
        @endif
    @endif
    @if(url()->current() == route('user.building.waiting'))
        <li class="breadcrumb-item"><a href="{{route('user.building.waiting')}}">عقارات فى انتظار التفعيل</a></li>
    @endif
    @if(url()->current() == route('user.building.active'))
        <li class="breadcrumb-item"><a href="{{route('user.building.active')}}">عقارات مفعله </a></li>
    @endif
    @if(url()->current() == route('all.building.rent', 0))
        <li class="breadcrumb-item"><a href="{{route('all.building.rent', 0)}}">عقارات ايجار </a></li>
    @endif
    @if(url()->current() == route('all.building.rent', 1))
        <li class="breadcrumb-item"><a href="{{route('all.building.rent', 1)}}">عقارات تمليك</a></li>
    @endif
    @if(url()->current() == route('all.building.type', 0))
        <li class="breadcrumb-item"><a href="{{route('all.building.type', 0)}}">شقق </a></li>
    @endif
    @if(url()->current() == route('all.building.type', 1))
        <li class="breadcrumb-item"><a href="{{route('all.building.type', 1)}}">فيلل </a></li>
    @endif
    @if(url()->current() == route('all.building.type', 2))
        <li class="breadcrumb-item"><a href="{{route('all.building.type', 2)}}">شاليهات </a></li>
    @endif
</ol>
