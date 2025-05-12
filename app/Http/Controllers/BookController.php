<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    // Search Form
    public function index()
    {
        return view('books.index');
    }

    // Handle Searching
    public function search(Request $request)
    {
        $query = $request->input('query');

        $response = Http::get('https://openlibrary.org/search.json', [
            'title' => $query
        ]);

        $books = $response->json()['docs'] ?? [];

        return view('books.index', compact('books', 'query'));
    }

    //Detailed Book Info and Embed
    public function show($workId)
    {
        // Get Book Details (from works endpoint)
        $response = Http::get("https://openlibrary.org/works/{$workId}.json");
        if ($response->failed()) {
            abort(404, 'Book not found');
        }
        $book = $response->json();

        // Get Editions (from editions endpoint)
        $editionsResponse = Http::get("https://openlibrary.org/works/{$workId}/editions.json");
        $editionKey = $editionsResponse->json()['entries'][0]['key'] ?? null;  // e.g., /books/OL12345M

        return view('books.show', compact('book', 'editionKey'));
    }
}
