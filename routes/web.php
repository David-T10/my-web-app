<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/data', function ($data) {
    return view('welcome', ['data' => $data]);
});*/ 

Route::get('/home', function () {
    return "This is the home page";
});

Route::get("/anotherHome", function () {
    return "This is the second home page";
});

Route::redirect("/anotherHome", "/home", 301);

Route::get('users/{id?}', function($id = "Mystery"){
    return "User Page ".$id;
});

Route::get("users/{id}/comment/{commentId}", function($id, $commentId){
    return "User Page ".$id." Comment Id: ".$commentId;
});