@extends('layouts.frontend')
@section('title', 'Home')

@section('content')

    <section class="bg-primary text-white py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">Discover Your Next Great Read</h1>
            <p class="lead mb-4">Explore our collection of books across all genres. Read, enjoy, and expand your
                imagination.</p>
            <a href="{{ route('books.index') }}" class="btn btn-light btn-lg shadow-sm">Browse Books</a>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h2 class="mb-4 text-center">Categories</h2>
            @if ($categories->count() > 0)
                <div class="row g-3 justify-content-center">
                    @foreach ($categories as $category)
                        <div class="col-6 col-md-2">
                            <div class="card text-center shadow-sm h-100 p-3 hover-shadow">
                                <a href="{{ route('books.index', ['category' => $category->id]) }}"
                                    class="stretched-link text-decoration-none text-dark">
                                    <h6 class="fw-bold">{{ $category->name }}</h6>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-4">
                    <p class="text-muted mb-0">No categories available at the moment.</p>
                </div>
            @endif
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="mb-4 text-center">Latest Books</h2>
            @if ($latestBooks->count() > 0)
                <div class="row g-4">
                    @foreach ($latestBooks as $book)
                        <div class="col-6 col-md-3">
                            <div class="card shadow-sm h-100">
                                @if ($book->image)
                                    <img src="{{ asset('storage/' . $book->image) }}" class="card-img-top"
                                        alt="{{ $book->title }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/images/default.webp') }}" class="card-img-top" alt="No Image"
                                        style="height: 200px; object-fit: cover;">
                                @endif

                                <div class="card-body d-flex flex-column">

                                    @if ($book->category)
                                        <span class="badge bg-primary position-absolute"
                                            style="top: 10px; left: 10px; z-index: 10;">
                                            {{ $book->category->name }}
                                        </span>
                                    @endif

                                    <h5 class="card-title">{{ $book->title }}</h5>
                                    <p class="text-muted mb-3"><small>by {{ $book->author }}</small></p>

                                    <a href="{{ route('books.show', $book->id) }}"
                                        class="btn btn-primary btn-sm mt-auto shadow-sm">View Details</a>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-4">
                    <p class="text-muted mb-0">No books available at the moment.</p>
                </div>
            @endif
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="mb-4 text-center">Search Google Books</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group mb-4">
                        <input type="text" id="book-search" class="form-control"
                            placeholder="Type book title or author name">
                        <button class="btn btn-primary" id="search-btn">Search</button>
                    </div>
                </div>
            </div>

            <div id="books-results" class="row g-4">

            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container text-center">
            <h2 class="mb-3">Why Choose Us?</h2>
            <p class="lead mb-4">We provide a wide variety of books for every reader. Enjoy fast delivery, curated
                collections, and excellent customer service.</p>
            <div class="row justify-content-center g-4">
                <div class="col-md-3">
                    <div class="card shadow-sm p-3 hover-shadow h-100">
                        <i class="fa fa-truck fa-2x mb-2 text-primary"></i>
                        <h5>Fast Delivery</h5>
                        <p class="text-muted small">Get your books delivered quickly and reliably.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm p-3 hover-shadow h-100">
                        <i class="fa fa-book fa-2x mb-2 text-primary"></i>
                        <h5>Collections</h5>
                        <p class="text-muted small">Hand-picked books for all genres and readers.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm p-3 hover-shadow h-100">
                        <i class="fa fa-headset fa-2x mb-2 text-primary"></i>
                        <h5>Support</h5>
                        <p class="text-muted small">Friendly and responsive customer service.</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('books.index') }}" class="btn btn-primary btn-lg mt-4 shadow-sm">Start Exploring</a>
        </div>
    </section>

    <style>
        .hover-shadow:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
        }
    </style>

@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            $('#search-btn').click(function() {
                var query = $('#book-search').val().trim();
                $('#books-results').html('');

                if (query.length === 0) {
                    $('#books-results').html('<p class="text-center text-muted">Please enter a search.</p>');
                    return;
                }

                $.ajax({
                    url: '{{ route('books.google-search') }}',
                    type: 'GET',
                    data: {
                        query: query
                    },
                    success: function(response) {
                        if (!response.status || response.data.length === 0) {
                            $('#books-results').html(
                                `<p class="text-center">${response.message || 'No books found.'}</p>`
                            );
                            return;
                        }

                        let html = '';
                        $.each(response.data, function(index, book) {
                            let img = book.image || '/assets/images/default.webp';
                            let authors = book.authors?.join(', ') || 'Unknown author';
                            let description = book.description ||
                                'No description available';

                            let infoLink = book.infoLink || '#';

                            html += `
                        <div class="col-md-4">
                            <div class="card shadow-sm h-100">
                                <img src="${img}" class="card-img-top" alt="${book.title}" style="height:300px; object-fit:cover;">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">${book.title}</h5>
                                    <p class="card-text">${authors}</p>
                                    <p class="card-text text-truncate">${description}</p>
                                    <a href="${infoLink}" class="btn btn-primary mt-auto">View More</a>
                                </div>
                            </div>
                        </div>
                    `;
                        });
                        $('#books-results').html(html);
                    },
                    error: function() {
                        $('#books-results').html(
                            '<p class="text-center text-danger">Something went wrong.</p>'
                        );
                    }
                });
            });
        });
    </script>
@endsection
