<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;


use App\Models\Project;
use App\Models\ProjectCategory;

class ProjectController extends Controller
{
    //

    public function showProjects()
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
}
