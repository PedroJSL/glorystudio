<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

use App\Models\ProjectImages;

class ProjectImagesController extends Controller
{
    //
    public function deleteImage(Request $request)
    {
        if($request->validate([
            'id' => 'required',
        ]))

        $projectImage = ProjectImages::findOrFail($request->id);
        $projectID = $projectImage->project->id;

        Storage::delete($projectImage->image_url);

        if($projectImage->delete())
        {
            $request->session()->flash('message', 'Imagen eliminada correctamente.');
            $request->session()->flash('message_type', '0');
            return Redirect::route('project.showEditForm', [$projectID]);
        }
        else
        {
            $request->session()->flash('message', 'Error al eliminar la imagen correctamente.');
            $request->session()->flash('message_type', '2');
            return Redirect::back();
        }
    }


    public function addImage(Request $request)
    {
        if($request->validate([
            'project_id' => 'required',
            'newImage' => 'required|mimes:jpeg,jpg,png,gif'
        ]));

        $projectImage = new ProjectImages();
        $order = ProjectImages::where('project_id', $request->project_id)->orderBy('order', 'desc')->first()->order +1;
        if($request->hasFile('newImage'))
        {
            $imageName = time().'_'. $order . '.' . $request->newImage->extension();
            $path = '/images/project_' . $request->project_id .'/' .$imageName;
            $request->newImage->move(public_path('images/project_' . $request->project_id), $imageName);

            $projectImage->image_url = $path;
            $projectImage->project_id = $request->project_id;
            $projectImage->order = $order++;

            if($projectImage->save())
            {
                $request->session()->flash('message', 'Imagen añadida correctamente.');
                $request->session()->flash('message_type', '0');
                return Redirect::route('project.showEditForm',[$request->project_id]);
            }

        }
        $request->session()->flash('message', 'Error al añadir imagen.');
        $request->session()->flash('message_type', '2');
        return Redirect::route('project.showEditForm',[$request->project_id]);
    }
}
