<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FrontendController extends Controller
{
    public function home()
    {
        $latestBooks = Book::latest()->take(6)->get();
        $categories = Category::get();
        return view('frontend.home', compact('latestBooks', 'categories'));
    }

    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%")
                ->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        }

        if ($request->has('category')) {
            $categoryId = $request->input('category');
            $query->where('category_id', $categoryId);
        }

        $books = $query->paginate(12);

        return view('frontend.books.index', compact('books'));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('frontend.books.show', compact('book'));
    }

    public function searchGoogleBooks(Request $request)
    {
        // dd($request->all());
        $query = $request->input('query', '');
        $books = [];

        if (!empty($query)) {
            try {
                $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
                    'q' => $query,
                    'maxResults' => 10,
                    'key' => config('services.google_books.api_key'),
                ]);


                if ($response->ok()) {
                    $books = $response->json()['items'] ?? [];
                    $books = array_map(function ($book) {
                        return [
                            'title' => $book['volumeInfo']['title'] ?? 'No Title',
                            'authors' => $book['volumeInfo']['authors'] ?? ['Unknown Author'],
                            'description' => $book['volumeInfo']['description'] ?? 'No Description',
                            'price' => $book['saleInfo']['listPrice']['amount'] ?? 0,
                            'image' => $book['volumeInfo']['imageLinks']['thumbnail'] ?? null,
                            'infoLink' => $book['volumeInfo']['infoLink'] ?? '#',
                        ];
                    }, $books);
                    return response()->json([
                        'status' => true,
                        'message' => 'Books fetched successfully',
                        'data' => $books
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Failed to fetch books from Google API',
                        'data' => []
                    ], $response->status());
                }
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Error: ' . $e->getMessage(),
                    'data' => []
                ], 500);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'Query cannot be empty',
            'data' => []
        ], 400);
    }
}
