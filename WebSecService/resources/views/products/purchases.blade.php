@extends('layouts.master')
@section('title', 'My Purchases')
@section('content')
<div class="row mt-2">
    <div class="col col-10">
        <h1>My Purchases</h1>
    </div>
</div>

<div class="card mt-2">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Purchase Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->product->name }}</td>
                        <td>{{ $purchase->price }}</td>
                        <td>{{ $purchase->purchased_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No purchases yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection 