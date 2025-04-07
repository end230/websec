@extends('layouts.master')
@section('title', 'User Credit')
@section('content')
<div class="row mt-2">
    <div class="col col-10">
        <h1>Manage Credits for {{ $user->name }}</h1>
    </div>
</div>

<div class="card mt-2">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5>User Details</h5>
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Current Credits:</strong> {{ $user->credit ?? 0 }}</p>
            </div>
            <div class="col-md-6">
                <h5>Add Credits</h5>
                <form action="{{ route('add_credit', $user->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount to Add</label>
                        <input type="number" class="form-control" id="amount" name="amount" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Credits</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection