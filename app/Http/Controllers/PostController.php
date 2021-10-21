<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Post;
use App\Models\PostCategory;
use Carbon\Carbon;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::where('publication_date', '<=', Carbon::now())->orderBy('publication_date', 'desc')->paginate(6);

        return Inertia::render('Blog/Blog', ['posts' => $posts, 'categories' => PostCategory::all()]);
    }



}
