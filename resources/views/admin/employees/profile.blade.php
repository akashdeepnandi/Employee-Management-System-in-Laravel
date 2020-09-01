@extends('layouts.app')        

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Profile</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Profile
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
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card card-primary">
                    <div class="card-header">
                        <h5 class="text-center mt-2">My Profile</h5>
                    </div>
                    <div class="card-body">
                        @include('messages.alerts')
                        <div class="row mb-3">
                            <div class="col text-center mx-auto">
                                <img src="/storage/employee_photos/{{ $employee->photo }}" class="rounded-circle img-fluid" alt=""
                                style="box-shadow: 2px 4px rgba(0,0,0,0.1)"
                                >
                            </div>
                        </div>
                        <table class="table profile-table table-hover">
                            <tr>
                                <td>First Name</td>
                                <td>{{ $employee->first_name }}</td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td>{{ $employee->last_name }}</td>
                            </tr>
                            <tr>
                                <td>Date of Birth</td>
                                <td>{{ $employee->dob->format('d M, Y') }}</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>{{ $employee->sex }}</td>
                            </tr>
                            
                            <tr>
                                <td>Join Date</td>
                                <td>{{ $employee->join_date->format('d M, Y') }}</td>
                            </tr>
                            <tr>
                                <td>Designation</td>
                                <td>{{ $employee->desg }}</td>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <td>{{ $employee->department->name }}</td>
                            </tr>
                            <tr>
                                <td>Salary</td>
                                <td>₹ {{ $employee->salary }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer text-center" style="height: 2rem">
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- /.content-wrapper -->

@endsection
