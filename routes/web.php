<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Index');
});

Route::get('/about-me', function(){
    return Inertia::render('AboutMe');
});

//Rutas del apartado de portfolio
Route::get('/portfolio', [ProjectController::class, 'showAllProjects']);
Route::get('/portfolio/{project}', [ProjectController::class, 'getProjectBySlug']);

//Rutas del apartado de blog
Route::get('/blog', [PostController::class, 'showAllPosts']);


Route::get('/shop', function(){
    return Inertia::render('Shop');
});

Route::get('/contact', function(){
    return Inertia::render('Contact');
});


//Rutas para usuario registrado
Route::get('/profile/{id}', [UserController::class, 'index'])->name('user.profile');

Route::post('/profile/updateImage', [UserController::class, 'updateImage'])->name('user.update.image');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');

require __DIR__.'/auth.php';
