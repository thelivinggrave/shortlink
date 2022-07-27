<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

Route::get("/", [IndexController::class, "index"])->name("index");
Route::post("/ajax", [IndexController::class, "ajax"])->name("ajax");

Route::get("/{code}", [IndexController::class, "redirect_to"])
    ->where(["code" => "[0-9a-z]{4,}"])
    ->name("redirect_to");
