@extends('includes.main')

@section('style')
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css"/>

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
          rel="stylesheet"
          type="text/css"/>

    <style>
        div.dataTables_wrapper div.dataTables_filter {
            text-align: end;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">المركز السعودي</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item active">الفواتير</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <!-- <div class="row my-3">
            <div class="col-6">
                <a href="{{route('invoices.create')}}"  class="btn btn-primary">فاتورة جديد</a>
            </div>
        </div> -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">قائمة الفواتير</h4>
                        <br/>
                        <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">النوع</label>
                        <div class="col-md-5">
                            <select id='type' name="type" class="form-select">
                                <option  value="">  </option>
                                <option  value="out">صادر </option>
                                <option  value="in"> وارد </option>
                            </select>
                        </div>
                    </div>

                        <div class="table-responsive">
                            <table id="datatable"
                                   class="table table-striped table-bordered dt-responsive nowrap "
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>التاريخ</th>
                                    <th>الحركة</th>
                                    <th>المستلم </th>
                                    <th>المورد </th>
                                    <th>المنفذ </th>
                                    <th>المنتج</th>
                                    <th>التصنيف</th>
                                    <th>الكمية</th>
                                    <th>الوحدة</th>
                                    <!-- <th>الإجراءات</th> -->
                                </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


    </div>
@endsection
@section('scripts.center')
    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <script>

        $(document).ready(function () {

        var datatable =  $("#datatable").DataTable({
            
                processing: true,
                serverSide: true,
                order: [[0, "desc" ]],
             
                ajax: {
                    url: "{{ route('invoices.index') }}",
                    data: function (d) {
                            d.type = $('#type').val()
                        }
                },
                columns: [
                    {data: 'id', name: 'id', title: '#'},
                    {data: 'date', name: 'date' , title: 'التاريخ'},
                    {data: 'type', name: 'type', title: 'الحركة'},
                    {data: 'provider_name', name: 'provider_name', title: 'المورد'},
                    {data: 'receiver_name', name: 'receiver_name', title: 'المستلم'},
                    {data: 'port_name', name: 'port_name', title: 'المنفذ'},
                    {data: 'product', name: 'product', title: 'المنتج'},
                    {data: 'category', name: 'category' , title: 'التصنيف'},
                    {data: 'quantity', name: 'quantity' , title: 'الكمية'},
                    {data: 'unit', name: 'unit' , title: 'الوحدة'},
                    // {data: 'action', name: 'action', orderable: false, searchable: false, title: 'الإجراءات'},
                ],
                layout: {
                    topStart: {
                        buttons: ['print']
                    }
                },
                language: {
                    // "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/ar.json",
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-right'>",
                        next: "<i class='mdi mdi-chevron-left'>"
                    },
                    "loadingRecords": "جارٍ التحميل...",
                    "lengthMenu": "أظهر _MENU_ مدخلات",
                    "zeroRecords": "لم يعثر على أية سجلات",
                    "info": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "infoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "search": "ابحث:",
                    "processing": 'جاري المعالجة...',
                    "infoEmpty": 'يعرض 0 إلى 0 من أصل 0 مُدخل',
                }, drawCallback: function () {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                },
            
            });

            $('#type').change(function(){
                console.log("Hello world!");
                datatable.draw();
            });
        });

       
    </script>

@include('includes.delete_item',['route_delete'=>url("/panel/admin")])
@endsection
