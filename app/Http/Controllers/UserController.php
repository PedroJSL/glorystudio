<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return Inertia::render("User/Profile", ["user"=> User::find($id)->load('experience')->load('projects')->load('socialMedias')->load('contactLinks')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->biography = $request->biography;
        if($user->save())
        {
            $request->session()->flash('message', 'Datos actualizados correctamente.');
            $request->session()->flash('message_type', '0');
        }
        else
        {
            $request->session()->flash('message', 'Error al actualizar datos.');
            $request->session()->flash('message_type', '2');
        }
        return Redirect::route('user.profile', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }


    public function updateImage(Request $request)
    {
        //
        $user = User::find($request->user_id);

        if($request->hasFile('avatar'))
        {
            if($request->file('avatar')->isValid())
            {
                $imageName = time().'.'.$request->avatar->extension();
                $path = '/images/user_'.$user->id . '/'. $imageName;
                $request->avatar->move(public_path('images/user_'.$user->id), $imageName);
                $user->avatar = $path;

                if($user->save()){
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

        return Redirect::route('user.profile', [$request->user_id]);
    }
}
