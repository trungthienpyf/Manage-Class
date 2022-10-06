@extends('layout.master')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('home') }}
@endsection
<!-- end page title -->


@push('css')


    <!-- end row -->

    <link href="{{asset('css/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />

    <style>
        #basic-datatable_wrapper{
            width: 100%;
        }
    </style>
@endpush
<!-- end row -->

@section('content')
    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
        <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
        </tr>
        </thead>


        <tbody>
        <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011/04/25</td>
            <td>$320,800</td>
        </tr>
        <tr>
            <td>Garrett Winters</td>
            <td>Accountant</td>
            <td>Tokyo</td>
            <td>63</td>
            <td>2011/07/25</td>
            <td>$170,750</td>
        </tr>
        </tbody>
    </table>
@endsection
<!-- end row-->

@push('js')


    <!-- end row -->
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/demo.datatable-init.js')}}"></script>

    <!-- Datatable Init js -->


@endpush

<!-- end row-->

<!-- End Content -->
