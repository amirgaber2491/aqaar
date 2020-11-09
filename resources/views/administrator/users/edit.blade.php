@extends('administrator.layouts.master')
@section('header')
    <link rel="stylesheet" href="{{ asset('administrator/css/plugins/dataTables.bootstrap.css') }}">


@section('content')
    <div class="col-lg-5">
        <hr>
        <h2>تعديل العضو {{ $user->name }}</h2>
        <hr>
        {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id]]) !!}
        <div class="group">
            <label for="">اسم المستخدم :</label>
            {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'ادخل اسم المستخدم ']) !!}
        </div>
        @error('name')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <br>
        <div class="group">
            <label for="">البريد الالكترونى : </label>
            {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'ادخل البريد الالكترونى ']) !!}
        </div>
        @error('email')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <div class="form-group">
            {!! Form::select('role', [''=>'اختار الصلحيه', '0'=>'عضو', '1'=>'مشرف'], null, ['class'=>'form-control']) !!}
        </div>
        <br>
        <div class="group">
            <input type="submit" value="حفظ التعديلات" class="btn btn-warning">
        </div>
        {!! Form::close() !!}
        <hr>



        <h2>تغير كلمه المرور اخاصه بالعضو {{ $user->name }}</h2>
        {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@changePassword', $user->id]]) !!}

        <div class="group">
            <label for="">كلمه المرور الجديده :</label>
            {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'ادخل كلمه المرور الجديده']) !!}
        </div>
        @error('password')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <br>
        <div class="group">
            <label for="">تكرار كلمه المرور : </label>
            {!! Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=>'تكرار كلمه المرور']) !!}
        </div>
        <br>
        <div class="group">
            <input type="submit" value="تغسر كلمه المرور" class="btn btn-warning">
        </div>
        {!! Form::close() !!}
    </div>
        <div class="col-lg-7">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#bu_status_active" data-toggle="tab">العقارات المفعله </a>
                        </li>
                        <li><a href="#bu_status_remove_active" data-toggle="tab">العقارات الغير مفعله </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="bu_status_active">
                                @if(count($user->bus()->where('bu_status', 1)->get()) > 0)
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>اسم العقار</th>
                                            <th>اضيف فى</th>
                                            <th>تغير الحاله</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($user->bus()->where('bu_status', 1)->get() as $bu )
                                            <tr>
                                                <th>{{ $bu->bu_name }}</th>
                                                <th>{{ $bu->created_at->diffForHumans() }}</th>
                                                <th>
                                                    {!! Form::open(['method'=>'PATCH', 'action'=>['BuController@buStatusRemoveActive', $bu->id]]) !!}
                                                    {!! Form::submit('ازاله التفعيل', ['class'=>'btn btn-danger']) !!}
                                                    {!! Form::close() !!}
                                                </th>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                @else
                                    <div class="alert alert-danger">لا يوجد عقارات مفعله </div>
                                @endif
                        </div>
                        <div class="tab-pane fade" id="bu_status_remove_active">
                            @if(count($user->bus()->where('bu_status', 0)->get()) > 0)
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>اسم العقار</th>
                                    <th>اضيف فى</th>
                                    <th>تغير الحاله</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($user->bus()->where('bu_status', 0)->get() as $bu )
                                    <tr>
                                        <th>{{ $bu->bu_name }}</th>
                                        <th>{{ $bu->created_at->diffForHumans() }}</th>
                                        <th>
                                            {!! Form::open(['method'=>'PATCH', 'action'=>['BuController@buStatusActive', $bu->id]]) !!}
                                            {!! Form::submit('تفعيل', ['class'=>'btn btn-primary']) !!}
                                            {!! Form::close() !!}
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            @else
                                <div class="alert alert-danger">لا يوجد عقارات غير مفعله </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>

@stop
@section('footer')
    <script src="{{ asset('administrator/js/jquery/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('administrator/js/bootstrap/dataTables.bootstrap.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('administrator/js/sb-admin-2.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').dataTable({
                "lengthMenu": [ 5, 10, 25, 50, 75, 100 ]
            });
        });
    </script>
@stop
