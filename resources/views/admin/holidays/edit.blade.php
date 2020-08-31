@extends('layouts.app')        

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Holiday</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}">Admin Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Edit Holiday
                        </li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 mx-auto">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                Edit Holiday
                            </h3>
                        </div>
                        @include('messages.alerts')
                        <form action="{{ route('admin.holidays.update', $holiday->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" value="{{ $holiday->name }}" class="form-control">
                                    @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Multiple Days</label>
                                    <select name="multiple-days" class="form-control" onchange="showInput()">
                                        @if ($holiday->end_date)
                                        <option value="no">No</option>
                                        <option value="yes" selected>Yes</option>
                                        @else
                                        <option value="no" selected>No</option>
                                        <option value="yes">Yes</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group" id="single-date">
                                    <label for="">Select date </label>
                                    <input type="text" name="date" id="date1" class="form-control">
                                </div>
                                <div class="form-group" id="multiple-date">
                                    <label for="">Select date range</label>
                                    <input type="text" name="date_range" id="date2" class="form-control">
                                    @error('date_range')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@section('extra-js')

<script>
    $(document).ready(function() {
        if('{{ $holiday->end_date }}') {
            $('#date1').daterangepicker({
                "showDropdowns": true,
                "singleDatePicker": true,
                "locale": {
                    "format": "DD-MM-YYYY",
                }
            });
            $('#single-date').addClass('hide-input');
            start = moment('{{ $holiday->start_date }}', 'YYYY-MM-DD');
            end = moment('{{ $holiday->end_date }}', 'YYYY-MM-DD');
            $('#date2').daterangepicker({
                "startDate": start,
                "endDate": end,
                "showDropdowns": true,
                "locale": {
                    "format": "DD-MM-YYYY",
                }
            });
        } else {
            start = moment('{{ $holiday->start_date }}', 'YYYY-MM-DD');
            $('#date1').daterangepicker({
                "startDate": start,
                "showDropdowns": true,
                "singleDatePicker": true,
                "locale": {
                    "format": "DD-MM-YYYY",
                }
            });
            $('#date2').daterangepicker({
                "showDropdowns": true,
                "locale": {
                    "format": "DD-MM-YYYY",
                }
            });
            $('#multiple-date').addClass('hide-input');
        }
    });

    function showInput() {
        $('#single-date').toggleClass('hide-input');
        $('#multiple-date').toggleClass('hide-input');
    }
</script>
@endsection