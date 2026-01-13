@extends('layouts.app')

@section('content')
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Bincom Election Results Portal</h1>
            <p class="col-md-8 fs-4">Welcome to the 2011 Election Results system for Delta State. Use the links below to access different features.</p>
            <hr class="my-4">
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="{{ route('lga.results') }}" class="btn btn-primary btn-lg px-4 me-md-2">View LGA Results</a>
                <a href="{{ route('results.create') }}" class="btn btn-outline-secondary btn-lg px-4">Add New Results</a>
            </div>
        </div>
    </div>

    <div class="row align-items-md-stretch">
        <div class="col-md-6">
            <div class="h-100 p-5 text-white bg-dark rounded-3">
                <h2>Polling Unit Results</h2>
                <p>To view results for a specific polling unit, you can navigate through the LGA results or access a specific unit directly if you have its ID.</p>
                <p>Example: <a href="{{ route('polling.unit.results', 8) }}" class="text-info">View Polling Unit 8</a></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="h-100 p-5 bg-light border rounded-3">
                <h2>Test Requirements</h2>
                <ul>
                    <li><strong>Question 1:</strong> Individual Polling Unit results page.</li>
                    <li><strong>Question 2:</strong> Summed results for all polling units in a selected LGA.</li>
                    <li><strong>Question 3:</strong> Interface to store results for all parties for a new polling unit.</li>
                </ul>
            </div>
        </div>
    </div>
@endsection