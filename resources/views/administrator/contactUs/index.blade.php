@extends('administrator.layouts.master')



@section('content')
    <hr>
    <h1>رسائل الموقع</h1>
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
                        <table class="table table-striped table-bordered table-hover" id="data">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>البريد الالكترونى</th>
                                <th>اضيف فى</th>
                                <th>الحاله</th>
                                <th>نوع الرساله</th>
                                <th>التحكم</th>
                            </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>البريد الالكترونى</th>
                                <th>اضيف فى</th>
                                <th>الحاله</th>
                                <th>نوع الرساله</th>
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

    <script src="{{ asset('administrator/js/jquery/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('administrator/js/bootstrap/dataTables.bootstrap.min.js') }}"></script>

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
            }else if($(this).index() == 4){
                $(this).html( '{!! Form::select('contact_type', typeContactUs(), null) !!}' );

            }else if($(this).index() == 5){
                $(this).html( '{!! Form::select('contact_type', ["0"=>"رساله جديده", "1"=>"رساله قديمه"], null, ['id'=>'contact_type']) !!}' );

            }



        } );

        var table = $('#data').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url('adminpanel/contactUs/data') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'contact_name', name: 'contact_name'},
                {data: 'contact_email', name: 'contact_email'},
                {data: 'created_at', name: 'created_at'},
                {data: 'contact_type', name: 'contact_type', orderable: true, searchable: true},
                {data: 'view', name: 'view'},
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
                [5, 10,25, 50, 100, 200, -1],
                [5, 10, 25, 50, 100, 200, "All"]
            ],
            iDisplayLength: 5,
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
            var that = this;
            $( 'select', this.footer() ).on( 'change', function () {
                console.log(this.value);
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );



        });


        // // table.columns().eq(0).each(function(colIdx) {
        // //     $('select', table.column(colIdx).header()).on('change', function() {
        // //         table
        // //             .column(colIdx)
        // //             .search(this.value)
        // //             .draw();
        // //         console.log(this.value)
        // //     });
        //
        //         $('select', table.column(colIdx).header()).on('click', function(e) {
        //             e.stopPropagation();
        //         });
        // });


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
