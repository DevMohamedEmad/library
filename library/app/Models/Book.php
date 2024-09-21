<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $fillable = [
        'title',
        'author_id',
        'description',
        'published_at',
        'bio',
        'cover',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function filter($filters){

        return $this->where(function($query) use ($filters){

            $fillable = $this->getFillable();

            foreach ($filters as $key => $value) {

                if (in_array($key, $fillable)) {

                    if (is_array($value)) {

                        $query->whereIn($key, $value);

                    } else {

                        $query->where($key, 'like', '%' . $value . '%');
                    }

                }

            }
        });
    }
}
