<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthorRequest;
use App\Models\Author;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function store(StoreAuthorRequest $request)
    {

        $inputs = $request->all();
        $inputs['role_id'] = User::ROLE_AUTHOR;

        Author::create($inputs);

        return response()->json(['message' => 'Author created successfully', 'status' => 201]);
    }
}
