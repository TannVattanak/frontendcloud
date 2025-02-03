@extends('layouts.app')

@section('title', 'Profile')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
@stop

@section('content')
    <!-- Profile Section -->
    <div class="container">
        <div class="my-5">
            <div class="profile-card card shadow p-4">
                <div class="d-flex justify-content-center">
                    <div class="d-flex justify-content-center">
                        <div class="userimg mb-3"
                            style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                            <img src="{{ Auth::user()->image ? asset('uploads/' . Auth::user()->image) : asset('images/default-profile.png') }}"
                                alt="User Image" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>
                </div>
                <div class="usertitle text-center">
                    <h1>{{ Auth::user()->name }}</h1>
                    <h6>{{ Auth::user()->role }}</h6>
                </div>
            </div>

            <div class="general-info">
                <h3>General Information</h3>
                <div class="userdetail pt-3">
                    <p><strong>Coach ID:</strong> {{ Auth::user()->id }}</p>
                    <p><strong>Full Name:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Gender:</strong> {{ Auth::user()->gender }}</p>
                    <p><strong>Contact Number:</strong> {{ Auth::user()->telephone }}</p>
                    <p class="pb-2"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('profile.editForcoach') }}" class="btn btn-primary">Update Profile</a>
                    <form method="POST" action="{{ route('profile.logoutForcoach') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Profile Section -->
@stop
