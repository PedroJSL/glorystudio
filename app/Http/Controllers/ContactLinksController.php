<?php

namespace App\Http\Controllers;

use App\Models\ContactLinks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Log;


class ContactLinksController extends Controller
{
    //
    public function delete(Request $request)
    {
        $contactLink = ContactLinks::findOrFail($request->id);
        $userId = $contactLink->user_id;
        if($contactLink->delete())
        {
            $request->session()->flash('message', 'Datos actualizados correctamente.');
            $request->session()->flash('message_type', '0');
        }
        return Redirect::route('user.profile', [$userId]);
    }

    public function update(Request $request)
    {
        $contactLink = ContactLinks::find($request->id);
        $userId = $contactLink->user_id;

        if($request->hasFile('icon'))
        {
            if($request->validate([
                'icon' => 'image|dimensions:min_width=200,min_height=200'
            ]));

            if($request->file('icon')->isValid())
            {
                $imageName = time().'.'.$request->icon->extension();
                $path = '/images/contact/' . $imageName;
                $request->icon->move( public_path('images/contact/') , $imageName );
                $contactLink->icon = $path;

            }
        }
        else
        {
            if($request->validate([
                'url' => 'required|max:255',
                'slug' => 'required|max:255'
            ]));

            $contactLink->url = $request->url;
            $contactLink->slug = $request->slug;

        }


        if($contactLink->save()){
            $request->session()->flash('message', 'Datos de contacto actualizados correctamente');
            $request->session()->flash('message_type', '0');
        }
        else
        {
            $request->session()->flash('message', 'Error al modificar los datos de contacto');
            $request->session()->flash('message_type', '2');
        }

        return Redirect::route('user.profile', [$userId]);
    }

    public function new(Request $request)
    {
        $contactLink = new ContactLinks();
        Log::debug("Crea nuevo objeto");

        if($request->validate([
            'icon' => 'required|image|dimensions:min_width=200,min_height=200',
            'url' => 'required|max:255',
            'slug' => 'required|max:255',
            'user_id' => 'required|integer',
        ]));
        Log::debug("Valida campos del form");

        if($request->file('icon')->isValid())
        {
            $imageName = time().'.'.$request->icon->extension();
            $path = '/images/contact/' . $imageName;
            $request->icon->move( public_path('images/contact/') , $imageName );
            $contactLink->icon = $path;

            Log::debug("Imagen copiada");

        }

        $contactLink->url = $request->url;
        $contactLink->slug = $request->slug;
        $contactLink->user_id = $request->user_id;
        Log::debug("Campos establecidos:: $contactLink");


        if($contactLink->save()){
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

