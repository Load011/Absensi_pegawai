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
                                    <th>Day</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shifts as $index => $shift)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @foreach ($shift->shiftDetails as $shiftDetail)
                                        {{ $shiftDetail->day_index }},
                                    @endforeach
                                    </td>
                                    <td>{{ $shift->alias }}</td>
                                    <td>
                                        <!-- Edit button -->
                                        <button 
                                            class="btn btn-flat btn-primary"
                                            data-toggle="modal" 
                                            data-target="#editModalCenter{{ $index + 1 }}"
                                        >
                                            Edit
                                        </button>

                                        <!-- Delete button -->
                                        <button 
                                            class="btn btn-flat btn-danger"
                                            data-toggle="modal" 
                                            data-target="#deleteModalCenter{{ $index + 1 }}"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModalCenter{{ $index + 1 }}" tabindex="-1" role="dialog" aria-labelledby="editModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalCenterTitle">Edit Shift</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Edit Shift Form -->
                                                <form method="POST" action="{{ route('admin.shift.update', $shift->id) }}">
                                                    @csrf
                                                    @method('PUT')

                                                    <!-- Shift Alias -->
                                                    <div class="form-group">
                                                        <label for="alias{{ $index + 1 }}">Alias</label>
                                                        <input type="text" class="form-control" id="alias{{ $index + 1 }}" name="alias" value="{{ $shift->alias }}" required>
                                                    </div>

                                                    <!-- Company ID -->
                                                    <div class="form-group">
                                                        <label for="company_id{{ $index + 1 }}">Company ID</label>
                                                        <input type="text" class="form-control" id="company_id{{ $index + 1 }}" name="company_id" value="{{ $shift->company_id }}" required>
                                                    </div>

                                                    <!-- Submit Button -->
                                                    <button type="submit" class="btn btn-primary">Update Shift</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModalCenter{{ $index + 1 }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalCenterTitle">Confirm Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this shift?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.shift.destroy', $shift->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
