@extends('layouts.master')

@section('title', 'Course Detail')

@section('css')
    <link rel="stylesheet" href="/css/course-detail.css">
@stop

@section('content')
    <div class="d-flex justify-content-center py-5">
        <img src="{{ asset('images/' . $workoutPlan->course_image) }}" class="img-sm col-5"
            alt="{{ $workoutPlan->course_name }}">
        <div class="detail col-5 ps-4">
            <h6>Course type : {{ $workoutPlan->course_type }}</h6>
            <h6>Course name : {{ $workoutPlan->course_name }}</h6>
            <p>Course Description : {{ $workoutPlan->course_description }}</p>
            <h6>Coach : {{ $workoutPlan->user->name }}</h6>
            <h6>Schedule: {{ $workoutPlan->schedule }}</h6>
            <h6>Duration: {{ $workoutPlan->duration }}</h6>
            <h6>Requirement: {{ $workoutPlan->requirement }}</h6>
            <h6><strong>Price: ${{ $workoutPlan->price }}</strong></h6>
            <div class="option d-flex flex-row justify-content-center">
                <a href="{{ route('students.workoutplan') }}" type="button" class="btn btn-danger mx-2">Back to Menu</a>
                <a href="{{ route('students.payment') }}" type="button" class="btn btn-success mx-2">Enroll</a>
            </div>
        </div>
    </div>


@stop
