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

    public function getPostByCategory($slug){
        $category = PostCategory::where('slug', $slug)->firstOrFail();

        $posts = Post::where('publication_date', '<=', Carbon::now())->where('post_category_id', $category->id)->orderBy('publication_date', 'desc')->paginate(6);
        return Inertia::render('Blog/Blog', ['posts'=> $posts, 'categories' => PostCategory::all()]);
    }

    public function getPostBySlug($slug, $postSlug){
        $category = PostCategory::where('slug', $slug)->firstOrFail();

        $post = Post::where('slug', $postSlug)->where('post_category_id', $category->id)->orderBy('publication_date', 'desc')->first();
        return Inertia::render('Blog/Post', ['post'=> $post->load('postCategory')]);
    }

}
