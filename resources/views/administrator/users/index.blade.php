@extends('administrator.layouts.master')



@section('content')
    <hr>
    <h1>كل الاعضاء</h1>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    DataTables Advanced Tables
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="data">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المستخدم</th>
                                <th>البريد الالكترونى</th>
                                <th>اضيف فى</th>
                                <th>عقاراتى</th>
                                <th>الصلحيات</th>
                                <th>التحكم</th>
                            </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>اسم المستخدم</th>
                                <th>البريد الالكترونى</th>
                                <th>اضيف فى</th>
                                <th>عقاراتى</th>
                                <th>الصلحيات</th>
                                <th>التحكم</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
@stop
@section('footer')

    <!-- DataTables JavaScript -->

{{--    <script src="{{ asset('administrator/js/jquery/jquery.dataTables.min.js') }}"></script>--}}
{{--    <script src="{{ asset('administrator/js/bootstrap/dataTables.bootstrap.min.js') }}"></script>--}}
    <script src="{{ asset('administrator/js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('administrator/js/datatables/dataTables.bootstrap4.min.js') }}"></script>
{{--    <script src="{{ asset('administrator/js/datatables/dataTables.responsive.min.js') }}/"></script>--}}
{{--    <script src="{{ asset('administrator/js/datatables/responsive.bootstrap4.min.js') }}/"></script>--}}

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('administrator/js/sb-admin-2.js') }}"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->

    <script type="text/javascript">


        var lastIdx = null;

        $('#data thead th').each( function () {
            if($(this).index()  < 4 ){
                var classname = $(this).index() == 6  ?  'date' : 'dateslash';
                var title = $(this).html();
                $(this).html( '<input type="text" class="' + classname + '" data-value="'+ $(this).index() +'" placeholder=" البحث '+title+'" />' );
            }else if($(this).index() == 5){
                $(this).html( '<select><option value="0"> عضو </option><option value="1"> مدير الموقع </option></select>' );
                // $(this).html( '<select name="role"><option value="0"> عضو </option><option value="1"> مدير الموقع </option></select>' );
            }

        } );

        var table = $('#data').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url('/adminpanel/users/data') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'created_at', name: 'created_at'},
                {data: 'mybu', name: 'mybu'},
                {data: 'role', name: 'role'},
                //  {data: 'exame', name: 'exame'},
                {data: 'control', name: ''}
            ],
            "language": {
                "url": "{{ asset('administrator/cus/Arabic.json') }}"
            },
            "stateSave": false,
            "responsive": true,
            "order": [[0, 'desc']],
            "pagingType": "full_numbers",
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            iDisplayLength: 25,
            fixedHeader: true,

            "oTableTools": {
                "aButtons": [


                    {
                        "sExtends": "csv",
                        "sButtonText": "ملف اكسل",
                        "sCharSet": "utf16le"
                    },
                    {
                        "sExtends": "copy",
                        "sButtonText": "نسخ المعلومات",
                    },
                    {
                        "sExtends": "print",
                        "sButtonText": "طباعة",
                        "mColumns": "visible",


                    }
                ],

                "sSwfPath": "{{ asset('administrator/cus/copy_csv_xls_pdf.swf') }}"
            },

            "dom": '<"pull-left text-left" T><"pullright" i><"clearfix"><"pull-right text-right col-lg-6" f > <"pull-left text-left" l><"clearfix">rt<"pull-right text-right col-lg-6" pi > <"pull-left text-left" l><"clearfix"> '
            ,initComplete: function ()
            {
                var r = $('#data tfoot tr');
                r.find('th').each(function(){
                    $(this).css('padding', 8);
                });
                $('#data thead').append(r);
                $('#search_0').css('text-align', 'center');
            }

        });

        table.columns().eq(0).each(function(colIdx) {
            $('input', table.column(colIdx).header()).on('keyup change', function() {
                table
                    .column(colIdx)
                    .search(this.value)
                    .draw();
            });

        });



        table.columns().eq(0).each(function(colIdx) {
            $('select', table.column(colIdx).header()).on('change', function() {
                table
                    .column(colIdx)
                    .search(this.value)
                    .draw();
            });

            $('select', table.column(colIdx).header()).on('click', function(e) {
                e.stopPropagation();
            });
        });



        $('#data tbody')
            .on( 'mouseover', 'td', function () {
                var colIdx = table.cell(this).index().column;

                if ( colIdx !== lastIdx ) {
                    $( table.cells().nodes() ).removeClass( 'highlight' );
                    $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
                }
            } )
            .on( 'mouseleave', function () {
                $( table.cells().nodes() ).removeClass( 'highlight' );
            } );




    </script>

@stop
