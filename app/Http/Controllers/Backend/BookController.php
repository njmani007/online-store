<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function dashboard()
    {
        $totalBooks = Book::count();
        $availableBooks = Book::where('is_available', true)->count();
        $totalCategories = Category::count();

        return view('admin.dashboard', compact('totalBooks', 'availableBooks', 'totalCategories'));
    }

    public function index()
    {
        $books = Book::paginate(10);
        return view('admin.books.index', compact('books'));
    }


    public function create()
    {
        $categories = Category::get();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        //    dd($request->all());

        $data = $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'is_available' => 'boolean|nullable',
            'image' => 'nullable|image'
        ]);
        $data['is_available'] = $request->has('is_available') ?? true;
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('books', 'public');
        } else {
            unset($data['image']);
        }
        Book::create($data);
        return redirect()->route('admin.books.index')->with('success', 'Book created successfully.');
    }

    // public function show(Book $book)
    // {

    //     return view('admin.books.show', compact('book'));
    // }

    public function edit(Book $book)
    {
        $categories = Category::get();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        // dd($request->all());
        $data = $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'is_available' => 'nullable|boolean',
            'image' => 'nullable|image'
        ]);


        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('books', 'public');
        } else {
            unset($data['image']);
        }
        $book->update($data);
        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully.');
    }

    public function toggleAvailability($id)
    {
        $book = Book::findOrFail($id);
        $book->is_available = !$book->is_available;
        $book->save();

        return response()->json(['message' => 'Availability updated successfully.']);
    }
}
