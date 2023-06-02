<?php

use App\Http\Controllers\CrudvgaController;
use App\Http\Controllers\KalkulatorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mahasiswaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;


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
//halaman login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('mahasiswa', [HomeController::class, 'mahasiswa'])->name('mahasiswa')->middleware('auth');



//route kalkulator
Route::get('/kalkulator', function () {
    return view('defvin');
});
//route untuk crud mahasiswa
Route::resource('/mahasiswa', mahasiswaController::class); 

Route::get('/Crudvga', 'CrudvgaController@index');
// Route::delete('hapus-data-mhs/{$id}', [mahasiswaController::class, 'destroy']);

// Route::get('/welcome', function () {
//     return view('welcome');
// });
// Route::get('/login', function () {
//     return view('defvin2');
// });

Route::post('/hitung',[KalkulatorController::class,'index'] );
return view('hasil');
//Route::post('/hitung',[KalkulatorController::class,'index_1'] );
    
//Route::get('/hitung',[kalkulator::class,'index_get'] );


//nggo  crud vga
