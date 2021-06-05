<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

//Route::post('/statuses',[\App\Http\Controllers\StatusController::class,'store'])->name('statuses.store');

Route::resource('/status',\App\Http\Controllers\StatusController::class)->middleware('auth');
Route::post('/user-create',function(Request  $request){
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password)
    ]);

    return response()->json(['data' => $user],201);

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
