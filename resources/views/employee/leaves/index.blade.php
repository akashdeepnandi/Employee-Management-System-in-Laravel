@extends('layouts.app')        

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">List Leaves</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('employee.index') }}">Employee Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            List Leaves
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
                <div class="col-lg-8 col-md-10 mx-auto">
                    <!-- general form elements -->
                    @include('messages.alerts')
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">List of leaves</h3>
                        </div>
                        <div class="card-body">
                            @if ($leaves->count())
                            <table class="table table-hover" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Applied on</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                        <th>Half Day</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th class="none">Description</th>
                                        <td class="none">Actions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaves as $index => $leave)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $leave->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $leave->reason }}</td>
                                        <td>
                                            <h5>
                                                <span 
                                                @if ($leave->status == 'pending')
                                                    class="badge badge-pill badge-warning"
                                                @elseif($leave->status == 'declined')
                                                    class="badge badge-pill badge-danger"
                                                @elseif($leave->status == 'approved')
                                                    class="badge badge-pill badge-success"
                                                @endif
                                                >
                                                    {{ ucfirst($leave->status) }}
                                                </span> 
                                            </h5>
                                        </td>
                                        <td>{{ ucfirst($leave->half_day) }}</td>
                                        <td>{{ $leave->start_date->format('d-m-Y')}}</td>
                                        @if($leave->end_date) 
                                        <td>{{ $leave->end_date->format('d-m-Y') }}</td>
                                        @else
                                        <td>Single Day</td>
                                        @endif
                                        <td>{{ $leave->description }}</td>
                                        <td>
                                            <a href="{{ route('employee.leaves.edit', $leave->id) }}" class="btn btn-flat btn-warning">Edit</a>
                                            <button type="button" class="btn btn-flat btn-danger" 
                                            data-toggle="modal" 
                                            data-target="#deleteModalCenter{{ $index + 1 }}"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @for ($i = 1; $i < $leaves->count()+1; $i++)
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModalCenter{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle1{{ $i }}" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="card card-danger">
                                                <div class="card-header">
                                                    <h5 style="text-align: center !important">Are you sure want to delete?</h5>
                                                </div>
                                                <div class="card-body text-center d-flex" style="justify-content: center">
                                                    
                                                    <button type="button" class="btn flat btn-secondary" data-dismiss="modal">No</button>
                                                    
                                                    <form 
                                                    action="{{ route('employee.leaves.delete', $leaves->get($i-1)->id) }}"
                                                    method="POST"
                                                    >
                                                    @csrf
                                                    @method('DELETE')
                                                        <button type="submit" class="btn flat btn-danger ml-1">Yes</button>
                                                    </form>
                                                </div>
                                                <div class="card-footer text-center">
                                                    <small>This action is irreversable</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
                            @endfor
                            @else
                            <div class="alert alert-info text-center" style="width:50%; margin: 0 auto">
                                <h4>No records available</h4>
                            </div>
                            @endif
                        </div>
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
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
    $('.popover-dismiss').popover({
        trigger: 'focus'
    });
    $('#dataTable').DataTable({
        responsive:true,
        autoWidth: false,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 1 },
            { responsivePriority: 200000000000, targets: -1 }
        ]
    });
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    });
});
</script>
@endsection