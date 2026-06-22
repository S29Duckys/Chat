<?php

// routes/web.php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Page du chat : /chat?with=SESSION_ID_DU_DESTINATAIRE
Route::get('/chat', [MessageController::class, 'index']);

// Envoi d'un message
Route::post('/chat/send', [MessageController::class, 'send']);