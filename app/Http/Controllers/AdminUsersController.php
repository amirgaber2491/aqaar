<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUsersRequest;
use App\Http\Requests\AdminUserChangePasswordRequest;
use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
//use Yajra\DataTables\Contracts\DataTable;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('administrator.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUsersRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role'=>$request->role
        ]);
        Alert::success('تم اضافه العضو بنجاح', 'سوف تنتهى هذه الرساله بعد 5 ثوانى ');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('administrator.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

            $validator = Validator::make($request->all(), [
                'name' => 'required | string | max:255',
                'email' => 'required | string | email | max:255 | unique:users,email,'. $id,
                'role'=>'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        $user = User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role'=>$request->role
        ]);
        Alert::success('تم تعديل بيانات العضو بنجاح', 'سوف تنتهى هذه الرساله بعد 5 ثوانى ');
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
        User::findOrFail($id)->delete();
        Alert::success('تم حذف العضو بنجاح', 'سوف تنتهى هذه الرساله بعد 5 ثوانى ');
           return redirect()->back();
    }
    public function changePassword(AdminUserChangePasswordRequest $request, $id)
    {
        User::find($id)->update([
            'password'=>$request->password
        ]);
        return redirect()->route('users.index');
    }
    public function anyData(User $user)
    {

        $users = $user->all();

        return DataTables::of($users)
            ->editColumn('name', function ($model) {
                return '<a href="'. route('users.edit', $model->id) .'">'.$model->name.'</a>';
            })

            ->editColumn('role', function ($model) {
                return $model->role == 0 ? '<span class="badge badge-info">' . 'عضو' . '</span>' : '<span class="badge badge-warning">' . 'مدير الموقع' . '</span>';
            })

            ->editColumn('created_at', function ($model) {
                return $model->created_at->diffForHumans();
            })
            ->editColumn('mybu', function ($model) {
                return '<a href="'. route('bu.show', $model->id) .'">' . '<i class="fa fa-link" style="font-size: 30px;color: red"></i>' . '</a>';
            })

            ->editColumn('control', function ($model) {
                $all = '<a href="' . route('users.edit', $model->id) . '" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></a> ';
                if($model->id != 1){
                    $all .= "
                        <form action=" . route('users.destroy' , $model->id) ." method=\"POST\">
                            <input type=\"hidden\" name=\"_token\" value=" . csrf_token() .">
                            <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
                            <button type=\"submit\" class=\"btn btn-danger btn-circle\"><i class=\"fa fa-trash-o\"></i></button>
                        </form>
                    ";
                }
                return $all;
            })
            ->rawColumns(['name', 'email', 'role', 'control', 'mybu'])
            ->make(true);



    }
    public function profile()
    {
        $user = Auth::user();
        return view('website.userProfile.edit', compact('user'));
    }

    public function test()
    {

        return view('test');
    }
    public function testPost(Request $request)
    {
        return $request->all();
        return view('test');
    }
    public function profileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . Auth::id(),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        Auth::user()->update([
            'name'=>$request->name,
            'email'=>$request->email
        ]);
        Alert::success('تم تعديل البيانات بنجاح', 'سوف تنتهى هذه الرساله بعد 5 ثوانى ');
        return redirect()->back();
    }
    public function profileChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required', new MatchOldPassword,
            'new_password' => 'required| string | min:1 | confirmed',
            'new_confirm_password' => 'same:new_password',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        User::find(auth()->user()->id)->update(['password'=> $request->new_password]);
        Alert::success('تم تغير كلمه المرور بنجاح ', 'سوف تنتهى هذه الرساله بعد 5 ثوانى ');
        return redirect()->back();
    }
}
