<?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\ProjectPageController;
    use App\Http\Controllers\AchievementController;
    use App\Http\Controllers\MemberPageController;
    use App\Http\Controllers\OrderController;

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


    Route::get('/project-pages', [ProjectPageController::class, 'index']);
    Route::get('/project-pages/{id}', [ProjectPageController::class, 'show']);
    Route::post('/project-pages', [ProjectPageController::class, 'store']);
    Route::put('/project-pages/{id}', [ProjectPageController::class, 'update']);



    Route::get('/achievements', [AchievementController::class, 'index']);
    Route::post('/achievements', [AchievementController::class, 'store']);
    Route::get('/achievements/{id}', [AchievementController::class, 'show']);
    Route::put('/achievements/{id}', [AchievementController::class, 'update']);
    Route::delete('/achievements/{id}', [AchievementController::class, 'destroy']);





    Route::get('/member-pages', [MemberPageController::class, 'index']);
    Route::post('/member-pages', [MemberPageController::class, 'store']);
    Route::get('/member-pages/{id}', [MemberPageController::class, 'show']);
    Route::put('/member-pages/{id}', [MemberPageController::class, 'update']);
    Route::delete('/member-pages/{id}', [MemberPageController::class, 'destroy']);



    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::put('/orders/{id}', [OrderController::class, 'update']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
