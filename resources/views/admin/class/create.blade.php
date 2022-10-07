@extends('layout.master')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('home') }}
@endsection
<!-- end page title -->


@push('css')


    <!-- end row -->

    <style>
        .datepicker{
            z-index: 9999!important;
        }
    </style>

@endpush
<!-- end row -->

@section('content')
    <div class="col-xl-6" data-select2-id="6">
        <div class="form-group">
            <label for="subject">Môn học</label>
            <select class="form-control select2" id="subject" data-toggle="select2">

                <optgroup label="Alaskan/Hawaiian Time Zone">
                    <option value="AK">Alaska</option>
                    <option value="HI">Hawaii</option>
                </optgroup>
                <optgroup label="Pacific Time Zone">
                    <option value="CA">California</option>
                    <option value="NV">Nevada</option>
                    <option value="OR">Oregon</option>
                    <option value="WA">Washington</option>
                </optgroup>
            </select>
        </div>
        <!-- Date View -->
        <div class="form-group">
            <label>Ngày dự kiến</label>
            <input type="text" class="form-control"   min="{{date('d-m-yyyy')}}" data-provide="datepicker" data-date-format="d/m/yyyy"
                   data-date-autoclose="true">
        </div>
        <!-- Date View -->
        <div class="form-group">
            <label>Start Date</label>
            <input type="text" class="form-control" data-provide="datepicker" data-date-format="d-M-yyyy"
                   data-date-autoclose="true">
        </div>
        <div class="form-group">
            <label for="project-budget">Budget</label>
            <input type="text" id="project-budget" class="form-control" placeholder="Enter project budget">
        </div>
        <div class="form-group">
            <label for="project-overview">Overview</label>
            <textarea class="form-control" id="project-overview" rows="5"
                      placeholder="Enter some brief about project.."></textarea>
        </div>



        <div class="form-group">
            <label for="project-budget">Budget</label>
            <input type="text" id="project-budget" class="form-control" placeholder="Enter project budget">
        </div>

        <div class="form-group mb-0" data-select2-id="5">
            <label for="">Team Members</label>

            <select class="form-control select2" data-toggle="select2">
                <option>Select</option>
                <optgroup label="Alaskan/Hawaiian Time Zone">
                    <option value="AK">Alaska</option>
                    <option value="HI">Hawaii</option>
                </optgroup>
                <optgroup label="Pacific Time Zone">
                    <option value="CA">California</option>
                    <option value="NV">Nevada</option>
                    <option value="OR">Oregon</option>
                    <option value="WA">Washington</option>
                </optgroup>
            </select>


        </div>

    </div>


@endsection
<!-- end row-->

@push('js')


    <!-- end row -->


    <!-- Datatable Init js -->


@endpush

<!-- end row-->

<!-- End Content -->
