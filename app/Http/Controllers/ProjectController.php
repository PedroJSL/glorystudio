<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImages;

use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    //

    public function showAllProjects()
    {

        return Inertia::render('Portfolio/Portfolio', ['categories' => ProjectCategory::all(),
                                            'projects' => Project::all()->load('images')]);
    }


    public function getProjectBySlug($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $images = $project->images;
        return Inertia::render('Portfolio/Project', ['project' => $project, 'images' =>$images]);
    }

    public function showNewProjectForm()
    {
        return Inertia::render('Portfolio/NewProject', ['categories' => ProjectCategory::all()]);
    }

    public function newProject(Request $request)
    {
        Log::debug("Inicio de funcion newProject");

        if($request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'project_date' => 'required|date',
            'category' => 'required',
            'images' => 'required',
            'images.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
        ]));

        $project = new Project();

        $project->user_id = $request->user_id;
        $project->name = $request->name;
        $project->slug = str_replace(" ", "_", trim(strtolower($request->name)));
        $project->description = $request->description;
        $project->project_date = Carbon::parse($request->project_date);

        //Registrar la categoría si no existe
        if($request->category == 0)
        {
            $projectCategory = new ProjectCategory();

            $projectCategory->name = $request->newCategoryName;
            $projectCategory->slug = str_replace(" ", "_", trim(strtolower($request->newCategoryName)));

            if(!$projectCategory->save())
            {
                $request->session()->flash('message', 'Error al generar la nueva categoria');
                $request->session()->flash('message_type', '2');
                return Redirect::back();
            }
            $project->project_category_id = ProjectCategory::where('name', $request->newCategoryName)->first()->id;
        }
        else
        {
            $project->project_category_id = $request->category;
        }

        if($project->save())
        {
            //Guardar las imágenes
            if($request->hasFile('images'))
            {
                $order = 0;
                foreach($request->images as $image){
                    $projectImage = new ProjectImages();

                    $imageName = time().'_'. $order . '.' . $image->extension();
                    $path = '/images/project_' . $project->id .'/' .$imageName;
                    $image->move(public_path('images/project_' . $project->id), $imageName);

                    $projectImage->image_url = $path;
                    $projectImage->project_id = Project::where('slug', $project->slug)->first()->id;
                    $projectImage->order = $order++;

                    if(!$projectImage->save())
                    {
                        $request->session()->flash('message', 'Error al guardar las imágenes.');
                        $request->session()->flash('message_type', '2');
                        return Redirect::route('project.byslug',[$project->slug]);
                    }
                }

                $request->session()->flash('message', 'Se ha registrado el nuevo proyecto.');
                $request->session()->flash('message_type', '0');
                return Redirect::route('project.byslug',[$project->slug]);
            }
        }
        else
        {
            $request->session()->flash('message', 'Se ha producido un error al registrar el nuevo proyecto.');
            $request->session()->flash('message_type', '2');
            return Redirect::back();
        }

    }

    public function deleteProject(Request $request)
    {
        if($request->validate([
            'project_id' => 'required',
        ]));

        $project = Project::findOrFail($request->project_id);

        $category = $project->projectCategory;

        foreach($project->images as $image)
        {
            Storage::delete($image->image_url);
            $image->delete();
        }

        if($project->delete())
        {
            $request->session()->flash('message', 'Proyecto eliminado correctamente.');
            $request->session()->flash('message_type', '0');

            //Si no quedan mas proyectos en la categoría, eliminarla
            if(count($category->projects) == 0)
            {
                $category->delete();
            }

            return Redirect::route('portfolio');
        }
        $request->session()->flash('message', 'Error al eliminar el proyecto.');
        $request->session()->flash('message_type', '2');
        return Redirect::back();
    }
}
