<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LogoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





//backend
Route::get("/users", [AdminController::class, "user"]);
Route::get("/deleteuser/{id}", [AdminController::class, "deleteuser"]);
Route::get("/foodmenu", [AdminController::class, "foodmenu"]);
Route::post("/uploadfood", [AdminController::class, "uploadfood"]);
Route::get("/deletemenu/{id}", [AdminController::class, "deletemenu"]);
Route::get("/editmenu/{id}", [AdminController::class, "editmenu"]);
Route::post("/updatemenu/{id}", [AdminController::class, "updatemenu"]);
Route::post("/reservation", [AdminController::class, "reservation"]);
Route::get("/viewreserve", [AdminController::class, "viewreserve"]);
Route::get("/reserve-complete/{id}", [AdminController::class, "reserve_complete"]);
Route::get("/chefmanage", [AdminController::class, "chefmanage"]);
Route::post("/uploadchef", [AdminController::class, "uploadchef"]);
Route::get("/editchef/{id}", [AdminController::class, "editchef"]);
Route::post("/updatechef/{id}", [AdminController::class, "updatechef"]);
Route::get("/deletechef/{id}", [AdminController::class, "deletechef"]);
Route::get("/orders", [AdminController::class, "orders"]);
Route::get("/order-complete/{id}", [AdminController::class, "order_complete"]);
Route::get("/search-order", [AdminController::class, "search_order"]);
Route::get("/breakfast", [AdminController::class, "breakfast"]);
Route::post("/upload-breakfast", [AdminController::class, "uploadbreakfast"]);
Route::get("/dinner", [AdminController::class, "dinner"]);
Route::post("/upload-dinner", [AdminController::class, "uploaddinner"]);
Route::get("/deletebreakfast/{id}", [AdminController::class, "deletebreakfast"]);
Route::get("/deletedinner/{id}", [AdminController::class, "deletedinner"]);


//Frontend
Route::get("/redirects", [HomeController::class, "redirects"]);
Route::get("/", [HomeController::class, "index"]);
Route::get("/home", [HomeController::class, "index2"]);
Route::post("/addcart/{id}", [HomeController::class, "addcart"]);
Route::get("/showcart/{id}", [HomeController::class, "showcart"]);
Route::get("/deletecart/{id}", [HomeController::class, "deletecart"]);
Route::post("/orderconfirm", [HomeController::class, "orderconfirm"]);

//logout
Route::get("/logout", [LogoutController::class, "logout"]);



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
