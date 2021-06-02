<?php



Route::group(['middleware'=>['api', 'cors' => \App\Http\Middleware\Cors::class]],function (){
    Route::post('auth/register', 'Auth\ApiRegisterController@register');
    Route::post('auth/login', 'api\AuthController@login');

});
Route::post('auth/refresh', 'api\AuthController@refresh');
Route::middleware('apiJWT')->group(function() {
    Route::apiResource('pessoas','api\PessoaController');
    Route::post('auth/logout', 'api\AuthController@logout');

});
