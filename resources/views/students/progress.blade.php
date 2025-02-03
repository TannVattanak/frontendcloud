@extends('layouts/master')

@section('title', 'Progress')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@stop

@section('content')
    <div class="head pb-3 pt-5">
        <h1 class="display-5 fw-bold">Progress Archive</h1>
    </div>
    <div class="datas d-flex">
        <div class="Workout col-3">
            <i class="fa-solid fa-medal"></i>
            <h1>{{ $totalWorkouts }}</h1>
            <p>WORKOUT</p>
        </div>
        <div class="KCAL col-3">
            <i class="fa-solid fa-fire"></i>
            <h1>{{ $totalKcal }}</h1>
            <p>KCAL</p>
        </div>
        <div class="Time col-3">
            <i class="fa-solid fa-clock"></i>
            <h1>{{ floor($totalTime / 60) }}h {{ $totalTime % 60 }}mn</h1>
            <p>TIME</p>
        </div>
    </div>
    <div class="head pb-3 pt-4 d-flex align-items-center">
        <h1 class="display-5 fw-bold">Recent Workout</h1>
        <button type="button" class="ms-auto btn btn-danger" data-bs-toggle="modal" data-bs-target="#allRecordsModal">
            All records
        </button>
    </div>
    <div class="calendar d-flex bg-custom">
        @foreach ($progresses as $progress)
            <div class="day col">
                <h6>{{ \Carbon\Carbon::parse($progress->created_at)->format('l') }}</h6>
                <h5>{{ \Carbon\Carbon::parse($progress->created_at)->format('j') }}</h5>
                <p>{{ $progress->status }}</p>
            </div>
        @endforeach
    </div>
    <div class="BMI">
        <!-- Additional BMI or other health metrics can be added here -->
    </div>

    <div class="modal fade" id="allRecordsModal" tabindex="-1" aria-labelledby="allRecordsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="allRecordsModalLabel">All Records</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Day</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allProgresses as $progress)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($progress->created_at)->format('Y-m-d') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($progress->created_at)->format('l') }}</td>
                                        <td>{{ $progress->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- {{ $allProgresses->links() }} <!-- Pagination links --> --}}
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop
