<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\TrackerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\MailController;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\MailTrap;

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
    return view('auth.login');
});


Auth::routes();

//Routes utilisateur

//affichage de la page d'accueil
Route::get('/home', [HomeController::class, 'index'])->name('home');

//affichage de la page vidéo
Route::get('/video', [HomeController::class, 'video'])->name('video');

//Questions
Route::post('/video/store', [QuestionController::class, 'store'])->name('store');

//Statut de l'utilisateur
Route::get('/video/addminute/{id}', [TrackerController::class, 'addMinute'])->name('status');



//Routes admin

//Accès back office
Route::get('admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin_dashboard')->middleware('is_admin');

//Logout
Route::get('logout', [HomeController::class, 'logout'])->name('logout')->middleware('is_admin');

//CRUD
Route::resource('admin/users', CrudController::class)->middleware('is_admin');

//Vidéo
Route::resource('admin/video', VideoController::class, ['only'=>['update','index']])->middleware('is_admin');

//CSV
Route::get('admin/import', [ImportController::class, 'index'])->name('index')->middleware('is_admin');
Route::post('admin/import_parse', [ImportController::class, 'parse'])->name('import_parse')->middleware('is_admin');
Route::post('admin/import_process', [ImportController::class, 'process'])->name('import_process')->middleware('is_admin');

//Gestion des questions
Route::get('admin/questions', [QuestionController::class, 'index'])->name('questions')->middleware('is_admin');
Route::get('admin/ajaxquestions', [QuestionController::class, 'ajaxQuestions'])->name('ajaxQuestions')->middleware('is_admin');

//Tracker
Route::get('admin/tracker', [TrackerController::class, 'onlineUsers'])->name('tracker')->middleware('is_admin');
Route::get('admin/sessions', [TrackerController::class, 'ajaxSessions'])->name('ajax')->middleware('is_admin');

//Mail
Route::get('admin/mail', [MailController::class, 'index'])->name('indexMail')->middleware('is_admin');
Route::post('admin/mail/sent', [MailController::class, 'sent'])->name('mailSent')->middleware('is_admin');
