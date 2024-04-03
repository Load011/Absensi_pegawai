@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Jam Istirahat</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Halaman Utama</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Tambah Jam Istirahat
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
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Tambah Jam Istirahat
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.breaktime.store') }}" method="POST" class="p-3">
                            @csrf
                            <div class="form-group">
                                <label for="alias">Nama Jam Istirahat</label>
                                <input type="text" class="form-control" id="alias" name="alias" value="{{ old('alias') ?? ''}}">
                            </div>
                            <div class="form-group">
                                <label for="period_start">Period Start</label>
                                <input type="time" class="form-control" id="period_start" name="period_start" value="{{ old('period_start') ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="end_time">End Time</label>
                                <input type="time" class="form-control" id="end_time" name="end_time" value="{{ old('end_time') ?? '' }}" onchange="calculateEndMargin()">
                            </div>
                            <div class="form-group">
                                <label for="duration">Lama Istirahat</label>
                                <input type="number" class="form-control" id="duration" name="duration" value="{{ old('duration') ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="company_id">Perusahaan</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="company_id" name="company_id">
                                        <option value="">-- Select Company --</option>
                                        @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ (old('company_id') == $company->id) ? 'selected' : '' }}>
                                            {{ $company->company_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>                        
                            </div>
                            <button type="submit" class="btn btn-primary">Create Timetable</button>
                        </form>
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

@push('script')
<script>
    function calculateEndMargin() {
        // Get the values of end_time and period_start
        var endTime = document.getElementById('end_time').value;
        var periodStart = document.getElementById('period_start').value;

        // Convert the values to Date objects
        var endTimeDate = new Date('1970-01-01T' + endTime + ':00');
        var periodStartDate = new Date('1970-01-01T' + periodStart + ':00');

        // Calculate the difference in minutes
        var diffInMinutes = Math.floor((endTimeDate - periodStartDate) / 60000);

        // Update the value of end_margin input
        document.getElementById('end_margin').value = diffInMinutes;
    }
</script>
@endpush