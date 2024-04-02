@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Data Karyawan</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}">Dashboard Admin</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Edit Data Karyawan
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data Karyawan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('admin.employees.update', $employee->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="first_name">First Name:</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $employee->first_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Nama Belakang:</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $employee->last_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="department">Department:</label>
                                    <input type="text" class="form-control" id="department" name="department" value="{{ $employee->department }}">
                                </div>
                                <div class="form-group">
                                    <label for="position">Jabatan:</label>
                                    <input type="text" class="form-control" id="position" name="position" value="{{ $employee->position }}">
                                </div>
                                <div class="form-group">
                                    <label for="hire_date">Tanggal Bergabung:</label>
                                    <input type="date" class="form-control" id="hire_date" name="hire_date" value="{{ $employee->hire_date }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
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
