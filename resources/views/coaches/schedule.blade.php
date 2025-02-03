@extends('layouts.app')

@section('title', 'Schedule')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/schedule.css') }}">
@stop

@section('content')
    <div class="container mt-5">
        <div class="head">
            <h1 class="display-5 fw-bold">Schedule for {{ $student->name }}</h1>
        </div>
        <div class="row g-4">
            @foreach ($schedules as $schedule)
                <div class="col-md-4">
                    <div class="card schedule-card">
                        <img src="{{ asset('images/' . $schedule->workoutPlan->course_image) }}" class="card-img-top"
                            alt="Workout Plan Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $schedule->workoutPlan->course_name }}</h5>
                            <p class="card-text">Date: {{ $schedule->workoutPlan->schedule }}</p>
                            <p class="card-text">Coach: {{ $schedule->workoutPlan->user->name }}</p>
                            <p class="card-text">Room: {{ $schedule->room_name }}</p>
                            <p class="card-text">Duration: {{ $schedule->workoutPlan->duration }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXlG0OTa1zfsydMEhfp2rRJbrb6y10L2euc3ISoQ/r+Dz5D7Q1THxRMfZTBr" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWrJqqIh8IHqxgK4U8GCKPeINq8K/IT7aKhp72MoG/UtP8+91n5/c3vbD8" crossorigin="anonymous">
    </script>
@stop
