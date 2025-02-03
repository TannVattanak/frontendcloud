@extends('layouts.master')

@section('title', 'Workout Plan')

@section('css')
    <link rel="stylesheet" href="/css/workoutplan.css">
@stop

@section('content')

    <div class="head py-5">
        <h1 class="display-5 fw-bold">Workout Plan GYMM168</h1>
        <p class="lead py-2">
            Discover the ultimate workout plan with GYMM168, your comprehensive guide to achieving fitness goals.
            Explore expert-crafted routines, nutrition advice, and motivational tips designed for both students and
            coaches. Start your transformative fitness journey today with GYMM168!
        </p>
    </div>
    @if ($workoutPlans->isEmpty())
        <p>No workout plans available.</p>
    @else
        <div class="row">
            @foreach ($workoutPlans as $workoutPlan)
                <div class="col-md-4">
                    <div class="card mb-4 bg-custom">
                        <img src="{{ asset('images/' . $workoutPlan->course_image) }}" class="card-img-top"
                            alt="{{ $workoutPlan->course_name }}" style="border-radius: 0.6rem ">

                        <div class="card-body">
                            <h5 class="card-title">{{ $workoutPlan->course_name }}</h5>
                            <p class="card-text">{{ $workoutPlan->course_description }}</p>
                            <p class="card-text"><small class="text-muted">Duration:
                                    {{ $workoutPlan->duration }}</small></p>
                            <p class="card-text"><small class="text-muted">Price: ${{ $workoutPlan->price }}</small>
                            </p>
                            <a href="{{ route('students.coursedetail', $workoutPlan->workoutplan_id) }}" class="btn">View
                                Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@stop
