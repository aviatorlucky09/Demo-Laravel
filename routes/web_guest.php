<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\SearchController;

Route::group(['middleware'=>'HtmlMinifier'], function(){ 
    Auth::routes();

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('homepage');

    /********* Search ******/
    Route::get('/search', [SearchController::class, 'index'])->name('search');

    /******* ental-operator-inquiry */
    Route::get('/operator-inquiry', [App\Http\Controllers\Guest\OperatorInquiryController::class, 'index'])->name('operator-inquiry');
    Route::post('/operator-inquiry', [App\Http\Controllers\Guest\OperatorInquiryController::class, 'update'])->name('operator-inquiry-post');
});


