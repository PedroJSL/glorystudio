<?php

use App\Http\Controllers\ContactLinksController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProjectImagesController;
use App\Http\Controllers\SocialMediaController;
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
Route::get('/portfolio', [ProjectController::class, 'showAllProjects'])->name('portfolio');
Route::get('/portfolio/{project}', [ProjectController::class, 'getProjectBySlug'])->name('project.byslug');

Route::get('/portfolio/project/new', [ProjectController::class, 'showNewProjectForm'])->middleware('auth');
Route::get('/portfolio/project/edit/{id}', [ProjectController::class, 'showEditProjectForm'])->name('project.showEditForm')->middleware('auth');

Route::post('/portfolio/project/new', [ProjectController::class, 'newProject'])->name('project.new')->middleware('auth');
Route::post('/portfolio/project/update', [ProjectController::class, 'updateProject'])->name('project.update')->middleware('auth');
Route::post('/portfolio/project/delete', [ProjectController::class, 'deleteProject'])->name('project.delete')->middleware('auth');

Route::post('/project_image/delete', [ProjectImagesController::class, 'deleteImage'])->name('project_image.delete')->middleware('auth');
Route::post('/project_image/add', [ProjectImagesController::class, 'addImage'])->name('project_image.add')->middleware('auth');


//Rutas del apartado de blog
Route::get('/blog', [PostController::class, 'index']);

/*
Route::get('/shop', function(){
    return Inertia::render('Shop');
});
*/

//Rutas para usuario registrado
Route::get('/profile/{id}', [UserController::class, 'index'])->name('user.profile')->middleware('auth');

Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update')->middleware('auth');

//Modificacion de los enlaces de contacto
Route::post('/contact_link/delete', [ContactLinksController::class, 'delete'])->name('contactlink.delete')->middleware('auth');
Route::post('/contact_link/update', [ContactLinksController::class, 'update'])->name('contactlink.update')->middleware('auth');
Route::post('/contact_link/new', [ContactLinksController::class, 'new'])->name('contactlink.new')->middleware('auth');

//Modificacion de los enlaces de redes sociales
Route::post('/social_media/delete', [SocialMediaController::class, 'delete'])->name('socialmedia.delete')->middleware('auth');
Route::post('/social_media/update', [SocialMediaController::class, 'update'])->name('socialmedia.update')->middleware('auth');
Route::post('/social_media/new', [SocialMediaController::class, 'new'])->name('socialmedia.new')->middleware('auth');


require __DIR__.'/auth.php';
