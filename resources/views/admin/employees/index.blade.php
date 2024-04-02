@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Daftar Karyawan</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}">Dashboard Admin</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Daftar Karyawan
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
            @include('messages.alerts')
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title text-center">
                                Karyawan
                            </div>
                            
                        </div>
                        <div class="card-body">
                            @if ($personnel_employee->count())
                            <table class="table table-bordered table-hover" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Department</th>
                                        <th>Jabatan</th>
                                        <th>Tanggal Bergabung</th>
                                        <th> Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($personnel_employee as $index => $employee)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $employee->first_name}} {{ $employee->last_name}}</td>
                                        <td>{{ $employee->dept_name}}</td>
                                        <td>{{ $employee->position_name }}</td>                             
                                        <td>{{ \Carbon\Carbon::parse($employee->hire_date)->format('d-m-Y') }}</td>
                                        <td>
                                            <button 
                                            class="btn btn-flat btn-danger"
                                            data-toggle="modal" 
                                            data-target="#deleteModalCenter{{ $index + 1 }}"
                                            >Hapus</button>
                                            <button 
                                            class="btn btn-flat btn-primary"
                                            data-toggle="modal" 
                                            data-target="#editModalCenter{{ $index + 1 }}"
                                            >Edit</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @for ($i = 1; $i < $personnel_employee->count()+1; $i++)
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModalCenter{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle1{{ $i }}" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="card card-danger">
                                                <div class="card-header">
                                                    <h5 style="text-align: center !important">Yakin ingin dihapus?</h5>
                                                </div>
                                                <div class="card-body text-center d-flex" style="justify-content: center">
                                                    
                                                    <button type="button" class="btn flat btn-secondary" data-dismiss="modal">Tidak</button>
                                                    
                                                    <form 
                                                    action="{{ route('admin.employees.delete', $personnel_employee->get($i-1)->id) }}"
                                                    method="POST"
                                                    >
                                                    @csrf
                                                    @method('DELETE')
                                                        <button type="submit" class="btn flat btn-danger ml-1">Ya</button>
                                                    </form>
                                                </div>
                                                <div class="card-footer text-center">
                                                    <small>Aksi ini tidak bisa dilakukan</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
                            @endfor
                            @else
                            <div class="alert alert-info text-center" style="width:50%; margin: 0 auto">
                                <h4>Tidak Ada Data</h4>
                            </div>
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

    <!-- Edit Modals -->
    @foreach ($personnel_employee as $index => $employee)
    <div class="modal fade" id="editModalCenter{{ $index + 1 }}" tabindex="-1" role="dialog" aria-labelledby="editModalCenterTitle{{ $index + 1 }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalCenterTitle{{ $index + 1 }}">Edit Data Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form to edit employee data -->
                    <form action="{{ route('admin.employees.update', $employee->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nama Depan:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $employee->first_name }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Nama Belakang:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $employee->last_name }}">
                        </div>
                        <div class="form-group">
                            <label for="department">Department:</label>
                            <select class="form-control" id="department" name="department">
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ $department->id == $employee->department_id ? 'selected' : '' }}>
                                        {{ $department->dept_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="position">Jabatan:</label>
                            <select class="form-control" id="position" name="position">
                                @foreach($positions as $position)
                                    <option value="{{ $position->id }}" {{ $position->id == $employee->position_id ? 'selected' : '' }}>
                                        {{ $position->position_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hire_date">Tanggal Bergabung:</label>
                            <input type="date" class="form-control" id="hire_date" name="hire_date" value="{{ $employee->hire_date }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- /.Edit Modals -->
@endsection
