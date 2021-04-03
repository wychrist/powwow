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
    $appKey = 'f3c81d3408ab29d549f6ceba187b96eb862814041773574ee0884a4e8c09cb8e';
    $appSecret = 'e98d39aa17768e9c50efaabe787449b38cc0a6721e64d5db57837fab7562a56b';
    $socketId = request()->input('socket_id', '');
    $channelName = request()->input('channel_name', '');

    if (strstr($channelName, 'presence-') !== false) {
        $channelData = json_encode([
            'user_id' => 1,
            'user_info' => [
                'username' => 'awesomeuser',
                'roles' => ['admin', 'customer']
            ]
        ]);

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
