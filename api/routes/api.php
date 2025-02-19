<?php

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

Route::get('/', function () {
    $users=new \App\Models\User;
    if($users->count()){
        return response()->json([
            'message' => 'all systems are a go',
            'users' =>$users->with('weather_data')->get()
        ],200);
    }else{
        return response()->json(['message' => 'No any users yet.',],204);
    }
    
});
