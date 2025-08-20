@extends('layouts.admin')
@section('title', 'Add Category')

@section('content')
<div class="container">
    <h3 class="mb-4">Add Category</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter category name" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success mt-3">
                    <i class="fa fa-plus me-1"></i> Add Category
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
