

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

                        <li class="breadcrumb-item active">الرئيسية</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex text-muted">
                        <div class="flex-shrink-0 me-3 align-self-center">
                            <div class="avatar-sm">
                                <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                    <i class="fas fa-user-check"></i>
                                </div>
                            </div>                            </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1">المؤظفين</p>
                            <h5 class="mb-3">{{$admins_count}}</h5>
                            <p class="text-truncate mb-0">
                                </p>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3 align-self-center">
                            <div class="avatar-sm">
                                <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                    <i class="fas fa-users"></i>


                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1">المستفيدين</p>
                            <h5 class="mb-3">{{$users_count}}</h5>

                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex text-muted">
                        <div class="flex-shrink-0 me-3 align-self-center">
                            <div class="avatar-sm">
                                <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                    <i class="mdi mdi-home-variant-outline"></i>


                                </div>
                            </div>                            </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1">مراكز التوزيع</p>
                            <h5 class="mb-3">{{$rooms_count}}</h5>

                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex text-muted">
                        <div class="flex-shrink-0  me-3 align-self-center">
                            <div class="avatar-sm">
                                <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1">المندوبين</p>
                            <h5 class="mb-3">{{$sponsor_count}}</h5>

                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">كشف الرائيسي</h4>
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
                                    <th>اسم الزوجة</th>
                                    <th>رقم هوية الزوجة</th>
                                    <th>الجوال</th>
                                    <th>عدد الافراد</th>
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

    $("#datatable").DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "desc" ]],
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, 'All'] ], 
        ajax: {
                url: "{{ route('admin.main.index') }}",
                // data: function (d) {
                //     d.email = $('.searchEmail').val(),
                //     d.search = $('input[type="search"]').val()
                // }
            },
        columns: [
            {data: 'id', name: 'id', title: '#'},
            {data: 'full_name', name: 'full_name', title: 'الإسم'},
            {data: 'id_num', name: 'id_num', title: 'رقم الهوية'},
            {data: 'wife_name', name: 'wife_name', title: 'اسم الزوجة'},
            {data: 'wife_id_num', name: 'wife_id_num', title: ' رقم الهوية الزوجة'},
            {data: 'mobile', name: 'mobile', title: 'رقم الجوال'},
            {data: 'family_count', name: 'family_count', title: 'عدد الافراد'},

        ],
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

    // $(".searchEmail").keyup(function () {
    //         table.draw();
    // });
});


</script>


@endsection



