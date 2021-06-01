<?php



Route::group(['middleware'=>['api', 'cors' => \App\Http\Middleware\Cors::class]],function (){
    Route::post('auth/register', 'Auth\ApiRegisterController@register');
});




Route::middleware('apiJWT')->group(function() {
    Route::apiResource('pessoas','api\PessoaController');
});
