<?php

Route::group(['prefix' => 'api', 'middleware' => []], function () {
    # V1
    Route::namespace('Core\Sale\Controllers\API\V1')->prefix('v1')->name('api.v1.')->group(function () {
        #*** Ex: START: Sale ***#
        // Route::apiResource('sales', 'SaleController');
        #*** END: Sale ***#
    });
});
