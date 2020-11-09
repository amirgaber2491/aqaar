<?php

namespace App\Http\Controllers;

use App\Models\Bu;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UsersViewsController extends Controller
{
    public function allBuilding()
    {
        $bus = Bu::where('bu_status', 1)->latest()->paginate(12);
        return view('website.building_all', compact('bus'));
    }
    public function allBuildingRent($v)
    {
        if (Arr::has(bu_rent(), $v)):
        $bus = Bu::where('bu_status', 1)->where('bu_rent', $v)->latest()->paginate(12);
        return view('website.building_all', compact('bus'));
        else:
            return redirect()->back();
        endif;
    }
    public function allBuildingType($v)
    {
        if (Arr::has(bu_type(), $v)):
            $bus = Bu::where('bu_status', 1)->where('bu_type', $v)->latest()->paginate(12);
            return view('website.building_all', compact('bus'));
        else:
            return redirect()->back();
        endif;
    }
    public function search(Request $request)
    {
            if($request->bu_rent != '' && !Arr::has(bu_rent(), $request->bu_rent)){
                return redirect()->back();
            }else if ($request->bu_type != '' && !Arr::has(bu_type(), $request->bu_type)){
                return redirect()->back();
            }else if ($request->bu_place != '' && !Arr::has(bu_place(), $request->bu_place)){
                return redirect()->back();
            }else{
                if ($request->has('bu_price')):
                    $collection = collect($request->except(['_token', 'page']));
                    $fils = $collection->whereNotNull()->toArray();
                    $bus = Bu::where('bu_status', 1)->where($fils)->latest()->paginate(9);
                else:
                    !$request->has('bu_price_from') || $request->bu_price_from == '' ? $min = Bu::min('bu_price') :$min = $request->input('bu_price_from');
                    !$request->has('bu_price_to') || $request->bu_price_to == '' ? $max = Bu::max('bu_price') :$max = $request->input('bu_price_to');
                    $collection = collect($request->except(['_token', 'page', 'bu_price_from', 'bu_price_to']));
                    $fils = $collection->whereNotNull()->toArray();
                    $bus = Bu::where('bu_status', 1)->where($fils)->wherebetween('bu_price', [$min, $max])->latest()->paginate(9);
                endif;
                return view('website.building_all', compact('bus'));
            }



    }
    public function singleBuilding($id)
    {
        $bu = Bu::findOrFail($id);
        $bu_type = Bu::where('bu_status', 1)->where('bu_type', $bu->bu_type)->where('id', '<>', $bu->id)->orderByRaw("RAND()")->take(3)->get();
        $bu_rent = Bu::where('bu_status', 1)->where('bu_rent', $bu->bu_rent)->where('id', '<>', $bu->id)->orderByRaw("RAND()")->take(3)->get();
        $bu_rooms = Bu::where('bu_status', 1)->where('bu_rooms', $bu->bu_rooms)->where('id', '<>', $bu->id)->orderByRaw("RAND()")->take(3)->get();
        $bu_place = Bu::where('bu_status', 1)->where('bu_place', $bu->bu_place)->where('id', '<>', $bu->id)->orderByRaw("RAND()")->take(3)->get();
        $bu_square = Bu::where('bu_status', 1)->where('bu_square', $bu->bu_square)->where('id', '<>', $bu->id)->orderByRaw("RAND()")->take(3)->get();
        $bu_price = Bu::where('bu_status', 1)->where('bu_price', $bu->bu_price)->where('id', '<>', $bu->id)->orderByRaw("RAND()")->take(3)->get();
        return view('website.singleBuilding', compact('bu','bu_price', 'bu_type', 'bu_rent', 'bu_rooms', 'bu_place', 'bu_square'));
    }
    public function welcome()
    {
        $bus = Bu::where('bu_status', 1)->latest('id')->take(12)->get();
//        Alert::success('مرحبا بك ايها الزائر ', 'سوف تنتهى هذه الرساله بعد 5 ثوانى ');
        return view('welcome', compact('bus'));
    }
    public function viewBuild(Request $request)
    {
        $bu = Bu::find($request->id);
        $data = [
            'id'=>$bu->id,
            'bu_price'=>$bu->bu_price,
            'bu_name'=>$bu->bu_name,
            'bu_small_dis'=>$bu->bu_small_dis,
            'bu_image'=>checkImage($bu->image, '/buImages/')
        ];
        return response()->json($data);
    }



}
