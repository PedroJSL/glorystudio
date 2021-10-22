<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

use Illuminate\Support\Facades\Log;

use function Psy\debug;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return Inertia::render("User/Profile", ["user"=> User::find($id)->load('socialMedias')->load('contactLinks')]);
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
        $user = User::findOrFail($id);

        if($request->hasFile('avatar'))
        {
            if($request->validate([
                'avatar' => 'image|dimensions:min_width=200,min_height=200'
            ]));

            if($request->file('avatar')->isValid())
            {
                $imageName = time().'.'.$request->avatar->extension();
                $path = '/images/user_'.$user->id . '/'. $imageName;
                $request->avatar->move(public_path('images/user_'.$user->id), $imageName);
                $user->avatar = $path;
            }
        }
        else
        {
            if($request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
            ]));

            $user->name = $request->name;
            $user->email = $request->email;
            $user->biography = $request->biography;
            $user->allowMails = $request->allowMails;
        }

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

    public function showAbout()
    {
        $user = User::where('web_owner', 1)->firstOrfail();
        return Inertia::render('AboutMe', ['biography' => $user->biography]);
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

}
