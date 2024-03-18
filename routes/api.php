<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\PenghargaanController;
use App\Http\Controllers\PenangananController;
use App\Http\Controllers\SiswaController;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
// use Auth; 

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();  

});
route::get('siswa',[SiswaController::class,'SiswaAPI']);
route::post('siswa/update/{id_siswa}',[SiswaController::class,'updateAPI']);

route::get('pelanggaran/show',[PelanggaranController::class,'show']);
route::get('penghargaan/show',[PenghargaanController::class,'show']);
route::get('penanganan/show', [PenangananController::class, 'show']);



route::post('siswa',function(Request $request){
    $valid = Auth::attempt($request->all());

    if($valid){
        $siswa = Auth::Siswa();
        $siswa->api_token = Str::random(100);
        $siswa->save();

        // $user->makeVisible('api_token');

        return $siswa;
    }
    return response()->json([
        'message'=> 'email & password doesn\'t match'
    ],404);

});
route::get('siswa',[SiswaController::class,'SiswaAPI']);
route::post('login',[SiswaController::class,'loginapi']);

// route::post('siswa',function(Request $request){
//     $valid = Auth::attempt($request->all());

//     if($valid){
//         $siswa = Auth::Siswa();
//         $siswa->api_token = Str::random(100);
//         $siswa->save();

//         // $user->makeVisible('api_token');

//         return $siswa;
//     }
//     return response()->json([
//         'message'=> 'email & password doesn\'t match'
//     ],404);
// });
