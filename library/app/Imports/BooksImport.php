<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class BooksImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * Map each row to the corresponding model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Book([
            'title' => $row['title'],
            'bio' => $row['bio'],
            'cover' => $row['cover'],   
            'description' => $row['description'],
            'published_at' => $row['published_at'],
            'author_id' => auth()->id(),
        ]);
    }

    /**
     * Define the validation rules for each row.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:100|min:2',
            'description' => 'required|string|max:100|min:5',
            'published_at' => 'required|date',
            'bio' => 'required|string|max:500|min:5',
            'cover' => 'required|file|mimes:png,jpg,jpeg,webp|max:1024',
        ];
    }
}