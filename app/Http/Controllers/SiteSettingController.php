<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all();
        return view('administrator.sitesetting.index', compact('settings'));
    }
    public function store(Request $request, SiteSetting $siteSetting)
    {
        $input = $request->except('_token');
        if ($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images/imagesSetting', $imageName);
            $input['image'] = $imageName;
        }
        foreach ($input as $key => $req):
            $siteSettingUpdate = $siteSetting->where('namesetting', $key)->get();
            if ($request->hasFile('image')  && $input['image'] != ''){
                 $fileName = SiteSetting::select('value')->where('type', 2)->first()->value;
                if (file_exists(base_path() . '/public/images/imagesSetting/' . $fileName)):
                    File::delete(base_path() . '/public/images/imagesSetting/' . $fileName);
                endif;
            }
            $siteSettingUpdate->first()->fill(['value'=>$req])->save();
        endforeach;
        Alert::success('تم تعديل بيانات الموقع بنجاح ', 'سوف تنتهى هذه الرساله بعد 5 ثوانى ');
        return back();
    }
}
