<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return Book::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Book
     */
    public function store(Request $request): Book
    {
        $request->validate([
            'title' => 'required'
        ]);
        $book = new Book;
        $book->title = $request->input('title');
        $book->save();

        return $book;
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return Book
     */
    public function show(Book $book): Book
    {
        return $book;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Book $book
     * @return Response|Book
     */
    public function update(Request $request, Book $book): Response|Book
    {
        $request->validate([
            'title' => 'required'
        ]);

        $book->title = $request->title;
        $book->save();

        return $book;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return Response
     */
    public function destroy(Book $book): Response
    {
        $book->delete();
        return response()->noContent();
    }
}
