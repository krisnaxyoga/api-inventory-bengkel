<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;

class UserController extends Controller
{
    public function index(){
        try {
            
            //get posts
            $posts = auth('sanctum')->user();

            //return collection of posts as a resource
            return new DataResource(true, 'List Data User', $posts);
        }  catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

}
