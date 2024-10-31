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

    public function show(Request $request, $id)
    {
        $record = Post::findOrFail($id);
        return response()->json($record);
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

    public function destroy(Request $request, $id)
    {
        // Find the post by its ID
        $post = Post::find($id);

        // Check if the post exists
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // Delete the post
        $post->delete();

        // Return a success response
        return response()->json(['message' => 'Post deleted successfully']);
    }

    function search(Request $request)
    {
        return response()->json([
            'status' => 1,
            'message' => 'PostController@search'
        ]);
    }
}