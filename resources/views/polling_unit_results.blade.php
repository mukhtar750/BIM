@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Results for Polling Unit: {{ $pollingUnit->polling_unit_name }}</h3>
            <p class="mb-0">ID: {{ $pollingUnit->polling_unit_number }} | LGA: {{ $pollingUnit->lga->lga_name ?? 'N/A' }}</p>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Party</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pollingUnit->results as $result)
                        <tr>
                            <td>{{ $result->party_abbreviation }}</td>
                            <td>{{ $result->party_score }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">No results found for this polling unit.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('lga.results') }}" class="btn btn-secondary">Back to LGA Results</a>
        </div>
    </div>
@endsection