@extends('layouts.master')

@section('title', 'Update Profile')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
@stop

@section('content')

    <div class="container my-5">
        <div class="profile-card card shadow p-4">
            <div class="userimg" onclick="document.getElementById('image').click()">
                <img id="profileImage" src="{{ Auth::user()->image ? asset('uploads/' . Auth::user()->image) : asset('images/default-profile.png') }}" alt="User Image">
            </div>
            <div class="usertitle text-center mt-3">
                <h1>{{ Auth::user()->name }}</h1>
                <h6>{{ Auth::user()->role }}</h6>
            </div>
        </div>

        <div class="general-info">
            <h3>Update Information</h3>
            <form method="POST" action="{{ route('profile.updateForstudent') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="Male" {{ old('gender', Auth::user()->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', Auth::user()->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="telephone" class="form-label">Contact Number</label>
                    <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', Auth::user()->telephone) }}" required>
                </div>
                <input type="file" id="image" name="image" class="file-input" onchange="loadImage(event)" style="display: none;">
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function loadImage(event) {
            var image = document.getElementById('profileImage');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.onload = function() {
                URL.revokeObjectURL(image.src);
            }
        }
    </script>

@stop

