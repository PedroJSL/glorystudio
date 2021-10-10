<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;


class PostController extends Controller
{
    //
    public function showAllPosts()
    {
        return Inertia::render('Blog/Blog');
    }
}
