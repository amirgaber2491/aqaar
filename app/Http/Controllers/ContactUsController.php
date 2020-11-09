<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Models\Bu;
use App\Models\ContactUs;
use App\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

//use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function contactUs()
    {
        $contacts = ContactUs::all();
        return view('website.contactUs', compact('contacts'));
    }
    public function store(ContactUsRequest $request)
    {
        ContactUs::create($request->all());
        Alert::success('تم اضافه الرساله بنجاح', 'سوف تنتهى هذه الرساله بعد 5 ثوانى ');
        return redirect()->back()->withFlash('test');
    }
    public function index()
    {
        return view('administrator.contactUs.index');
    }
    public function delete($id)
    {
        ContactUs::findOrFail($id)->delete();
        Alert::success('تم حذف الرساله بنجاح ', 'سوف تنتهى هذه الرساله بعد 5 ثوانى ');
        return redirect()->back();
    }
    public function edit($id)
    {
        ContactUs::findOrFail($id)->update(['view'=>1]);
        $contact = ContactUs::findOrFail($id);
        return view('administrator.contactUs.edit', compact('contact'));
    }
    public function update(ContactUsRequest $request, $id)
    {
        ContactUs::findOrFail($id)->update($request->all());
        Alert::success('تم التعديل على الرساله بنجاح ', 'سوف تنتهى هذه الرساله بعد 5 ثوانى ');
        return redirect()->back();
    }
    public function anyData(Request $request)
    {

        $contact = ContactUs::all();
        return DataTables::of($contact)
            ->editColumn('contact_name', function ($model){
                return "<a href=" . route('admin.contact.edit', $model->id) . ">" . $model->contact_name . "</a>";
            })
            ->editColumn('created_at', function ($model){
                return  $model->created_at->diffForHumans();
            })
            ->editColumn('view', function ($model){
                return $model->view == 0 ? 'رساله جديده' : 'رساله قديمه';
            })

            ->editColumn('contact_type', function ($model){
                return typeContactUs()[$model->contact_type];
            })
            ->filter(function ($instance) use ($request) {
                if ($request->get('contact_type') == '0' || $request->get('contact_type') == '1' || $request->get('contact_type') == '2' || $request->get('contact_type') == '3') {
                    $instance->where('contact_type', 1);
                }


            })

            ->editColumn('control', function ($model) {
                $all = '<a href="' . route('admin.contact.edit', $model->id) . '" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></a> ';

                $all .= "
                        <form action=" . route('admin.contact.delete' , $model->id) ." method=\"POST\">
                            <input type=\"hidden\" name=\"_token\" value=" . csrf_token() .">
                            <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
                            <button type=\"submit\" class=\"btn btn-danger btn-circle\"><i class=\"fa fa-trash-o\"></i></button>
                        </form>
                    ";

                return $all;
            })
            ->rawColumns(['contact_name', 'contact_type', 'view', 'control'])
            ->make(true);



    }
}
