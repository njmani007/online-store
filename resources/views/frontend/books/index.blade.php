@extends('layouts.frontend')
@section('title', 'Books')

@section('content')
<section class="py-5">
    <div class="container">
        <h2 class="mb-4 text-center fw-bold">Our Books</h2>

        <div class="row mb-4">
            <div class="col-md-6 offset-md-3">
                <form action="{{ route('books.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="form-control me-2"
                           placeholder="Search by title, author, or category">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>

        @if($books->count())
            <div class="row g-4">
                @foreach($books as $book)
                    <div class="col-md-3">
                        <div class="card shadow-sm h-100">
                            <!-- Book Image -->
                            <div class="position-relative">
                                @if($book->image)
                                    <img src="{{ asset('storage/' . $book->image) }}"
                                         class="card-img-top"
                                         alt="{{ $book->title }}"
                                         style="height: 250px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/images/default.webp') }}"
                                         class="card-img-top"
                                         alt="No Image"
                                         style="height: 250px; object-fit: cover;">
                                @endif

                                @if($book->category)
                                    <span class="badge bg-primary position-absolute"
                                          style="top: 10px; left: 10px;">
                                        {{ $book->category->name }}
                                    </span>
                                @endif
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text mb-1 text-truncate">
                                    <strong>Author:</strong> {{ $book->author }}
                                </p>
                                <p class="card-text mb-2">
                                    <strong>Price:</strong> ₹{{ number_format($book->price, 2) }}
                                </p>
                                <p class="mb-2">
                                    @if($book->is_available)
                                        <span class="badge bg-success">Available</span>
                                    @else
                                        <span class="badge bg-secondary">Unavailable</span>
                                    @endif
                                </p>
                                <a href="{{ route('books.show', $book->id) }}"
                                   class="btn btn-primary btn-sm mt-auto shadow-sm">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $books->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="text-center py-5">
                <h5>No books available at the moment.</h5>
                <a href="{{ route('home') }}" class="btn btn-outline-primary mt-3">
                    Back to Home
                </a>
            </div>
        @endif
    </div>
</section>
@endsection
