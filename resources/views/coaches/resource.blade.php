@extends('layouts.app')

@section('title', 'Resource')

@section('css')
    <link rel="stylesheet" href="/css/resource.css">
@stop

@section('content')

<div class="container">
    <div class="header py-5">
        <h1 class="display-5 fw-bold">Articles</h1>
        <p class="lead py-2">
            Welcome to our resource hub, your go-to destination for everything fitness-related. Dive into a wealth
            of free articles curated specifically for students and coaches, covering a wide array of gym topics from
            workout routines to nutrition tips. Empower yourself with knowledge and inspiration as you embark on
            your fitness journey with us.
        </p>
    </div>
</div>

<div class="container d-flex flex-wrap">
    @foreach ($articles as $article)
        <div class="col-md-4 pb-3">
            <div class="card h-100">
                <img src="{{ asset('images/' . $article->img_cover) }}" class="img-fluid" alt="">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">{{ $article->type }}</h6>
                    <h4 class="card-title">{{ $article->title }}</h4>
                    <p class="card-text">{{ $article->subtitle }}</p>
                    <a href="{{ route('articles.show1', ['resource_id' => $article->resource_id]) }}">Read Article</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="container">
    <div class="header py-5">
        <h1 class="display-5 fw-bold">Exercises</h1>
        <p class="lead py-2">
            Explore our comprehensive guide to exercises at GYMM168. From beginner to advanced routines, discover a
            variety of workouts designed to help you achieve your fitness goals. Learn the best practices,
            techniques, and tips for each exercise, and get inspired to enhance your training regimen. Start your
            journey
            towards a stronger, healthier you with our expert advice and step-by-step guides.
        </p>
    </div>
</div>




<div class="container">
    <div class="row">
        @foreach ($exercises as $exercise)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('images/' . $exercise->img_cover) }}" class="card-img-top"
                        alt="{{ $exercise->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $exercise->title }}</h5>
                        <p class="card-text"><strong>Type:</strong> {{ $exercise->exercise_type }}</p>
                        <p class="card-text"><strong>Muscle:</strong> {{ $exercise->exercise_muscle }}</p>
                        <p class="card-text"><strong>Equipment:</strong> {{ $exercise->exercise_equipment }}</p>
                        <p class="card-text"><strong>Difficulty:</strong> {{ $exercise->exercise_difficulty }}</p>
                        <p class="card-text">{{ $exercise->exercise_description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@stop
