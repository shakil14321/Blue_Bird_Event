@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header">
    <h5 class="mb-0">Add Sub Category</h5>
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('subcategories.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label for="category_id" class="form-label">Parent Category</label>
        <select name="category_id" id="category_id" class="form-control" required>
          <option value="">-- Select Category --</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="name" class="form-label">Sub Category Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description </label>
        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
      </div>

      <button type="submit" class="btn btn-primary">Create</button>
      <a href="{{ route('subcategories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</div>
@endsection
