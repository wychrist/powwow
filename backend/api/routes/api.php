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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('pusher/auth', function () {
    $appKey = 'f97b3be0c78ac08b953aa486565786c120e7de03914df750612b9c52afce7528';
    $appSecret = '91a6eda65fd1d51c68f0b63f8127652ad376355a40e06c6ee7860bd9470bb695';
    $socketId = request()->input('socket_id', '');
    $channelName = request()->input('channel_name', '');

    if (strstr($channelName, 'presence-') !== false) {
        $channelData = json_encode(['user_id' => 1]);

        $signature = hash_hmac('sha256', $socketId . ':' . $channelName . ':' . $channelData, $appSecret);
        return [
            'auth' => $appKey . ':' . $signature,
            'channel_data' => $channelData
        ];
    } else {

        $signature = hash_hmac('sha256', $socketId . ':' . $channelName, $appSecret);
        return [
            'auth' => $appKey . ':' . $signature
        ];
    }
});
