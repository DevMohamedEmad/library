<?php

namespace App\Http\Middleware;

use App\Models\Book;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookAuthorIsCurrentUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $book = Book::whereId($request->book)->first();

        if (auth()->id() == $book?->author_id) {

            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized access'], 401);
    }
}
