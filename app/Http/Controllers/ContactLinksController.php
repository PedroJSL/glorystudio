<?php

namespace App\Http\Controllers;

use App\Models\ContactLinks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


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

    public function updateIcon(Request $request)
    {
        $contactLink = ContactLinks::find($request->id);
        $userId = $contactLink->user_id;
        if($request->hasFile('icon'))
        {
            if($request->file('icon')->isValid())
            {
                $imageName = time().'.'.$request->avatar->extension();
                $path = '/images/user_'.$contactLink->user_id . '/'. $imageName;
                $request->icon->move(public_path('images/user_'.$contactLink->user_id), $imageName);
                $contactLink->icon = $path;

                if($contactLink->save()){
                    $request->session()->flash('message', 'Imagen modificada correctamente');
                    $request->session()->flash('message_type', '0');
                }
                else
                {
                    $request->session()->flash('message', 'Error al modificar la imagen');
                    $request->session()->flash('message_type', '2');
                }
            }
            else
            {
                $request->session()->flash('message', 'Imagen no válida');
                $request->session()->flash('message_type', '2');
            }

        }
        else
        {
            $request->session()->flash('message', 'No se ha seleccionado ninguna imagen');
            $request->session()->flash('message_type', '1');
        }

        return Redirect::route('user.profile', [$userId]);
    }
}

