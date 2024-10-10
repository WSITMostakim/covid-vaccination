@extends('layout')

@section('title', 'Vaccination Record Search')

@section('content')
    @if ($nid)
        @if (!$record)
            <div class="alert alert-warning text-center">
                <strong>Notice:</strong> You are not registered for vaccination.
                <a href="{{ route('vaccine.register') }}">Click here to register.</a>
            </div>
        @else
            <div class="alert alert-info text-center">
                @if ($record->status == 'Scheduled')
                    Your vaccination is <strong>scheduled</strong> for {{ $record->scheduled_date->format('F j, Y') }}.
                @else
                    Your vaccination status is: <strong>{{ $record->status }}</strong>.
                @endif
            </div>
        @endif
    @else
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h2 class="mb-4 text-center">Search for Your Vaccination Record</h2>
                    <p class="text-center mb-4">
                        Please enter your NID (National ID Number) below to search for your vaccination record.
                        Ensure that your NID is correctly entered before submitting.
                    </p>

                    <form class="row g-3" method="GET" action="{{ route('vaccine.search') }}">
                        @csrf
                        <div class="col-12 mb-3">
                            <label for="nid" class="form-label">National ID Number (NID)</label>
                            <input type="text" class="form-control" name="nid" id="nid"
                                value="{{ old('nid', $nid) }}" placeholder="Enter your NID" required>
                            <div class="form-text">We'll search our records using your NID to find your vaccination status.
                            </div>
                        </div>

                        <div class="col-12 d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>

                    <p class="text-muted mt-3 text-center">Ensure that the information you provide is accurate to get the
                        correct results.</p>
                </div>
            </div>
        </div>
    @endif
@endsection
