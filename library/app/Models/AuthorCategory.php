<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorCategory extends Model
{
    protected $fillable = [
        'author_id',
        'category_id',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
