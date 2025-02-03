@extends('layouts.app')

@section('title', $article->title)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/article.css') }}">
@stop

@section('content')
    <div class="container">
        <div class="head pt-5">
            <h6>{{ $article->subtitle }}</h6>
            <h1 class="display-5 fw-bold">{{ $article->title }}</h1>
            <p class="lead col-10 py-2">{{ $article->paragraph1 }}</p>
            <h6 class="pb-3"><strong>By: {{ $article->author }}</strong></h6>
            <img src="{{ asset('images/' . $article->img_cover) }}" class="img-fluid" alt="{{ $article->title }}">
        </div>
        <div class="info d-flex align-items-center">
            <div class="info-text col-6">
                <p>{{ $article->paragraph1 }}</p>
            </div>

            @if ($article->paragraph1_img)
                <div class="info-img col-md-6 ps-5">
                    <img src="{{ asset('images/' . $article->paragraph1_img) }}" class="img-fluid"
                        alt="{{ $article->title }}">
                </div>
            @endif
        </div>
        <div class="info d-flex flex-row-reverse align-items-center pt-5">
            <div class="info-text col-6">
                <p>{{ $article->paragraph2 }}</p>
            </div>

            @if ($article->paragraph2_img)
                <div class="info-img col-md-6 pe-5">
                    <img src="{{ asset('images/' . $article->paragraph2_img) }}" class="img-fluid"
                        alt="{{ $article->title }}">
                </div>
            @endif
        </div>
    </div>
@stop
