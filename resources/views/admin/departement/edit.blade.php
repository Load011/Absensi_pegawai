@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Departemen</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Halaman Utama</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Edit Departemen
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
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h5 class="text-center mt-2">Edit Departemen</h5>
                    </div>
                    @include('messages.alerts')
                    
                    <div class="card-body">
                        <form action="{{ route('admin.departement.update', ['id' => $departement->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                        
                            <div class="mb-3">
                                <label for="departemen_code" class="form-label">Departemen Code</label>
                                <input type="text" class="form-control" id="departemen_code" name="departemen_code" value="{{ $departement->dept_code }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="departemen_name" class="form-label">Departemen Name</label>
                                <input type="text" class="form-control" id="departemen_name" name="departemen_name" value="{{ $departement->dept_name }}" required>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-3">Is Default</div>
                                <div class="col-sm-9">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="is_default" name="is_default" value="1" {{ $departement->is_default ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_default">Centang jika default</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="company_id" class="col-sm-3 col-form-label">Company</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="company_id" name="company_id">
                                        <option value="">-- Select Company --</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" {{ $departement->company_id == $company->id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>                
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection
