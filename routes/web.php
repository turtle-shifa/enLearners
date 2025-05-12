<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ResourceController;  
use App\Http\Controllers\QuestionController; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenAIController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ChatController;

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

Route::get('/login', function () {
    return view('login_form');
});

Route::get('/signup', function () {
    return view('signup_form');
});

Route::resource('/users',UserController::class);

Route::get('/dashboard', [UserController::class,'dashboard']);
Route::get('/save/{resource_id}',[ResourceController::class,'save']);

Route::get('/topic/{topic_id}', [TopicController::class,'topic_resources_access']);

Route::get('/resources/create', [ResourceController::class, 'create']);

Route::post('/resources', [ResourceController::class, 'store']);

Route::get('/upvote/{id}', [ResourceController::class,'upvote']);

Route::get('/downvote/{id}', [ResourceController::class,'downvote']);

Route::get('/admin/resource-requests', [ResourceController::class, 'pendingRequests']);
Route::post('/admin/resource-requests/approve/{id}', [ResourceController::class, 'approveRequest']);
Route::post('/admin/resource-requests/reject/{id}', [ResourceController::class, 'rejectRequest']);

Route::get('/logout', [UserController::class, 'logout']);


Route::get('/admin/resources', [ResourceController::class, 'showResources']);

// Route to delete a resource
Route::delete('/admin/resources/{id}', [ResourceController::class, 'destroy'])->name('resources.delete');

Route::get('/admin/topics', [TopicController::class, 'showTopics']);

// Route to delete a topic
Route::delete('/admin/topics/{id}', [TopicController::class, 'destroy']);

Route::get('/admin/topics/create', [TopicController::class, 'create']);

// Route to store the new topic in the database
Route::post('/admin/topics', [TopicController::class, 'store']);





Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
Route::post('/questions', [QuestionController::class, 'store']);
Route::get('/questions/{id}', [QuestionController::class, 'show'])->name('questions.show');
Route::post('/questions/{id}/answer', [QuestionController::class, 'answer']);




// Show topic dropdown
Route::get('/search', [TopicController::class, 'search']);

// Show resources for a selected topic
Route::get('/topics/{topics_id}', [TopicController::class, 'topic_resources_access']);







Route::get('/test',function(){
    return view('test');
});


Route::get('/openai', [OpenAIController::class, 'showForm'])->name('openai.form');
Route::post('/openai', [OpenAIController::class, 'askQuestion'])->name('openai.ask');
Route::get('/openai/history/{id}', [OpenAIController::class, 'showHistory'])->name('openai.history');


Route::get('/update-info', [UserController::class, 'showUpdateForm'])->name('update.form');
Route::post('/update-info', [UserController::class, 'updateInfo'])->name('update.info');



Route::post('/answers/{id}/upvote', [QuestionController::class, 'upvote']);
Route::post('/answers/{id}/downvote', [QuestionController::class, 'downvote']);


Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
Route::get('/books/{workId}', [BookController::class, 'show'])->name('books.show');

Route::delete('/questions/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy');
Route::delete('/answers/{id}', [QuestionController::class, 'destroyAnswer'])->name('answers.destroy');


// Route::post('/send-message', [ChatController::class, 'sendMessage']);
// Route::post('/admin-respond', [ChatController::class, 'adminRespond']);
// Route::get('/messages', [ChatController::class, 'fetchMessages']);

// Route::get('/admin/chat-response', [ChatController::class, 'adminChatResponse'])->middleware('admin');
// Route::get('/admin/messages', [ChatController::class, 'getMessagesWithUser'])->middleware('admin');

Route::get('/about',function(){
    return view('about');
});

Route::get('/terms',function(){
    return view('terms');
});

Route::get('/privacy',function(){
    return view('privacy');
});