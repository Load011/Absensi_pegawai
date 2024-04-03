@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Shift Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Shift Management</li>
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
                        <h3 class="card-title">Shift List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('admin.shift.create') }}" class="btn btn-success">Tambah Timetable</a>
                        </div>
                        @if ($shifts->isEmpty())
                        <div class="alert alert-info">
                            No shifts found.
                        </div>
                        @else
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Alias</th>
                                    <th>Hari Kerja</th>
                                    <th>Jam Masuk</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $displayedShifts = [];
                                @endphp
                                @foreach ($shifts as $index => $shift)
                                    @if (!in_array($shift->id, $displayedShifts))
                                        @php
                                            $displayedShifts[] = $shift->id;
                                        @endphp                                
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $shift->alias }}</td>
                                            <td>
                                                @foreach ($shift->shiftDetails as $shiftDetail)
                                                    {{ $shiftDetail->day_name }},
                                                @endforeach
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($shift->shiftDetails->first()->in_time)->format('H:i') }}</td>
                                            <td>
                                                <a href="{{ route('admin.shift.edit', $shift->id) }}" class="btn btn-primary">Edit</a>
                                                <form action="{{ route('admin.shift.destroy', $shift->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                                </form>
                                            </td>
                                    @endif
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
