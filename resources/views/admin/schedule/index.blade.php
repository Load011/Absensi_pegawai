@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Schedule Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Schedule Management</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Schedule List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if ($schedules->isEmpty())
                        <div class="alert alert-info">
                            No schedules found.
                        </div>
                        @else
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Employee</th>
                                    <th>Shift</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $index => $schedule)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->start_date)->format('Y-m-d') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->end_date)->format('Y-m-d') }}</td>
                                    <td>{{ $schedule->employees->first_name }} {{ $schedule->employees->last_name }}</td>
                                    <td>{{ $schedule->shift->alias }}</td>
                                    <td>
                                        <button 
                                            class="btn btn-flat btn-danger"
                                            data-toggle="modal" 
                                            data-target="#deleteModalCenter{{ $index + 1 }}"
                                        >
                                            Hapus
                                        </button>
                                        <button 
                                            class="btn btn-flat btn-primary"
                                            data-toggle="modal" 
                                            data-target="#editModalCenter{{ $index + 1 }}"
                                        >
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
