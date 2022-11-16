<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;

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

// Route::get('/', function () {
//     return view('welcome',['name'=>'ahmed', 'age' => 29, 'books'=>['novel', 'story', 'comic']]);
// });

Route::get('/',[PostController::class,'index'])->name('posts.index');
Route::get('/posts',[PostController::class,'index'])->name('posts.index')->middleware(['auth']);
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::get('/posts/{post}/edit',[PostController::class,'edit'])->name('posts.edit');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

 
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('auth.github');
 
Route::get('/auth/callback', function () {
    // $user = Socialite::driver('github')->user();
    // return redirect()->route('posts.index');
    // $user->token
    $githubUser= Socialite::driver('github')->user();
    
    // dd($githubUser);
    $user = User::updateOrCreate([
        'email' => $githubUser->email,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'password' => $githubUser->token,
    ]);
    // dd($user);
    Auth::login($user);
    
 
    return redirect('/posts');
});


