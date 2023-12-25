<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:250'],
            'content' => ['required', 'string'],
        ]);

        $path = null;
        $file = $request->file('image');
        
        if ($file)
        {
            $path = $file->hashName();
            $file->storeAs('public', $path);
        }

        Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'filepath' => $path
        ]);

        return redirect('index');
    }

    public function edit(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:250'],
            'content' => ['required', 'string'],
        ]);

        $post = Post::find((int)$request->postId);

        $file = $request->file('image');
        
        if ($file)
        {
            $path = $file->hashName();
            $file->storeAs('public', $path);

            if ($post->filepath)
            {
                Storage::disk('public')->delete($post->filepath);
            }
            
            $post->filepath = $path;
            
        }

        $post->title = $validated['title'];
        $post->content = $validated['content'];

        $post->save();

        return redirect('post/'.$post->id);
    }

    public function remove(int $postId)
    {
        $post = Post::find($postId);

        if ($post->filepath)
        {
            Storage::disk('public')->delete($post->filepath);
        }

        $post->delete();

        return redirect('index');
    }

    public function removeImage(int $postId)
    {
        $post = Post::find($postId);
        Storage::disk('public')->delete($post->filepath);

        $post->filepath = null;

        $post->save();

        return redirect('post-edit/'.$post->id);
    }
}
