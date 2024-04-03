@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Schedule</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.shift.update', $shift->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Shift Alias -->
                        <div class="form-group">
                            <label for="alias">Alias</label>
                            <input type="text" class="form-control" id="alias" name="alias" value="{{ $shift->alias }}" required>
                        </div>

                        <!-- Company ID -->
                        <div class="form-group">
                            <label for="company_id">Company ID</label>
                            <input type="text" class="form-control" id="company_id" name="company_id" value="{{ $shift->company_id }}" required>
                        </div>

                        <!-- Day Index -->
                        <div class="form-group">
                            <label for="day_index">Day Index</label>
                            <input type="number" class="form-control" id="day_index" name="day_index" value="{{ $shiftDetail->day_index }}" required>
                        </div>

                        <!-- Timetable -->
                        <div class="form-group">
                            <label for="timetable_id">Timetable</label>
                            <select class="form-control" id="timetable_id" name="timetable_id" required>
                                @foreach ($timetables as $timetable)
                                    <option value="{{ $timetable->id }}" {{ $timetable->id == $shiftDetail->timetable_id ? 'selected' : '' }}>{{ $timetable->alias }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Update Schedule</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
