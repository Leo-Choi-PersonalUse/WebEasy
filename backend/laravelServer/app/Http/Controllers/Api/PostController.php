<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // Your code here
    function index(Request $request)
    {
        $data = Post::all();
        return response()->json($data);
    }

    public function show(Post $post)
    {
        // Load the post with its related data
        $post->load('title', 'content');

        // Return the view with the post data
        return view('posts.show', [
            'post' => $post
        ]);
    }

    function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Create a new post
        $post = new Post();
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->save();

        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {

        // Fetch the post to be updated
        $post = Post::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Update the post with the validated data
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->save();

        return response()->json($post);
    }

    function destroy(Request $request, $id)
    {
        return response()->json([
            'status' => 1,
            'message' => 'PostController@destroy'
        ]);
    }

    function search(Request $request)
    {
        return response()->json([
            'status' => 1,
            'message' => 'PostController@search'
        ]);
    }


}