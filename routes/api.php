<?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthController;


    use App\Http\Controllers\AboutPageController;


    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });


    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


    // about us
    Route::get('/about', [AboutPageController::class, 'index']);
    Route::middleware('auth:sanctum')->post('/about/update', [AboutPageController::class, 'update']); // Обновить данные о странице "О нас"
