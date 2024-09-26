@extends('includes.main')

@section('style')
    <!-- DataTables -->
    
    <!-- Responsive datatable examples -->
    
    <style>
        div.dataTables_wrapper div.dataTables_filter {
            text-align: end;
        }
    </style>
@endsection
@section('content')
@livewire('excel-check')
@endsection
@section('scripts.center')
    <!-- Required datatable js -->
    <!-- Buttons examples -->
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
   

    <script>

  

@endsection
