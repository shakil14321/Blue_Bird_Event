@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">All Sub Categories</h5>
    <a href="{{ route('subcategories.create') }}" class="btn btn-primary">Add Sub Category</a>
  </div>
  <div class="card-body">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($subcategories->count())
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Category</th>
              <th>Name</th>
              <th>Description</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($subcategories as $sub)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sub->category->name }}</td>
                <td>{{ $sub->name }}</td>
                <td>{{ $sub->description }}</td>
                <td>
                  <form action="{{ route('subcategories.destroy', $sub) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this subcategory?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <p class="text-muted">No subcategories found.</p>
    @endif
  </div>
</div>
@endsection
