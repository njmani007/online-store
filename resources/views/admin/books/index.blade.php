@extends('layouts.admin')
@section('title', 'Manage Books')

@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="mt-2 mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Books</li>
            </ol>
        </nav>

        <div class="card shadow rounded-4">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Books</h4>
                    <a href="{{ route('admin.books.create') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Add Book
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="">#</th>
                                <th class="text-center">Cover Image</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th class="text-center">Available</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($books as $book)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        @if ($book->image)
                                            <img src="{{ asset('storage/' . $book->image) }}" alt="Book Cover"
                                                class="img-thumbnail border-0" style="max-width: 100px;">
                                        @else
                                            <img src="{{ asset('assets/images/default.webp') }}" alt="No Image"
                                                class="img-thumbnail border-0" style="max-width: 100px;">
                                        @endif
                                    </td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->category->name ?? '—' }}</td>
                                    <td>{{ $book->description ?? 'N/A' }}</td>
                                    <td class="text-center align-middle">
                                        <div class="d-flex justify-content-center">
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input toggle-availability" type="checkbox"
                                                    data-id="{{ $book->id }}"
                                                    {{ $book->is_available ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                    </td>


                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-content-center">

                                            <a href="{{ route('admin.books.edit', $book->id) }}"
                                                class="btn btn-sm btn-primary me-1">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Delete this book?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No books found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $books->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.toggle-availability').change(function() {
                var bookId = $(this).data('id');

                $.ajax({
                    url: '/admin/books/' + bookId + '/toggle-availability',
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log('Availability updated');
                    },
                    error: function() {
                        alert('Error updating availability!');
                    }
                });
            });
        });
    </script>
@endsection
