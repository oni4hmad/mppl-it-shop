@extends('layouts.main')

@section('content')

  <style>
    /* background register */
    body {
      background: #E7F0F7;
    }
  </style>

  <div class="container">
    <div class="row py-4" style="min-height: 100vh;">
      <div class="col">
        <div class="d-flex flex-column justify-content-center align-items-center h-100">
          <h1 class="fw-bold text-primary" style="font-size: 10rem;">404</h1>
          <p class="mb-2 fw-bold fs-5">Page not found.</p>
          <p class="fw-bold fs-6 text-secondary text-center">This page you are looking for doesn't exists.<br><a href="{{ url()->previous() }}">Go back</a>, or head over to our customer service to ask for assistance.</p>
        </div>
      </div>
    </div>
  </div>

@endsection




