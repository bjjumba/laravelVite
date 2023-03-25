<?php
//add route
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\NoteController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

use Inertia\Inertia;
use Illuminate\Support\Facades;

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
//sample roue

Route::get('/b',function(){
   //we can fetch users in three ways
   //1.using DB facades
   $users=DB::select('select * from users');
   dd($users);//dd for formating
});

//end sample
//another sample route
Route::resource('blog',PostsController::class);
// Route::get('/blog',[PostsController::class,'index']);

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//added

//the chirps controller
Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//post controller
//Get
Route::get('/post',[PostsController::class,'index']);
Route::get('/post/{id}',[PostsController::class,'show']);


// //cousera routes
// Route::get('/notes',);

// Route::get('/notes/create',);

// Route::get('/notes/{note}');

// //post route
// Route::post('/notes');

Route::resource('/notes',NoteController::class)->middleware(['auth']);



require __DIR__.'/auth.php';
