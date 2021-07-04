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



    Route::get('categories', [\App\Http\Controllers\api\CategoryController::class,'index'])->name('categories.index');
    Route::get('categories/{id}', [\App\Http\Controllers\api\CategoryController::class,'show'])->name('categories.show');
    Route::post('categories', [\App\Http\Controllers\api\CategoryController::class,'store'])->name('categories.store');
    Route::put('categories/{id}', [\App\Http\Controllers\api\CategoryController::class,'update'])->name('categories.update');
    Route::delete('categories/{id}', [\App\Http\Controllers\api\CategoryController::class,'destroy'])->name('categories.delete');


    Route::get('cards', [\App\Http\Controllers\api\CardController::class,'index'])->name('cards.index');
    Route::get('cards/{id}', [\App\Http\Controllers\api\CardController::class,'show'])->name('cards.show');
    Route::post('cards', [\App\Http\Controllers\api\CardController::class,'store'])->name('cards.store');
    Route::put('cards/{id}', [\App\Http\Controllers\api\CardController::class,'update'])->name('cards.update');
    Route::delete('cards/{id}', [\App\Http\Controllers\api\CardController::class,'destroy'])->name('cards.delete');


    Route::get('accounts', [\App\Http\Controllers\api\AccountController::class,'index'])->name('accounts.index');
    Route::get('accounts/{id}', [\App\Http\Controllers\api\AccountController::class,'show'])->name('accounts.show');
    Route::post('accounts', [\App\Http\Controllers\api\AccountController::class,'store'])->name('accounts.store');
    Route::put('accounts/{id}', [\App\Http\Controllers\api\AccountController::class,'update'])->name('accounts.update');
    Route::delete('accounts/{id}', [\App\Http\Controllers\api\AccountController::class,'destroy'])->name('accounts.delete');


    Route::get('expenditures', [\App\Http\Controllers\api\ExpenditureController::class,'index'])->name('expenditures.index');
    Route::get('expenditures/{id}', [\App\Http\Controllers\api\ExpenditureController::class,'show'])->name('expenditures.show');
    Route::post('expenditures', [\App\Http\Controllers\api\ExpenditureController::class,'store'])->name('expenditures.store');
    Route::put('expenditures/{id}', [\App\Http\Controllers\api\ExpenditureController::class,'update'])->name('expenditures.update');
    Route::delete('expenditures/{id}', [\App\Http\Controllers\api\ExpenditureController::class,'destroy'])->name('expenditures.delete');


    Route::get('incomings', [\App\Http\Controllers\api\IncomingController::class,'index'])->name('incomings.index');
    Route::get('incomings/{id}', [\App\Http\Controllers\api\IncomingController::class,'show'])->name('incomings.show');
    Route::post('incomings', [\App\Http\Controllers\api\IncomingController::class,'store'])->name('incomings.store');
    Route::put('incomings/{id}', [\App\Http\Controllers\api\IncomingController::class,'update'])->name('incomings.update');
    Route::delete('incomings/{id}', [\App\Http\Controllers\api\IncomingController::class,'destroy'])->name('incomings.delete');



});

