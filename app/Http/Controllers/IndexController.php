<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\View;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index() 
    {
        return view('pages/posts/post-list', [
            'posts' => Post::with('view')->get(),
        ]);
    }

    public function register() 
    {
        return view('pages/register');
    }

    public function login() 
    {
        return view('pages/login');
    }

    public function profile() 
    {
        return view('pages/profile/profile', [
            'user' => Auth::user()
        ]);
    }

    public function editProfile() 
    {
        return view('pages/profile/profile-edit', [
            'user' => Auth::user()
        ]);
    }

    public function getPost(int $postId) 
    {
        View::userViewPost(Auth::id(), $postId);

        return view('pages/posts/post-detail', [
            'post' => Post::with('view')->find($postId),
        ]);
    }

    public function postCreate() 
    {
        return view('pages/posts/post-create', [
            'user' => Auth::user()
        ]);
    }

    public function postEdit(int $postId) 
    {
        return view('pages/posts/post-edit', [
            'post' => Post::find($postId),
        ]);
    }

}
