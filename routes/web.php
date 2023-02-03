 <?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Carbon\Carbon;


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
    return view('welcome');
});



//posts

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

//group middleware
Route::group(['middleware' => ['auth']], function () {

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

Route::post('/posts', [PostController::class, 'store']);

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.update');

Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.edit');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/posts/restore', [PostController::class, 'restore'])->name('posts.restore');

Route::get('/posts/{post}/reback', [PostController::class, 'reback'])->name('posts.reback');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

});

//Comments
Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->name('comments.store');

Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');


//auth
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
