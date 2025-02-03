@extends('layouts.master')

@section('title', 'Home')

@section('css')

    <link rel="stylesheet" href="/css/index.css">

@stop

@section('content')


    <div class="head py-5">
        <h1 class="display-5 fw-bold">Welcome to Gymm168, {{ $user->name }}</h1>
        <p class="lead col-6 py-2">Whether you're into bodybuilding, power lifting, strength training or just
            getting started, these workouts and tips will help you reach your goals.</p>
    </div>
    <h1 class="display-5 fw-bold text-center pt-3 pb-5"> Schedule for you</h1>
    <div class="d-flex flex-wrap justify-content-center">
        <div class="d-flex flex-wrap justify-content-center">
            @foreach ($schedules as $schedule)
                <div class="col-md-5 mx-3 pb-3">
                    <div class="schedule">
                        <img src="{{ asset('images/' . $schedule->workoutPlan->course_image) }}"
                            class="card-img-top px-2 pt-2" alt="{{ $schedule->workoutPlan->course_image }}"
                            style="border-radius: 0.6rem ">
                        <p class="my-2 ps-3">Activity Name: {{ $schedule->workoutPlan->course_name }}</p>
                        <p class="my-2 ps-3">Course Type: {{ $schedule->workoutPlan->course_type }}</p>
                        <p class="my-2 ps-3">Schedule: {{ $schedule->workoutPlan->schedule }}</p>
                        <p class="my-2 ps-3">Duration: {{ $schedule->workoutPlan->duration }}</p>
                        <p class="my-2 ps-3">Requirement: {{ $schedule->workoutPlan->requirement }}</p>
                        <p class="my-2 ps-3">Description: {{ $schedule->workoutPlan->course_description }}</p>
                        <p class="my-2 ps-3">Room: {{ $schedule->room_name }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


@stop
