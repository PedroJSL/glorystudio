<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
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

    public function showNewPostForm()
    {
        return Inertia::render('Blog/NewPost', ['categories' => PostCategory::all()]);
    }

    public function showEditPostForm(Request $request)
    {
        $post = Post::findOrFail($request->id);
        return Inertia::render('Blog/EditPost', ['post' => $post, 'categories' => PostCategory::all()]);
    }

    public function deletePost(Request $request)
    {
        if($request->validate([
            'post_id' => 'required',
        ]));

        $post = Post::findOrFail($request->post_id);

        $category = $post->postCategory;

        Storage::delete($post->image);

        if($post->delete())
        {
            $request->session()->flash('message', 'Post eliminado correctamente.');
            $request->session()->flash('message_type', '0');

            //Si no quedan mas proyectos en la categoría, eliminarla
            if(count($category->posts) == 0)
            {
                $category->delete();
            }

            return Redirect::route('blog');
        }
        $request->session()->flash('message', 'Error al eliminar el post.');
        $request->session()->flash('message_type', '2');
        return Redirect::back();
    }

    public function newPost(Request $request)
    {
        if($request->validate([
            'name' => 'required|max:255',
            'excerpt' => 'required',
            'content' => 'required',
            'category' => 'required',
            'publication_date' => 'required|date',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
        ]));

        $post = new Post();

        $post->user_id = $request->user_id;
        $post->name = $request->name;
        $post->slug = str_replace(" ", "_", trim(strtolower($request->name)));
        $post->excerpt = $request->excerpt;
        $post->content = $request->content;
        $post->publication_date = Carbon::parse($request->publication_date);

        //Registrar la categoría si no existe
        if($request->category == 0)
        {
            $postCategory = new PostCategory();

            $postCategory->name = $request->newCategoryName;
            $postCategory->slug = str_replace(" ", "_", trim(strtolower($request->newCategoryName)));

            if(!$postCategory->save())
            {
                $request->session()->flash('message', 'Error al generar la nueva categoria');
                $request->session()->flash('message_type', '2');
                return Redirect::back();
            }
            $post->post_category_id = PostCategory::where('name', $request->newCategoryName)->first()->id;
        }
        else
        {
            $post->post_category_id = $request->category;
        }

        //Guardar las imágenes
        if($request->hasFile('image'))
        {
            $imageName = time(). '.' . $request->image->extension();
            $path = '/images/post_' . $post->id .'/' .$imageName;
            $request->image->move(public_path('images/post_' . $post->id), $imageName);

            $post->image = $path;
        }

        if($post->save())
        {

                $request->session()->flash('message', 'Se ha registrado el nuevo post.');
                $request->session()->flash('message_type', '0');
                return Redirect::route('post.byslug',[PostCategory::find($post->post_category_id)->slug, $post->slug]);
        }
        else
        {
            $request->session()->flash('message', 'Se ha producido un error al registrar el nuevo post.');
            $request->session()->flash('message_type', '2');
            return Redirect::back();
        }
    }

    public function updatePost(Request $request)
    {
        if($request->validate([
            'post_id' => 'required'
        ]));

        $post = Post::find($request->post_id);

        $post->name = $request->name;
        $post->slug = str_replace(" ", "_", trim(strtolower($request->name)));
        $post->excerpt = $request->excerpt;
        $post->content = $request->content;
        $post->publication_date = Carbon::parse($request->publication_date);

        //Registrar la categoría si no existe
        if($request->category == 0)
        {
            $postCategory = new PostCategory();

            $postCategory->name = $request->newCategoryName;
            $postCategory->slug = str_replace(" ", "_", trim(strtolower($request->newCategoryName)));

            if(!$postCategory->save())
            {
                $request->session()->flash('message', 'Error al generar la nueva categoria');
                $request->session()->flash('message_type', '2');
                return Redirect::back();
            }
            $post->post_category_id = PostCategory::where('name', $request->newCategoryName)->first()->id;
        }
        else
        {
            $post->post_category_id = $request->category;
        }

        //Guardar las imágenes
        if($request->hasFile('image'))
        {
            $imageName = time(). '.' . $request->image->extension();
            $path = '/images/post_' . $post->id .'/' .$imageName;
            $request->image->move(public_path('images/post_' . $post->id), $imageName);

            $post->image = $path;
        }

        if($post->save())
        {

                $request->session()->flash('message', 'Se ha actualizado el post correctamente.');
                $request->session()->flash('message_type', '0');
                return Redirect::route('post.showUpdateForm',[$post->id]);
            }
        else
        {
            $request->session()->flash('message', 'Se ha producido un error al actualizar el post.');
            $request->session()->flash('message_type', '2');
            return Redirect::back();
        }

    }

}
