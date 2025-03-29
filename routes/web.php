<?php

use Illuminate\Support\Facades\Route;
use Suraj\Contactform\Http\Controllers\ContactFormController;


Route::middleware(['guest','web'])->group(function(){
    Route::get('/contact', [ContactFormController::class, 'create'] );
    Route::post('/submit/message', [ContactFormController::class, 'store'] )->name('contact.store');

});
