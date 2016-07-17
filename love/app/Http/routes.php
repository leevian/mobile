<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('/invite', 'WelcomeController@invite');
Route::get('/addcp', 'WeixinController@addCp');
// Route::get('/api/v1/index', 'WeixinController@valid');
Route::resource('/api/v1/index', 'WeixinController@valid');
Route::get('/dateInfo', 'WeixinController@dateInfo');
Route::get('/test', 'WelcomeController@getAccessToken');
Route::get('/showInfo', 'WelcomeController@showInfo');
Route::resource('/response', 'WeixinController@responseMsg');
Route::get('/api/v1/index','WeixinController@valid');
Route::post('/api/v1/index',['middleware' => 'middlewareCORS','uses'=>'WeixinController@valid']);
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
//微信接口
Route::resource('api/v1', 'WeixinController');
Route::filter('weixin', function()
{
    // 获取到微信请求里包含的几项内容
    $signature = Input::get('signature');
    $timestamp = Input::get('timestamp');
    $nonce     = Input::get('nonce');
    
    // ninghao 是我在微信后台手工添加的 token 的值
    $token = 'ninghao';
    
    // 加工出自己的 signature
    $our_signature = array($token, $timestamp, $nonce);
    sort($our_signature, SORT_STRING);
    $our_signature = implode($our_signature);
    $our_signature = sha1($our_signature);
    
    // 用自己的 signature 去跟请求里的 signature 对比
    if ($our_signature != $signature) {
        return false;
    }
});