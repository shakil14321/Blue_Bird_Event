@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header">
    <h5 class="mb-0">User Details</h5>
  </div>
  <div class="card-body">
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Phone:</strong> {{ $user->phone }}</p>
    <p><strong>Role:</strong> {{ $user->role }}</p>
    <p>
      <strong>Status:</strong>
      @if($user->status)
        <span class="badge bg-success">Active</span>
      @else
        <span class="badge bg-danger">Inactive</span>
      @endif
    </p>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
  </div>
</div>
@endsection
