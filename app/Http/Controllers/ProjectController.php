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
        return Inertia::render('Portfolio', ['categories' => ProjectCategory::all(),
                                            'projects' => Project::all(),
                                            'selected' => 0]);
    }

}
