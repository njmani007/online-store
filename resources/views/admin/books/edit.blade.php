@extends('layouts.admin')
@section('title', 'Edit Book')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Book</h3>
    <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Author</label>
                <input type="text" name="author" class="form-control" value="{{ $book->author }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $book->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Price</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ $book->price }}">
            </div>
            <div class="col-6">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                @if($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" alt="Book Image" class="img-thumbnail mt-2" style="max-width: 150px;">
                @else
                    <img src="{{ asset('assets/images/default.webp') }}" alt="No Image" class="img-thumbnail mt-2" style="max-width: 150px;">
                @endif
            </div>

            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="4">{{ $book->description }}</textarea>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fa fa-edit me-1"></i> Update
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
