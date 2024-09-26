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
                            <li class="breadcrumb-item active">الممثلين</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row my-3">
            <div class="col-6">
                <a href="{{route('actors.create')}}"  class="btn btn-primary">مندوب جديدة</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">قائمة المندوبين</h4>
                        <br/>

                        <div class="table-responsive">
                            <table id="datatable"
                                   class="table table-striped table-bordered dt-responsive nowrap "
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الإسم</th>
                                    <th>رقم الهوية</th>
                                    <th>رقم الجوال</th>
                                    <th>العائلة</th>
                                    <th>الاجراءات </th>
                                </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


    </div>

    <div id="del_modal"></div>

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
            var columns_data = [
                    {data: 'id', name: 'id', title: '#'},
                    {data: 'name', name: 'name', title: 'الإسم'},
                    {data: 'id_num', name: 'id_num', title: 'رقم الهوية',searchable:false},
                    {data: 'mobile_num', name: 'mobile_num', title: 'رقم الجوال',searchable:false},
                    {data: 'flamily_name', name: 'flamily_name', title: 'العائلة',searchable:false},
                ];
            var data_actions = {data: 'action', name: 'action', orderable: false, searchable: false, title: 'الإجراءات'};

            var check = "{{checkPermission('view events')}}"


            if(check){
                columns_data.push(data_actions);
            }

         
            $("#datatable").DataTable({
                processing: true,
                serverSide: true,
                order: [[0, "desc" ]],
                ajax: "{{ route('actors.index') }}",
                columns: columns_data,
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
                }
            });
        });


    </script>
<script src="{{asset('assets/libs/axios/dist/axios.min.js')}}"></script>
<script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
<script>


@endsection
