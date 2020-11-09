<?php

use App\Models\Bu;
use App\Models\ContactUs;
use App\Models\SiteSetting;
use App\User;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

function getSetting($setting = 'siteName')
{
    return SiteSetting::where('namesetting', $setting)->first()->value;
}
function bu_rent()
{
    $array = ['ايجار', 'تمليك'];
    return $array;
}
function bu_type()
{
    $array = ['شقه', 'فيلا', 'شاليه'];
    return $array;
}
function bu_status()
{
    $array = ['غير مفعل', 'مفعل'];
    return $array;
}
function rooms()
{
    $array1 = [];
    for ($i = 2; $i <= 50; $i++){
        array_push($array1, $i);

    }
    $array2 = [];
    for ($i = 2; $i <= 50; $i++){
        array_push($array2, $i);
    }
    $col = collect($array1);
    $com = $col->combine($array2);
    return$com->all();

}
function bu_place()
{
    return[
        'c-0'=>'القاهرة',
        'c-1'=>'الجيزة',
        'c-2'=>'الاسكندرية',
        'c-3'=>'الدقهلية',
        'c-4'=>'الشرقية',
        'c-5'=>'المنوفية',
        'c-6'=>'القليوبية',
        'c-7'=>'البحيرة',
        'c-8'=>'الغربية',
        'c-9'=>'بورسعيد',
        'c-10'=>'دمياط',
        'c-11'=>'الاسماعيلية',
        'c-12'=>'السويس',
        'c-13'=>'كفر الشيخ',
        'c-14'=>'الفيوم',
        'c-15'=>'بنى سويف',
        'c-16'=>'جبال السخنه',
        'c-17'=>'مطروح',
        'c-18'=>'سيوة',
        'c-19'=>'شمال سيناء',
        'c-20'=>'وسط سيناء',
        'c-21'=>'اسيوط',
        'c-22'=>'طور سيناء',
        'c-23'=>'المنيا',
        'c-24'=>'سوهاج',
        'c-25'=>'الاقصر',
        'c-26'=>'طور سيناء',
        'c-27'=>'قنا',
        'c-28'=>'البحر الاحمر',
        'c-29'=>'اسوان',
        'c-30'=>'الوحات',
        'c-31'=>'الوادى الجديد',
        'c-32'=>'توشكي',


    ];
}


function inputCheckImage($requestHasFile, $requestFileImage, $dir, $imageDir = null)
{
    if ($requestHasFile){
        $data = getimagesize($requestFileImage);
        $width  = $data[0];
        $height = $data[1];
        $imageName = time() . '.' . $requestFileImage->getClientOriginalExtension();
        if (file_exists($imageDir)){
            File::delete($imageDir);
        }
        if ($width > 350 || $height > 230 || $width < 350 || $height < 230){
            Image::make($requestFileImage)->resize(350, 230)->save('images/' . $dir . $imageName);

        }else{
             Image::make($requestFileImage)->save('images/' . $dir . $imageName, 100);
        }
        return $imageName;

    }

}
function checkImage($image, $dir)
{
    if ($image){
        return asset('images') . '/' . $dir . $image;
    }else{
        return asset('imagesDefualt/default.jpg');
    }
}
function typeContactUs()
{
    return [
        'اعجاب',
        'مشكله',
        'اقتراح',
        'استفسار'
    ];
}
function viewContactUs()
{
     $contact = ContactUs::where('view', 0)->get();
    return count($contact);
}
function msgContactUs()
{
    return $contact = ContactUs::where('view', 0)->get();
}
function classActive($route)
{
    if (url()->current() == $route){
        return 'active';
    }else{
        return '';
    }
}
function getCountBuStatusNoActive()
{
    $bu = Bu::where('bu_status', 0)->get();
    return count($bu);
}
function getCountBuStatusActive()
{
    $bu = Bu::where('bu_status', 1)->get();
    return count($bu);
}
function getBuStatusNoActive()
{
    $bu = Bu::where('bu_status', 0)->get();
    return $bu;
}
function countUser()
{
    $userCount = User::get();
    return count($userCount);
}
function contactUsCount()
{

    return count(ContactUs::get());
}
function contactBu()
{

    return count(Bu::get());
}
