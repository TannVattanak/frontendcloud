@extends('layouts.app')

@section('title', 'Home')

@section('css')
    <link rel="stylesheet" href="/css/indexcoach.css">
@stop

@section('content')

    <div class="container">
        <div class="head py-5">
            <h1 class="display-5 fw-bold">Welcome to Gymm168, {{ Auth::user()->name }}</h1>
            <p class="lead col-7 py-2">Whether you're into bodybuilding, power lifting, strength training or just
                getting started, these workouts and tips will help you reach your goals.</p>
        </div>
        <h1 class="display-5 fw-bold text-center pt-3 pb-5"> Schedule for you</h1>
        <div class="list-group">
            @foreach (Auth::user()->students as $student)
                <div class="list-group-item mb-3" style="background-color: #D9D9D9;">
                    <div class="d-flex align-items-center">
                        <img src="{{asset('uploads/' . $student->image)}}" alt="" class="me-3"
                            style="width: 80px; height: 80px;">
                        <h3 class="m-0">{{ $student->name }}</h3>
                        <div class="ms-auto">
                            <a href="{{ route('coaches.schedule', $student->id) }}" class="btn btn-success">view</a>
                            <a href="{{ route('delete_student', $student->id) }}" class="btn btn-danger me-2">delete</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop