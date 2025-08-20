@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Dashboard</h2>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-0 rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Total Books</h5>
                        <h3>{{ $totalBooks }}</h3>
                    </div>
                    <i class="fa-solid fa-book-open fa-2x text-primary"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-0 rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Available Books</h5>
                        <h3>{{ $availableBooks }}</h3>
                    </div>
                    <i class="fa-solid fa-check fa-2x text-success"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-0 rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Categories</h5>
                        <h3>{{ $totalCategories }}</h3>
                    </div>
                    <i class="fa-solid fa-tags fa-2x text-warning"></i>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
