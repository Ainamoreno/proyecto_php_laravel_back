<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group([
    'middleware' => 'jwt.auth'
], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'profile']);

    //User
    Route::put('/user', [UserController::class, 'updateUser']);

    //Play
    Route::post('/createparty/{id}', [PartyController::class, 'createParty']);
    Route::get('/getparties/{id}', [PartyController::class, 'getParties']);

    //Party
    Route::post('/getinparty', [PartyController::class, 'getInParty']);
    Route::post('/getoutparty', [PartyController::class, 'getOutParty']);

    //Message
    Route::post('/message', [MessageController::class, 'postMessage']);
    Route::put('/message/{id}', [MessageController::class, 'updateMessage']);
    Route::delete('/message/{id}', [MessageController::class, 'deleteMessage']);
    Route::get('/messages/{id}', [MessageController::class, 'getMessages']);
});
