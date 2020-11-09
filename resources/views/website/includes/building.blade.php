@if(isset($bus) && count($bus) > 0)
    @foreach($bus->chunk(3) as $bu)
        <div class="row">
            @foreach($bu as $b)
                <div class="col-md-4 column productbox">
                    <img src="{{ checkImage($b->image, 'buImages/') }}">
                    <div class="producttitle" style="word-break: break-word;">{{ Str::limit($b->bu_small_dis , 80) }} </div>
                    <div>
                        <div class="pull-right" style="font-weight: bold">المساحه :  {{ $b->bu_square }} </div>
                        <div class="pull-left" style="font-weight: bold">نوع العمليه : {{ bu_rent()[$b->bu_rent] }}</div>
                        <div class="clearfix"></div>
                        <div class="pull-right" style="font-weight: bold">عدد الغرف :  {{ $b->bu_rooms }} </div>
                        <div class="pull-left" style="font-weight: bold">نوع العقار : {{ bu_type()[$b->bu_type] }}</div>
                        <div class="clearfix"></div>
                        <div style="font-weight: bold">المحافظه : {{ bu_place()[$b->bu_place] }}</div>
                    </div>
                    <div class="productprice">
                        <div class="pull-left">

                            <a href="{{ route('single.building', $b->id) }}" class="btn btn-danger btn-sm" role="button"> اعرض التفاصيل <li class="fa fa-minus-circle" style="color: white"></li></a>
                        </div><div class="pricetext">{{ $b->bu_price }} جنيه</div></div>
                </div>
            @endforeach
        </div>
    @endforeach
    <div class="clearfix"></div>
@else
    <div class="alert alert-danger">لا يوجد عقارات حاليا</div>
@endif
