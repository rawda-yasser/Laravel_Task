<?php


use App\Http\Controllers\CommentApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostApiController;

// use App\Http\Controllers\ImageApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource("posts", PostApiController::class);
Route::apiResource("posts/{postId}/comments", CommentApiController::class);
Route::get("/posts/{postId}/image", [PostApiController::class, 'getImagePath']);