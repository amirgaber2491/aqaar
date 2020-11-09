<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuRequest;
use App\Models\Bu;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class BuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrator.bu.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('administrator.bu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BuRequest $request)
    {
        if ($request->input('bu_status') == ''){
            $request['bu_status'] = 0;
        }

        if ($request->has('image')){
            $input = $request->except('_token', '_method');
            $input['image'] = inputCheckImage($request->hasFile('image'), $request->file('image'), '/buImages/' );
            $input['month'] = date('m');
        }else{
            $input = $request->except('_token', '_method');
            $input['month'] = date('m');
        }
        Auth::user()->bus()->create($input);
        Alert::success('تم اضافه العقار بنجاح ', 'سوف تنتهى هذه الرساله بعد 5 ثوانى ');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('administrator.bu.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bu = Bu::findOrFail($id);
        return view('administrator.bu.edit', compact('bu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BuRequest $request, $id)
    {
        $imageDir = base_path() . '/public/images/buImages/' . Auth::user()->bus()->find($id)->image;
        if ($request->has('image')){
            $input = $request->except('_token', '_method');
            $input['image'] = inputCheckImage($request->hasFile('image'), $request->file('image'), '/buImages/' , $imageDir);
            $input['month'] = date('m');
        }else{
            $input = $request->except('_token', '_method');
            $input['month'] = date('m');
        }
        if (Auth::user()->role == 1){
            Bu::find($id)->update($input);
        }else{
        Auth::user()->bus()->find($id)->update($input);
        }
        Alert::success('تم التعديل على العقار بنجاح', 'سوف تنتهى هذه الرساله بعد 5 ثوانى ');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::user()->bus()->find($id)->delete();
        Alert::success('تم حذف العقار بنجاح ', 'سوف تنتهى هذه الرساله بعد 5 ثوانى ');
        return redirect()->back();
    }
    public function anyData(Bu $bu)
    {

        $bus = $bu->all();
        return DataTables::of($bus)
            ->editColumn('bu_name', function ($model) {
                return '<a href="'. route('bu.edit', $model->id) .'">'.$model->bu_name.'</a>';
            })
            ->editColumn('bu_type', function ($model) {

                return '<span class="badge badge-info">' .bu_type()[$model->bu_type] . '</span>' ;
            })
            ->editColumn('created_at', function ($model) {
                return $model->created_at->diffForHumans();
            })

            ->editColumn('bu_status', function ($model) {
                return $model->bu_status == 1 ? '<span class="badge badge-info">' . ' مفعل' . '</span>' : '<span class="badge badge-warning">' . 'غير مفعل' . '</span>';

            })
            ->editColumn('control', function ($model) {
                $all = '<a href="' . route('bu.edit', $model->id) . '" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></a> ';

                    $all .= "
                        <form action=" . route('bu.destroy' , $model->id) ." method=\"POST\">
                            <input type=\"hidden\" name=\"_token\" value=" . csrf_token() .">
                            <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
                            <button type=\"submit\" class=\"btn btn-danger btn-circle\"><i class=\"fa fa-trash-o\"></i></button>
                        </form>
                    ";

                return $all;
            })
            ->rawColumns(['bu_name', 'bu_type', 'created_at', 'bu_status', 'control'])
            ->make(true);



    }
    public function userbuildcreate()
    {
        return view('website.bu.create');
    }
    public function userBuildingAll()
    {
        $bus = Auth::user()->bus()->paginate(3);
        return view('website.bu.index', compact('bus'));
    }
    public function userBuildingStore(BuRequest $request)
    {
        if ($request->input('bu_status') == ''){
            $request['bu_status'] = 0;
        }

        if ($request->has('image')){
            $input = $request->except('_token', '_method', 'address');
            $input['image'] = inputCheckImage($request->hasFile('image'), $request->file('image'), '/buImages/' );
            $input['month'] = date('m');
        }else{
            $input = $request->except('_token', '_method', 'address');
            $input['month'] = date('m');
        }
        Auth::user()->bus()->create($input);
        Alert::success('تم اضافه العقار بنجاح ', 'سوف تنتهى هذه الرساله بعد 5 ثوانى ');
        return redirect()->back();
    }
    public function userBuildingActive()
    {
        $bus = Auth::user()->bus()->where('bu_status', 1)->paginate(3);
        return view('website.bu.index', compact('bus'));
    }
    public function userBuildingWaiting()
    {
        $bus = Auth::user()->bus()->where('bu_status', 0)->paginate(3);
        return view('website.bu.index', compact('bus'));
    }
    public function userBuildingEdit($id)
    {
        $bu = Bu::find($id);
        if (!$bu->bu_status == 0){
            return redirect()->back();
        }else{
            return view('website.bu.edit', compact('bu'));
        }

    }
    public function userBuildingUpdate(BuRequest $request , $id)
    {
        $imageDir = base_path() . '/public/images/buImages/' . Auth::user()->bus()->find($id)->image;
        if ($request->has('image')){
            $input = $request->except('_token', '_method', 'address');
            $input['image'] = inputCheckImage($request->hasFile('image'), $request->file('image'), '/buImages/' , $imageDir);
            $input['month'] = date('m');
        }else{
            $input = $request->except('_token', '_method', 'address');
            $input['month'] = date('m');
        }
            Auth::user()->bus()->find($id)->update($input);
        Alert::success('تم التعديل على العقار بنجاح', 'سوف تنتهى هذه الرساله بعد 5 ثوانى ');
        return redirect()->back();
    }
    public function usersBu(Request $request, $id)
    {


        $bus = User::find($id)->bus;
        return DataTables::of($bus)
            ->editColumn('bu_name', function ($model) {
                return '<a href="'. route('bu.edit', $model->id) .'">'.$model->bu_name.'</a>';
            })
            ->editColumn('bu_type', function ($model) {

                return '<span class="badge badge-info">' .bu_type()[$model->bu_type] . '</span>' ;
            })
            ->editColumn('created_at', function ($model) {
                return $model->created_at->diffForHumans();
            })

            ->editColumn('bu_status', function ($model) {
                return $model->bu_status == 1 ? '<span class="badge badge-info">' . ' مفعل' . '</span>' : '<span class="badge badge-warning">' . 'غير مفعل' . '</span>';

            })
            ->editColumn('control', function ($model) {
                $all = '<a href="' . route('bu.edit', $model->id) . '" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></a> ';

                $all .= "
                        <form action=" . route('bu.destroy' , $model->id) ." method=\"POST\">
                            <input type=\"hidden\" name=\"_token\" value=" . csrf_token() .">
                            <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
                            <button type=\"submit\" class=\"btn btn-danger btn-circle\"><i class=\"fa fa-trash-o\"></i></button>
                        </form>
                    ";

                return $all;
            })
            ->rawColumns(['bu_name', 'bu_type', 'created_at', 'bu_status', 'control'])
            ->make(true);



    }
    public function buStatusActive($id)
    {
        Bu::findOrFail($id)->update(['bu_status'=>1]);
        Alert::success('تم تفعيل العقار بنجاح', 'سوف تنتهى هذه الرساله بعد 5 ثوانى');
        return redirect()->back();
    }
    public function buStatusRemoveActive($id)
    {
        Bu::findOrFail($id)->update(['bu_status'=>0]);
        Alert::success('تم الغاء تفعيل العقار بنجاح', 'سوف تنتهى هذه الرساله بعد 5 ثوانى');
        return redirect()->back();
    }
    function fetch_data_no_active(Request $request, $id)
    {


            $bus = User::find($id)->bus()->where('bu_status', 0)->paginate(3);
            return view('administrator.layouts.pagination_data_no_active', compact('bus'))->render();

    }


}
