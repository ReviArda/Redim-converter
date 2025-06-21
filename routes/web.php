<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileConverterController;

// Landing page
Route::get('/', [FileConverterController::class, 'index'])->name('home');

// Page routes
Route::get('/about', [FileConverterController::class, 'about'])->name('about');
Route::get('/guide', [FileConverterController::class, 'guide'])->name('guide');

// Feature pages
Route::get('/compress-image', [FileConverterController::class, 'compressImage'])->name('compress-image');
Route::get('/compress-pdf', [FileConverterController::class, 'compressPdf'])->name('compress-pdf');
Route::get('/word-to-pdf', [FileConverterController::class, 'wordToPdf'])->name('word-to-pdf');
Route::get('/image-to-pdf', [FileConverterController::class, 'imageToPdf'])->name('image-to-pdf');

// Process routes with middleware
Route::middleware(['validate.file'])->group(function () {
    Route::post('/process/compress-image', [FileConverterController::class, 'processCompressImage'])->name('process.compress-image');
    Route::post('/process/compress-pdf', [FileConverterController::class, 'processCompressPdf'])->name('process.compress-pdf');
    Route::post('/process/word-to-pdf', [FileConverterController::class, 'processWordToPdf'])->name('process.word-to-pdf');
    Route::post('/process/image-to-pdf', [FileConverterController::class, 'processImageToPdf'])->name('process.image-to-pdf');
});
