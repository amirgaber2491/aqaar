<h3>البحث المتقدم</h3>
{!! Form::open(['method'=>'GET', 'action'=>'UsersViewsController@search']) !!}
<ul class="nav nav-tabs nav-stacked">
    <li>
        {!! Form::text('bu_price_from', null, ['class'=>'form-control', 'placeholder'=>'سعر العقار من ']) !!}
    </li>
    <li>
        {!! Form::text('bu_price_to', null, ['class'=>'form-control', 'placeholder'=>'سعر العقار الى']) !!}
    </li>
    <li>
        {!! Form::select('bu_rooms', rooms(), null, ['class'=>'form-control', 'placeholder'=>'عدد الغرف ']) !!}
    </li>
    <li>
        {!! Form::select('bu_place', bu_place(), null, ['class'=>'form-control select2', 'placeholder'=>'اختر المحافظه ']) !!}
    </li>
    <li>
        {!! Form::select('bu_type',bu_type(), null, ['class'=>'form-control', 'placeholder'=>'نوع العقار ']) !!}
    </li>
    <li>
        {!! Form::select('bu_rent',bu_rent(), null, ['class'=>'form-control', 'placeholder'=>'نوع العمليه ']) !!}
    </li>
    <li>
        {!! Form::text('bu_square', null, ['class'=>'form-control', 'placeholder'=>'المساحه']) !!}
    </li>
    <li>
        {!! Form::submit('ابحث', ['class'=>'btn btn-success']) !!}
    </li>

</ul>
{!! Form::close() !!}
