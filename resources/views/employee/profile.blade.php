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
                        <a href="#">Home</a>
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
                        <table class="table table-hover">
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
                            <tr>
                                <td>Photo</td>
                                @if ($employee->photo != 'user.png')
                                    <td>
                                        <button type="button" class="btn btn-sm btn-flat btn-primary" data-toggle="modal" data-target="#modal-default">
                                            View Profile Photo
                                        </button>
                                    </td>
                                @else 
                                    <td>No image upload</td>
                                @endif
                                
                            </tr>
                        </table>
                        @if ($employee->photo != 'user.png')
                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Profile Photo</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="/storage/employee_photos/{{ $employee->photo }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                        @endif
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('employee.profile-edit', $employee->id) }}" class="btn btn-flat btn-primary">Edit Profile</a>
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
