<?php

use Illuminate\Support\Facades\Route;

use Modules\Questions\Http\Controllers;

Route::middleware(['languages','web'])->group(function () {
    Route::get('/faq', [Controllers\QuestionController::class, 'index'])->name('questions');

    Route::get('/en/faq', [Controllers\QuestionController::class, 'index'])->name('en.questions');

    Route::get('/es/faq', [Controllers\QuestionController::class, 'index'])->name('es.questions');
});
