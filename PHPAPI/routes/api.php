<?php



Route::group(['middleware'=>['api', 'cors' => \App\Http\Middleware\Cors::class]],function (){
    Route::post('auth/register', 'Auth\ApiRegisterController@register')->name('user.store');
    Route::post('auth/login', 'api\AuthController@login');
    Route::delete('auth/destroy/{id}', 'auth\ApiRegisterController@destroy');

});
Route::post('auth/refresh', 'api\AuthController@refresh');

Route::group(['middleware'=>['api','apiJWT', 'cors' => \App\Http\Middleware\Cors::class]],function() {
    Route::apiResource('pessoas','api\PessoaController');
    Route::post('auth/logout', 'api\AuthController@logout');


});

Route::post('categories', [\App\Http\Controllers\api\CategoryController::class,'store'])->name('categories.store');
Route::post('cards', [\App\Http\Controllers\api\CardController::class,'store'])->name('cards.store');
Route::post('accounts', [\App\Http\Controllers\api\AccountController::class,'store'])->name('accounts.store');
Route::post('expenditures', [\App\Http\Controllers\api\ExpenditureController::class,'store'])->name('expenditure.store');
Route::post('incomings', [\App\Http\Controllers\api\IncomingController::class,'store'])->name('incoming.store');


