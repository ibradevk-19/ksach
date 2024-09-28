@extends('includes.main')
@section('content')


<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">مستفيد جديد</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> الرئيسية</a></li>
                        <li class="breadcrumb-item active">مستفيد جديد </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
            @csrf
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <livewire:beneficial-form />
                </div>
            </div>

        </div> <!-- end col -->



    </div>


</div>
@endsection
@section('scripts.center')
<script src="{{asset('assets/libs/axios/dist/axios.min.js')}}"></script>

    <script>


    // function checkIdNumber() {
    //     var id = document.getElementById('id_num').value;
    //      // Make a request for a user with a given ID
    //      return axios.get(`check_number/` +id)
    //                 .then(function (response) {
    //                     if(response.data.data.full_name){
    //                         var id = document.getElementById('full_name').value = response.data.data.full_name ;
    //                     }else{
    //                         var id = document.getElementById('full_name').value = 'لا يوجد له بيانات' ;
    //                     }
    //                     console.log(response.data.data.full_name);
    //                 })
    // }

    // function checkIdNumberwife() {
    //     var id = document.getElementById('wife_id_num').value;
    //      // Make a request for a user with a given ID
    //      return axios.get(`check_number/` +id)
    //                 .then(function (response) {
    //                     if(response.data.data.full_name){
    //                         var id = document.getElementById('wife_name').value = response.data.data.full_name ;
    //                     }else{
    //                         var id = document.getElementById('wife_name').value = 'لا يوجد له بيانات' ;
    //                     }
    //                     console.log(response.data.data.full_name);
    //                 })
    // }


    </script>
@endsection
