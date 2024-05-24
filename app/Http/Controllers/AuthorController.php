<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();
        return response()->json($authors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'book_id' => 'required|array',
            'book_id.*' => 'exists:books,id'
        ]);

        $author = Author::create($request->only('name'));
        $author->books()->attach($request->book_id, [
            'available' => false,
            'paid'=> false
        ]);

        return response()->json($author, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return response()->json($author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'book_id' => 'sometimes|array',
            'book_id.*' => 'exists:books,id'
        ]);

        if ($request->has('name')) {
            $author->name = $request->name;
        }

        if ($request->has('book_id')) {
            $author->books()->sync($request->book_id);
        }

        $author->save();

        return response()->json($author);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->books()->detach();
        $author->delete();

        return response()->json(null, 204);
    }
}
