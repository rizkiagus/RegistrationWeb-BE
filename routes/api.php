<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\BerkasController;
use App\Http\Controllers\API\OrangtuaController;
use App\Http\Controllers\API\SiswaController;
use App\Models\Berkas;
use App\Models\Orangtua;
use App\Models\Siswa;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
//API ADMIN
Route::post('admin/add', [AdminController::class, 'regis']);
Route::post('login', [AdminController::class, 'login']);


//API SISWA
Route::get('siswa', [SiswaController::class, 'getsiswa']);
Route::post('siswa/{id}/update', [SiswaController::class, 'update']);
Route::post('daftar', [SiswaController::class, 'store']);
Route::get('siswa/detail/{id}', [SiswaController::class, 'siswabyid']);
Route::get('siswa/jurusantkr', [SiswaController::class, 'jurusantkr']);
Route::get('siswa/jurusantkj', [SiswaController::class, 'jurusantkj']);
Route::get('siswa/tahunajaran/{tahun}', [SiswaController::class, 'getDataByTahun']);


//API ORANGTUA
Route::post('orangtua', [OrangtuaController::class, 'store']);

// API BERKAS
Route::post('berkas', [BerkasController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
