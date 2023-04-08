<?php
//add route
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\FallBackController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
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
Route::get('/post',[PostsController::class,'index'])->name('blog.index');
Route::get('/post/{id}',[PostsController::class,'show'])->name('blog.show');

//POST
Route::get('/post/create',[PostsController::class,'create'])->name('blog.create');
Route::post('/post',[PostsController::class,'store'])->name('blog.store');

//PATCH OR PUT
Route::get('/post/edit/{id}',[PostsController::class,'edit'])->name('blog.edit');
Route::patch('/post/{id}',[PostsController::class,'update'])->name('blog.update');

//delete
Route::delete('/post/{id}',[PostsController::class,'destroy']);


Route::get('/users',[UserController::class,'index']);
Route::post('/import',[UserController::class,'import_user'])->name('import');


//Resource Route

// Route::resource('/post',PostsController::class);

/*
   We can use prefix routes to group a specific routes
   Route::prefix('/blog')->group(function(){
      routes go in here
   })
*/


// //cousera routes
// Route::get('/notes',);

// Route::get('/notes/create',);

// Route::get('/notes/{note}');

// //post route
Route::post('/notes');

// Route::resource('/notes',NoteController::class)->middleware(['auth']);


/*  Define FallBack Controller */

Route::fallback(FallBackController::class);



require __DIR__.'/auth.php';
