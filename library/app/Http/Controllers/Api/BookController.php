<?php

namespace App\Http\Controllers\Api;

use App\Exports\BookExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExcelFileRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Imports\BooksImport;
use App\Models\Book;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{

    public function index()
    {
        $books = Book::all();
        return response()->json(['books' => BookResource::collection($books), 'message' => 'Books retrieved successfully'] , 200);
    }

    public function store(StoreBookRequest $request)
    {
        $inputs = $request->all();
        $inputs['author_id'] = auth()->id();
        $book = Book::create($inputs);

        return response()->json(['book' => BookResource::make($book), 'message' => 'Book created successfully', 'status' => 201]);
    }

    public function update(Request $request, $book)
    {
        $book = Book::whereId($book)->first();

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        
        $book->update($request->all());

        return response()->json(['message' => 'Book updated successfully', 'status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($book)
    {
        $book = Book::whereId($book->id)->first();

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted successfully', 'status' => 201]);
    }

    public function export()
    {
        return Excel::download(new BookExport, 'books.xlsx');
    }

    public function import(ExcelFileRequest $request)
    {
        Excel::import(new BooksImport, $request->file('file'));
        return response()->json(['message' => 'Books imported successfully'] ,201);
    }

    public function filter(Request  $request)
    {
        $query = (new Book())->filter($request->all());

        $books = $query->get();

        return response()->json(['books' => BookResource::collection($books), 'message' => 'Books retrieved successfully']);
    }
}
