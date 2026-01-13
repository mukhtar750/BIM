@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Add New Polling Unit Results</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('results.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="polling_unit_uniqueid" class="form-label">Select Polling Unit</label>
                    <select name="polling_unit_uniqueid" id="polling_unit_uniqueid" class="form-select" required>
                        <option value="">-- Select Polling Unit --</option>
                        @foreach($pollingUnits as $pu)
                            <option value="{{ $pu->uniqueid }}">{{ $pu->polling_unit_name }} ({{ $pu->polling_unit_number }})</option>
                        @endforeach
                    </select>
                    @error('polling_unit_uniqueid')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <h5>Enter Party Scores</h5>
                <hr>
                <div class="row">
                    @foreach($parties as $party)
                        <div class="col-md-4 mb-3">
                            <label for="party_{{ $party->partyid }}" class="form-label">{{ $party->partyname }} ({{ $party->partyid }})</label>
                            <input type="number" name="results[{{ $party->partyid }}]" id="party_{{ $party->partyid }}" class="form-control" value="0" min="0" required>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success btn-lg">Store Results</button>
                    <a href="/" class="btn btn-link">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection