@extends('layouts.app')
@section('title', 'Report')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/report.css') }}">
@stop

@section('content')
    <div class="container">
        <div class="head py-5">
            <h1 class="display-5 fw-bold">Report</h1>
            <p class="lead py-2">A coach's report is vital for a student's progress. Whether it's bodybuilding, powerlifting, strength training, or beginning a new fitness journey, these insights and evaluations will help students reach their goals efficiently.</p>
        </div>
        <form class="card col-7 mx-auto" method="POST" action="{{ route('progress.store') }}">
            @csrf
            <h2 class="fw-bold text-center pb-3 pt-5">Submission Form</h2>
            <div class="row d-flex justify-content-center pb-3">
                <div class="col-4">
                    <label for="studentId">Student ID</label>
                    <input type="text" class="form-control @error('student_id') is-invalid @enderror" id="studentId" name="student_id" placeholder="e.g., 16" required>
                    @error('student_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="caloriesBurnt">Calories Burnt</label>
                    <input type="text" class="form-control @error('calories_burnt') is-invalid @enderror" id="caloriesBurnt" name="calories_burnt" placeholder="e.g., 500" required>
                    @error('calories_burnt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row d-flex justify-content-center pb-3">
                <div class="col-4">
                    <label for="duration">Duration (as minute)</label>
                    <input type="text" class="form-control @error('workout_duration') is-invalid @enderror" id="duration" name="workout_duration" placeholder="e.g., 90" required>
                    @error('workout_duration')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="workoutSets">Workout Sets</label>
                    <input type="text" class="form-control @error('workout_sets') is-invalid @enderror" id="workoutSets" name="workout_sets" placeholder="e.g., 4 sets" required>
                    @error('workout_sets')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row d-flex justify-content-center pb-3">
                <div class="col-4">
                    <label for="status">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="Done">Done</option>
                        <option value="Rest Day">Rest Day</option>
                        <option value="Skip Day">Skip Day</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="date">Date</label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" required>
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row d-flex justify-content-center pb-3">
                <button type="submit" name="submit" class="col-3 btn">Submit</button>
            </div>
        </form>
    </div>
@stop