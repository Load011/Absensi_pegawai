@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Shift') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.shift.update', $shift->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="alias" class="col-md-4 col-form-label text-md-right">{{ __('Alias') }}</label>

                            <div class="col-md-6">
                                <input id="alias" type="text" class="form-control @error('alias') is-invalid @enderror" name="alias" value="{{ old('alias', $shift->alias) }}" required autofocus>

                                @error('alias')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="company_id" class="col-md-4 col-form-label text-md-right">{{ __('Company ID') }}</label>

                            <div class="col-md-6">
                                <input id="company_id" type="text" class="form-control @error('company_id') is-invalid @enderror" name="company_id" value="{{ old('company_id', $shift->company_id) }}" required>

                                @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Shift') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
