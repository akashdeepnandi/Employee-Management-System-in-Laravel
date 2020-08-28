@extends('layouts.app')        

@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Admin Dashboard</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Admin Dashboard
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
        <row class="">
        <div class="col-md-8 mx-auto">
            <div class="jumbotron">
            <h1 class="display-4 text-primary">Welcome to Admin Panel of EAMS</h1>
            <p class="lead">This is employee management application used for handling to the statistics, visualizations and other various tabular work</p>
            <hr class="my-4">
            <p>Hope you like it</p>
            </div>
        </div>
        </row>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- /.content-wrapper -->

@endsection
