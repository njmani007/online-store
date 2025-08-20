@extends('layouts.frontend')
@section('title', $book->title)

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    @if($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}"
                             class="card-img-top"
                             alt="{{ $book->title }}"
                             style="height: 400px; object-fit: cover;">
                    @else
                        <img src="{{ asset('assets/images/default.webp') }}"
                             class="card-img-top"
                             alt="No Image"
                             style="height: 400px; object-fit: cover;">
                    @endif
                    @if($book->category)
                        <span class="badge bg-primary position-absolute"
                              style="top: 10px; left: 10px; z-index: 10;">
                            {{ $book->category->name }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-md-8">
                <h2 class="fw-bold">{{ $book->title }}</h2>
                <p class="text-muted mb-2"><strong>Author:</strong> {{ $book->author }}</p>
                <p class="mb-2">
                    <strong>Price:</strong> ₹{{ number_format($book->price, 2) }}
                </p>
                <p class="mb-3">
                    <strong>Availability:</strong>
                    @if($book->is_available)
                        <span class="badge bg-success">Available</span>
                    @else
                        <span class="badge bg-secondary">Unavailable</span>
                    @endif
                </p>

                <h5 class="mt-4">Description</h5>
                <p>{{ $book->description ?? 'No description available.' }}</p>

                <a href="{{ route('books.index') }}" class="btn btn-outline-primary mt-3">
                    <i class="fa fa-arrow-left me-1"></i> Back to Books
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
