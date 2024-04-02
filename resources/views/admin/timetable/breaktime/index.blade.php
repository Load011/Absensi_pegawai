@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Jadwal Istirahat</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}">Dashboard Admin</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Jadwal Istirahat
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @include('messages.alerts')
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title text-center">
                                Jam Istirahat
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($break->count() > 0)
                                <table class="table table-bordered table-hover" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Alias</th>
                                            <th>Jam Mulai</th>
                                            <th>Lama Waktu</th>
                                            <th>End Margin</th>
                                            <th>Company ID</th>
                                            <th> Aksi </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($break as $index => $breaktime)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $breaktime->alias }}</td>
                                                <td>{{ $breaktime->period_start }}</td>
                                                <td>{{ $breaktime->duration }}</td>
                                                <td>{{ $breaktime->end_margin }}</td>
                                                <td>{{ $breaktime->company_id }}</td>
                                                <td>
                                                    <button 
                                                        class="btn btn-flat btn-danger"
                                                        data-toggle="modal" 
                                                        data-target="#deleteModalCenter{{ $index + 1 }}"
                                                    >
                                                        Hapus
                                                    </button>
                                                    <button 
                                                        class="btn btn-flat btn-primary"
                                                        data-toggle="modal" 
                                                        data-target="#editModalCenter{{ $index + 1 }}"
                                                    >
                                                        Edit
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @foreach ($break as $index => $breaktime)
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModalCenter{{ $index + 1 }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle1{{ $index + 1 }}" aria-hidden="true">
                                        <!-- Modal Content -->
                                    </div>
                                @endforeach
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
@endsection
