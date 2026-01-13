@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h3>Summed Results by LGA</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('lga.results') }}" method="GET" class="row g-3">
                <div class="col-md-8">
                    <select name="lga_id" class="form-select" required>
                        <option value="">Select an LGA</option>
                        @foreach($lgas as $lga)
                            <option value="{{ $lga->lga_id }}" {{ request('lga_id') == $lga->lga_id ? 'selected' : '' }}>
                                {{ $lga->lga_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">Show Results</button>
                </div>
            </form>
        </div>
    </div>

    @if($selectedLga)
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h4>Total Results for {{ $selectedLga->lga_name }}</h4>
                        <p class="text-muted mb-0">(Summed from all polling units in this LGA)</p>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Party Abbreviation</th>
                                    <th>Total Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($partyTotals as $total)
                                    <tr>
                                        <td>{{ $total->party_abbreviation }}</td>
                                        <td><strong>{{ number_format($total->total_score) }}</strong></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">No results found for polling units in this LGA.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Polling Units in {{ $selectedLga->lga_name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach($selectedLga->pollingUnits as $pu)
                                <a href="{{ route('polling.unit.results', $pu->uniqueid) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    {{ $pu->polling_unit_name }}
                                    <span class="badge bg-primary rounded-pill">View Results</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection