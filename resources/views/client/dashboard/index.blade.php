@extends('client.dashboard.layout')

@php
    $user = $user ?? auth()->user();
@endphp

@section('content')
    <div class="rounded-top text-white d-flex flex-row" style="background-color: gray; height:200px;">
        <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
            <img src="{{ auth()->user()->image_path }}" alt="Generic placeholder image"
                class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">
            <a href="{{ route('dashboard.edit', $user->id) }}" type="button" class="btn btn-outline-dark"
                data-mdb-ripple-color="dark" style="z-index: 1;">
                Edit profile
            </a>
        </div>
        <div class="ms-3" style="margin-top: 130px;">
            <h5>{{ $user->name }}</h5>
            <p>New York</p>
        </div>
        <a class="ms-auto d-flex flex-column d-inline-block text-decoration-none" style="width: 150px; margin: 183px 24px 0 0" href="{{ route('logout') }}">
            <button class="btn btn-outline-dark" data-mdb-ripple-color="dark" style="z-index: 1;">
                Logout
            </button>
        </a>
    </div>
    <div class="p-4 text-black" style="background-color: #f8f9fa;">
        <div class="d-flex justify-content-end text-center py-1">
            <div>
                <p class="mb-1 h5">253</p>
                <p class="small text-muted mb-0">Photos</p>
            </div>
            <div class="px-3">
                <p class="mb-1 h5">1026</p>
                <p class="small text-muted mb-0">Followers</p>
            </div>
            <div>
                <p class="mb-1 h5">478</p>
                <p class="small text-muted mb-0">Following</p>
            </div>
        </div>
    </div>
    <div class="card-body p-4 text-black">
        <div class="mb-5">
            <p class="lead fw-normal mb-1">About</p>
            <div class="p-4" style="background-color: #f8f9fa;">
                <p class="font-italic mb-1">Web Developer</p>
                <p class="font-italic mb-1">Lives in New York</p>
                <p class="font-italic mb-0">Photographer</p>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <p class="lead fw-normal mb-0">Recent photos</p>
            <p class="mb-0"><a href="#!" class="text-muted">Show all</a></p>
        </div>
        <div class="row g-2">
            <div class="col mb-2">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(112).webp" alt="image 1"
                    class="w-100 rounded-3">
            </div>
            <div class="col mb-2">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(107).webp" alt="image 1"
                    class="w-100 rounded-3">
            </div>
        </div>
        <div class="row g-2">
            <div class="col">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(108).webp" alt="image 1"
                    class="w-100 rounded-3">
            </div>
            <div class="col">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(114).webp" alt="image 1"
                    class="w-100 rounded-3">
            </div>
        </div>
    </div>
@endsection
