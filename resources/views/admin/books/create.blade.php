@extends('layouts.admin')
@section('title', 'Add Book')

@section('content')
<div class="container">
    <h3 class="mb-4">Add Book</h3>
    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Author</label>
                <input type="text" name="author" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Price</label>
                <input type="number" step="0.01" name="price" class="form-control">
            </div>
            <div class="col-6">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="4"></textarea>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-success mt-3">
                    <i class="fa fa-save me-1"></i> Save
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
