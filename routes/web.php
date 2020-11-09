<?php

use App\Models\Bu;
use App\Models\ContactUs;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'UsersViewsController@welcome');
Route::get('test', function (){
    if (inputCheckImage($imageName = base_path() . '/public/images/buImages/' . Auth::user()->bus()->find(24)->image)){
        return 'yes';
    }else{
        return 'No';
    }

});
//Auth::routes(['verify' => true]);


Auth::routes();
// Start Routs Admin
//Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>['web', 'isAdmin'], 'prefix'=>'adminpanel'], function (){
    Route::get('contactUs/data', 'ContactUsController@anyData')->name('admin.contact.data');
    Route::get('users/data', 'AdminUsersController@anyData')->name('adminpanel.users.data');
    Route::get('users/bu/data/{id}', 'BuController@usersBu')->name('adminpanel.users.bu.data');
    Route::get('bu/data', 'BuController@anyData')->name('adminpanel.bu.data');
    Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::patch('logout', 'AdminController@logout')->name('admin.logout');
    Route::resource('users','AdminUsersController');
    Route::resource('bu','BuController');
    Route::patch('user/change/password/{id}', 'AdminUsersController@changePassword');
    Route::get('setting', 'SiteSettingController@index')->name('site.setting');
    Route::post('setting', 'SiteSettingController@store')->name('site.setting.store');
    Route::get('contact-us', 'ContactUsController@index')->name('admin.contact');
    Route::delete('contact-us/delete/{id}', 'ContactUsController@delete')->name('admin.contact.delete');
    Route::get('contact-us/edit/{id}', 'ContactUsController@edit')->name('admin.contact.edit');
    Route::patch('contact-us/update/{id}', 'ContactUsController@update')->name('admin.contact.update');
    Route::patch('bu/active/{id}', 'BuController@buStatusActive')->name('user.bu.active');
    Route::patch('bu/remove/active/{id}', 'BuController@buStatusRemoveActive')->name('user.bu.remove.active');
    Route::get('pagination/fetch_data/{id}', 'BuController@fetch_data_no_active');
});
//End Routs Admin


//Start Routs Users
Route::get('all/building', 'UsersViewsController@allBuilding')->name('all.building');
Route::get('all/building/rent/{rent}', 'UsersViewsController@allBuildingRent')->name('all.building.rent');
Route::get('all/building/type/{type}', 'UsersViewsController@allBuildingType')->name('all.building.type');
Route::get('all/building/search', 'UsersViewsController@search')->name('all.building.search');
Route::get('single/building/{id}', 'UsersViewsController@singleBuilding')->name('single.building');
Route::post('view/build','UsersViewsController@viewBuild')->name('view.build');
Route::get('contact/us','ContactUsController@contactUs')->name('contact.us');
Route::post('contact/us','ContactUsController@store')->name('contact.us.store');
Route::group(['middleware'=>'auth'], function (){
    Route::get('user/add/building','BuController@userbuildcreate')->name('user.add.building');
    Route::post('user/add/building','BuController@userBuildingStore')->name('user.add.building.post');
    Route::get('user/all/building','BuController@userBuildingAll')->name('user.all.building');
    Route::get('user/building/active','BuController@userBuildingActive')->name('user.building.active');
    Route::get('user/building/waiting','BuController@userBuildingWaiting')->name('user.building.waiting');
    Route::get('user/building/edit/{id}','BuController@userBuildingEdit')->name('user.building.edit');
    Route::patch('user/building/update/{id}','BuController@userBuildingUpdate')->name('user.building.update');
    Route::get('user/profile/edit','AdminUsersController@profile')->name('user.profile');
    Route::patch('user/profile/update','AdminUsersController@profileUpdate')->name('user.profile.post');
    Route::patch('user/profile/changePassword','AdminUsersController@profileChangePassword')->name('user.profile.post');
});
