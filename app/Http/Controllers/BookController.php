<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Menampilkan data
    public function index()
    {
        return response()->json(Book::all());
    }

    // Menambah data
    public function store(Request $request)
    {
     try{
        $validated = $request->validate([
            'title' => 'required|max:100',
            'author' => 'required|max:100',
            'year' => 'required|integer'
        ]);

        $book = BookService::store($validated);

        return response()->json([
            'message' => 'Data berhasil ditambahkan',
            'data' => $book
        ],201);
    } catch (\Exception $e){

        return response()->json([
            'message' => 'Gagal menambahkan data',
            'error' => $e->getMessage()
        ],500);

    }
}

    // Mengubah data
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $book->update($request->all());

        return response()->json([
        'message' => 'Data berhasil diubah',
        'data' => $book
    ]);
    }

    // Menghapus data
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        $book->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}

