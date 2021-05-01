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
    $appKey = '6b48260d49de1e597d2dc78fe92b970b94ea1aca47007b8c098bb0282005dc71';
    $appSecret = '2aa203c260cb6e5050e2f2c127991692ed18b40da5cc7e7cb87b8a2f20463058';
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


Route::get('send-message', function(){
    $data = json_encode([
        'foo' => 'bar'
    ]);

    $appKey = '6b48260d49de1e597d2dc78fe92b970b94ea1aca47007b8c098bb0282005dc71';
    $appSecret = '2aa203c260cb6e5050e2f2c127991692ed18b40da5cc7e7cb87b8a2f20463058';
    $appId = 'b30001ae-63a2-4b14-9be7-ee6ce60551a8';
    $authVersion = '1.0';

    $payload = [
        'name' => 'event_name',
        'channel' => 'channel_name',
        'data' => $data
    ];
    $ts = time();
    $bodyMd5 = md5($data);

    $str = "POST\n/apps/{$appId}/events\nauth_key={$appKey}&auth_timestamp={$ts}&auth_version={$authVersion}&body_md5={$bodyMd5}";
    $str .= '&auth_signature='. hash_hmac('sha256', $str, $appSecret);

    //POST\n/apps/3/events\nauth_key=278d425bdf160c739803&auth_timestamp=1353088179&auth_version=1.0&body_md5=ec365a775a4cd0599faeb73354201b6f
});
