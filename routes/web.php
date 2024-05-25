<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruuController;
use App\Http\Controllers\SiswaaController;
use App\Http\Controllers\OsisController;
use App\Http\Controllers\DataVoteController;
use App\Http\Controllers\Vote;
use App\Http\Controllers\VotingController;
use App\Http\Controllers\SettingVoteController;
use App\Http\Controllers\DataPlgController;

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
//     return view('welcome');
// });
route::get('/',[LoginController::class,'landing'])->name('landing');

route::get('/login',[LoginController::class,'halamanlogin'])->name('login');
route::post('/postlogin',[LoginController::class,'postlogin'])->name('postlogin');
route::get('/logout',[LoginController::class,'logout'])->name('logout');



Route::post('/siswa/update-selected', [SiswaController::class, 'updateSelected'])->name('siswa.updateSelected');
route::post('/importguru',[GuruController::class,'guruimportexcel'])->name('guruimportexcel');
route::post('/importsiswa',[SiswaController::class,'siswaimportexcel'])->name('siswaimportexcel');
route::get('/exportplg',[PelanggaranController::class,'exportPelanggaran'])->name('exportPelanggaran');
route::get('/exportphg',[PenghargaanController::class,'exportPenghargaan'])->name('exportPenghargaan');
route::get('/exportpng',[PenangananController::class,'exportPenanganan'])->name('exportPenanganan');





Route::group(['middleware' => ['auth','ceklevel:admin,guru,siswa']], function (){
    route::get('/home',[HomeController::class,'index'])->name('home');
    // Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/jumlah_suara', [HomeController::class, 'showJumlahSuara'])->name('jumlah_suara');
    
    // route::get('/home',[HomeController::class,'penghargaan'])->name('home');
    
});






// route::get('/admin/search',[AdminController::class,'search'])->name('admin.search');
// route::get('/admin',[AdminController::class,'admin'])->name('admin');
// Route::delete('/admin/{id}', [AdminController::class,'destroy'])->name('admin.destroy');
// route::get('/add_admin',[AdminController::class,'add_admin'])->name('add_admin');
// Route::post('/admin/store',[AdminController::class,'store']);
// Route::get('/admin/{id}/edit_admin  ',[AdminController::class,'edit']);
// Route::put('/admin/{id}',[AdminController::class,'update']);

route::get('/admin/search',[AdminController::class,'search'])->name('admin.search');
route::get('/admin',[AdminController::class,'admin'])->name('admin');
Route::delete('/admin/{id}', [AdminController::class,'destroy'])->name('admin.destroy');
route::get('/add_admin',[AdminController::class,'add_admin'])->name('add_admin');
Route::post('/admin/store',[AdminController::class,'store']);
Route::get('/admin/{id}/edit_admin  ',[AdminController::class,'edit']);
Route::put('/admin/{id}',[AdminController::class,'update']);

// Route::post('/importguru', [GuruuController::class, 'guruimportexcel'])->name('import-guru');
// route::get('/guruu/search',[GuruuController::class,'search'])->name('guruu.search');
// route::get('/guruu',[GuruuController::class,'guruu'])->name('guruu');
// Route::delete('/guruu/{id}', [GuruuController::class,'destroy'])->name('guruu.destroy');
// route::get('/add_guruu',[GuruuController::class,'add_guruu'])->name('add_guruu');
// Route::post('/guruu/store',[GuruuController::class,'store']);
// Route::get('/guruu/{id}/edit_guruu  ',[GuruuController::class,'edit']);
// Route::put('/guruu/{id}',[GuruuController::class,'update']);


Route::post('/importguru', [GuruuController::class, 'guruimportexcel'])->name('import-guru');
route::get('/guru/search',[GuruuController::class,'search'])->name('guru.search');
route::get('/guruu',[GuruuController::class,'guruu'])->name('guruu');
Route::delete('/guruu/{id}', [GuruuController::class,'destroy'])->name('guruu.destroy');
route::get('/add_guruu',[GuruuController::class,'add_guruu'])->name('add_guruu');
Route::post('/guruu/store',[GuruuController::class,'store']);
Route::get('/guruu/{id}/edit_guruu  ',[GuruuController::class,'edit']);
Route::put('/guruu/{id}',[GuruuController::class,'update']);

// Route::post('/importsiswa', [SiswaaController::class, 'siswaimportexcel'])->name('import-siswa');
// route::get('/siswaa/search',[SiswaaController::class,'search'])->name('siswaa.search');
// route::get('/siswaa',[SiswaaController::class,'siswaa'])->name('siswaa');
// Route::delete('/siswaa/{id}', [SiswaaController::class,'destroy'])->name('siswaa.destroy');
// route::get('/add_siswaa',[siswaaController::class,'add_siswaa'])->name('add_siswaa');
// Route::post('/siswaa/store',[SiswaaController::class,'store']);
// Route::get('/siswaa/{id}/edit_siswaa  ',[SiswaaController::class,'edit']);
// Route::put('/siswaa/{id}',[SiswaaController::class,'update']);


Route::post('/importsiswa', [SiswaaController::class, 'siswaimportexcel'])->name('import-siswa');
route::get('/siswa/search',[SiswaaController::class,'search'])->name('siswa.search');
route::get('/siswaa',[SiswaaController::class,'siswaa'])->name('siswaa');
Route::delete('/siswaa/{id}', [SiswaaController::class,'destroy'])->name('siswaa.destroy');
route::get('/add_siswaa',[siswaaController::class,'add_siswaa'])->name('add_siswaa');
Route::post('/siswaa/store',[SiswaaController::class,'store']);
Route::get('/siswaa/{id}/edit_siswaa  ',[SiswaaController::class,'edit']);
Route::put('/siswaa/{id}',[SiswaaController::class,'update']);

route::get('/calonosis',[OsisController::class,'osis'])->name('osis');
route::get('/add_osis',[OsisController::class,'add_osis'])->name('add_osis');
Route::post('/osis/store',[OsisController::class,'store']);
Route::delete('/osis/{id}', [OsisController::class,'destroy'])->name('osis.destroy');
Route::get('/calonosis/{id}/edit_osis  ',[OsisController::class,'edit']);
Route::put('/calonosis/{id}',[OsisController::class,'update']);

// Route::get('/vote',[OsisController::class,'vote'])->name('osis');

Route::get('/datavoted',[DataVoteController::class,'view'])->name('datavoted');
Route::get('/vote',[VotingController::class,'index'])->name('index');
Route::post('/voting', [VotingController::class, 'store'])->name('voting.vote');
Route::get('/setting', [SettingVoteController::class, 'index']);
Route::post('/update-waktu-vote', [SettingVoteController::class, 'update'])->name('update.date');
Route::get('/datapoling',[DataPlgController::class,'view'])->name('datapolling');
Route::get('/cetaklaporan',[DataPlgController::class,'cetaklaporan'])->name('cetaklaporan');
route::get('/petunjuk',[HomeController::class,'petunjuk'])->name('petunjuk');


