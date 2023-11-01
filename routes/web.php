<?php

use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $filePath = public_path('pdf\activity.pdf');

    return view('newpage', compact('filePath'));
});

Route::get('/pdff', [PdfController::class,'show'])->name('pdf.show');
Route::get('/get-pdf-page/{page}', [PdfController::class,'getPdfPage']);

