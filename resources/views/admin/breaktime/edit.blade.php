@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Breaktime</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('admin.breaktime.update', $break->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="alias">Nama Jam Istirahat</label>
                            <input type="text" class="form-control" id="alias" name="alias" value="{{ $break->alias}}">
                        </div>
                        <div class="form-group">
                            <label for="period_start">Period Start</label>
                            <input type="time" class="form-control" id="period_start" name="period_start" value="{{ $break->period_start }}">
                        </div>
                        <div class="form-group">
                            <label for="end_time">End Time</label>
                            <input type="time" class="form-control" id="end_time" name="end_time" value="{{ $break->end_time }}" onchange="calculateEndMargin()">
                        </div>
                        <div class="form-group">
                            <label for="duration">Lama Istirahat</label>
                            <input type="number" class="form-control" id="duration" name="duration" value="{{ $break->duration}}">
                        </div>
                        <div class="form-group">
                            <label for="company_id">Perusahaan</label>
                            <div class="col-sm-9">
                                <select name="company_id" id="company_id" class="form-control" required>
                                    <option value="">Pilih Company</option>
                                    @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>                        
                        </div>
                        <input type="hidden" id="end_margin" name="end_margin" value="{{ $break->end_margin }}">
                        <button type="submit" class="btn btn-primary">Update Breaktime</button>
                        <a href="{{ route('admin.breaktime.index') }}" class="btn btn-secondary">Cancel</a>
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
@endsection

@push('scripts')
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
