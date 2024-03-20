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


route::get('/tambah_siswa',[SiswaController::class,'tambahsiswa'])->name('tambahsiswa');
Route::post('/siswa/store',[SiswaController::class,'store']);
Route::delete('/siswa/{id}', [SiswaController::class,'destroy'])->name('siswa.destroy');
Route::get('/siswa/{id_siswa}/edit_siswa',[SiswaController::class,'edit']);
Route::put('/siswa/{id_siswa}',[SiswaController::class,'update']);
route::get('/siswa/search',[SiswaController::class,'search'])->name('search');
route::get('/guru/search',[GuruController::class,'search'])->name('search');
route::get('/siswa/viewimport',[SiswaController::class,'viewimport'])->name('viewimport');
Route::get('/siswa/check-nisn/{nisn}', 'SiswaController@checkNISN');
Route::delete('/deleteSelected', [SiswaController::class, 'deleteSelected'])->name('deleteSelected');


Route::group(['middleware' => ['auth','ceklevel:admin,guru,siswa']], function (){
    route::get('/home',[HomeController::class,'index'])->name('home');
    // route::get('/home',[HomeController::class,'penghargaan'])->name('home');
    
});


route::get('/siswa',[SiswaController::class,'siswa'])->name('siswa');
route::get('/guru',[GuruController::class,'guru'])->name('guru');


route::get('/tambah_guru',[GuruController::class,'tambahguru'])->name('tambahguru');
Route::post('/guru/store',[GuruController::class,'store']);
Route::delete('/guru/{id}', [GuruController::class,'destroy'])->name('guru.destroy');
Route::get('/guru/{id}/edit_guru',[GuruController::class,'edit']);
Route::put('/guru/{id}',[GuruController::class,'update']);






route::get('/admin',[AdminController::class,'admin'])->name('admin');
Route::delete('/admin/{id}', [AdminController::class,'destroy'])->name('admin.destroy');
route::get('/add_admin',[AdminController::class,'add_admin'])->name('add_admin');
Route::post('/admin/store',[AdminController::class,'store']);
Route::get('/admin/{id}/edit_admin  ',[AdminController::class,'edit']);
Route::put('/admin/{id}',[AdminController::class,'update']);




route::get('/guruu',[GuruuController::class,'guruu'])->name('guruu');
Route::delete('/guruu/{id}', [GuruuController::class,'destroy'])->name('guruu.destroy');
route::get('/add_guruu',[GuruuController::class,'add_guruu'])->name('add_guruu');
Route::post('/guruu/store',[GuruuController::class,'store']);
Route::get('/guruu/{id}/edit_guruu  ',[GuruuController::class,'edit']);
Route::put('/guruu/{id}',[GuruuController::class,'update']);

route::get('/siswaa',[SiswaaController::class,'siswaa'])->name('siswaa');
Route::delete('/siswaa/{id}', [SiswaaController::class,'destroy'])->name('siswaa.destroy');
route::get('/add_siswaa',[siswaaController::class,'add_siswaa'])->name('add_siswaa');
Route::post('/siswaa/store',[SiswaaController::class,'store']);
Route::get('/siswaa/{id}/edit_siswaa  ',[SiswaaController::class,'edit']);
Route::put('/siswaa/{id}',[SiswaaController::class,'update']);

route::get('/calonosis',[OsisController::class,'osis'])->name('osis');
route::get('/add_osis',[OsisController::class,'add_osis'])->name('add_osis');
Route::post('/osis/store',[OsisController::class,'store']);
Route::delete('/osis/{id_calon}', [OsisController::class,'destroy'])->name('osis.destroy');
Route::get('/calonosis/{id_calon}/edit_osis  ',[OsisController::class,'edit']);
Route::put('/calonosis/{id_calon}',[OsisController::class,'update']);