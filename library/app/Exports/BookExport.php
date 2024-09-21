<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;

class BookExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Book::join('users', 'books.author_id', 'users.id')
                    ->select('users.name as author_name','books.title', 'books.description', 'books.published_at', 'books.bio')
                    ->where('users.id', auth()->id())
                    ->orderBy('books.id', 'desc')
                    ->get();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'Auth Name',
            'Title',
            'Description',
            'Published At',
            'Bio',
        ];
    }
}
