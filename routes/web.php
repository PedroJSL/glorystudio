<?php

use App\Http\Controllers\ProjectController;
use App\Models\User;
use Illuminate\Foundation\Application;
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
    /*
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
    */
});

Route::get('/about-me', function(){
    return Inertia::render('AboutMe');
});

Route::get('/portfolio', [ProjectController::class, 'showProjects']);

Route::get('/blog', function(){
    return Inertia::render('Blog');
});

Route::get('/shop', function(){
    return Inertia::render('Shop');
});

Route::get('/contact', function(){
    return Inertia::render('Contact');
});

require __DIR__.'/auth.php';
