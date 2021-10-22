<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SocialMediaController extends Controller
{
    //
    public function delete(Request $request)
    {
        $socialMedia = SocialMedia::findOrFail($request->id);
        $userId = $socialMedia->user_id;
        if($socialMedia->delete())
        {
            $request->session()->flash('message', 'Datos actualizados correctamente.');
            $request->session()->flash('message_type', '0');
        }
        return Redirect::route('user.profile', [$userId]);
    }

    public function update(Request $request)
    {
        $socialMedia = SocialMedia::find($request->id);
        $userId = $socialMedia->user_id;

        if($request->hasFile('icon'))
        {
            if($request->validate([
                'icon' => 'image|dimensions:min_width=200,min_height=200'
            ]));

            if($request->file('icon')->isValid())
            {
                $imageName = time().'.'.$request->icon->extension();
                $path = '/images/rrss/' . $imageName;
                $request->icon->move( public_path('images/rrss/') , $imageName );
                $socialMedia->icon = $path;

            }
        }
        else
        {
            if($request->validate([
                'url' => 'required|max:255',
            ]));

            $socialMedia->url = $request->url;
        }


        if($socialMedia->save()){
            $request->session()->flash('message', 'Datos de RRSS actualizados correctamente');
            $request->session()->flash('message_type', '0');
        }
        else
        {
            $request->session()->flash('message', 'Error al modificar los datos de RRSS');
            $request->session()->flash('message_type', '2');
        }

        return Redirect::route('user.profile', [$userId]);
    }

    public function new(Request $request)
    {
        $socialMedia = new SocialMedia();

        if($request->validate([
            'icon' => 'required|image|dimensions:min_width=200,min_height=200',
            'url' => 'required|max:255',
            'user_id' => 'required|integer',
        ]));

        if($request->file('icon')->isValid())
        {
            $imageName = time().'.'.$request->icon->extension();
            $path = '/images/rrss/' . $imageName;
            $request->icon->move( public_path('images/rrss/') , $imageName );
            $socialMedia->icon = $path;

        }

        $socialMedia->url = $request->url;
        $socialMedia->user_id = $request->user_id;

        if($socialMedia->save()){
            $request->session()->flash('message', 'Nuevo enlace de contacto añadido.');
            $request->session()->flash('message_type', '0');
        }
        else
        {
            $request->session()->flash('message', 'Error al añadir nuevo enlace de contacto');
            $request->session()->flash('message_type', '2');
        }

        return Redirect::route('user.profile', [$request->user_id]);
    }

}

