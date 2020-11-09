<?php

namespace App\Http\Controllers;

use App\Models\Bu;
use App\Models\ContactUs;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $maps = Bu::select('bu_longitude', 'bu_Latitude', 'bu_name')->get();
         $char = Bu::select(DB::raw('COUNT(*) as counting , month'))->groupBy('month')->orderBy('month', 'asc')->get()->toArray();
         $arr = [];
         for ($i = 1; $i < $char[0]['month']; $i++){
             $arr[] = 0;
         }
         $new = array_merge($arr, $char);
         $lastUser = User::take(8)->orderBy('id', 'desc')->get();
         $lastContactUs = ContactUs::take(8)->orderBy('id', 'desc')->get();
         $lastBuilding = Bu::take(8)->orderBy('id', 'desc')->get();
        return view('administrator.home.index', compact('maps', 'new', 'lastUser', 'lastContactUs', 'lastBuilding'));
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
