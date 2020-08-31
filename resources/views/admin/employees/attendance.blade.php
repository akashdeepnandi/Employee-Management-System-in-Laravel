@extends('layouts.app')        

@section('content')
    <!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Attendance</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Admin Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Attendance
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
                <div class="card card-primary">
                    <div class="card-header">
                        <h5 class="text-center">Attendance Date</h5>
                    </div>
                    <form action="{{ route('admin.employees.attendance') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="input-group mx-auto" style="width:70%">
                            <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            <input type="text" name="date" id="date" class="form-control text-center" >
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-flat btn-primary" type="submit">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title text-center">
                            @if ($date)
                            Employee Attendance on {{ $date }}                                
                            @else
                            Employee Attendance Today
                            @endif
                        </div>
                        
                    </div>
                    <div class="card-body">
                        @if ($employees->count())
                        <table class="table table-bordered table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Entry</th>
                                    <th class="none">Entry Record</th>
                                    <th>Exit</th>
                                    <th class="none">Exit Record</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $index => $employee)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $employee->first_name.' '.$employee->last_name }}</td>
                                    @if($employee->attendanceToday)
                                        <td><h6 class="text-center"><span class="badge badge-pill badge-success">Recorded</span></h6></td>
                                        <td>
                                            Recorded at {{ $employee->attendanceToday->created_at->format('H:i:s') }} from {{ $employee->attendanceToday->entry_location}} with IP {{ $employee->attendanceToday->entry_ip}}
                                        </td>
                                        @if ($employee->attendanceToday->exit_ip)
                                            <td><h6 class="text-center"><span class="badge badge-pill badge-success">Recorded</span></h6></td>
                                            <td>
                                                Recorded at {{ $employee->attendanceToday->updated_at->format('H:i:s') }} from {{ $employee->attendanceToday->exit_location}} with IP {{ $employee->attendanceToday->exit_ip}}
                                            </td>
                                        @else
                                            <td><h6 class="text-center"><span class="badge badge-pill badge-danger">No Record</span></h6></td>
                                            <td><h6 class="text-center"><span class="badge badge-pill badge-danger">No Record</span></h6></td>
                                        @endif
                                    @else
                                        <td><h6 class="text-center"><span class="badge badge-pill badge-danger">No Record</span></h6></td>
                                        <td><h6 class="text-center"><span class="badge badge-pill badge-danger">No Record</span></h6></td>
                                        <td><h6 class="text-center"><span class="badge badge-pill badge-danger">No Record</span></h6></td>
                                        <td><h6 class="text-center"><span class="badge badge-pill badge-danger">No Record</span></h6></td>
                                    @endif
                                    <td>{{ $employee->department }}</td>
                                    <td>{{ $employee->desg }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="alert alert-info text-center" style="width:50%; margin: 0 auto">
                            <h4>No Records Available</h4>
                        </div>
                        @endif
                        
                    </div>
                </div>
                <!-- general form elements -->
                
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
        $('#dataTable').DataTable({
            responsive:true,
            autoWidth: false,
        });
        $('#date').daterangepicker({
            "singleDatePicker": true,
            "showDropdowns": true,
            "locale": {
                "format": "DD-MM-YYYY"
            }
        });
    });
</script>
@endsection