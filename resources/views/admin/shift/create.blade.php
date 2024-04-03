@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New Shift</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.shift.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="alias">Alias:</label>
                                <input type="text" class="form-control" id="alias" name="alias" value="{{ old('alias') }}" required>
                            </div>

                            <div class="form-group">
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

                            <div class="form-group">
                                <label for="day_index">Select Day(s)</label>
                                <select name="day_index[]" id="day_index" class="form-control" multiple>
                                    <option value="0">Sunday</option>
                                    <option value="1">Monday</option>
                                    <option value="2">Tuesday</option>
                                    <option value="3">Wednesday</option>
                                    <option value="4">Thursday</option>
                                    <option value="5">Friday</option>
                                    <option value="6">Saturday</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="shift_id">Shift ID:</label>
                                <select class="form-control" id="shift_id" name="shift_id" required>
                                    <option value="">Select Shift</option>
                                    @foreach ($shifts as $shift)
                                        <option value="{{ $shift->id }}">{{ $shift->alias }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="time_interval_id">Time Interval ID:</label>
                                <select class="form-control" id="time_interval_id" name="time_interval_id" required>
                                    <option value="">Select Time Interval</option>
                                    @foreach ($timeIntervals as $timeInterval)
                                        <option value="{{ $timeInterval->id }}">{{ $timeInterval->in_time }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Shift</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
