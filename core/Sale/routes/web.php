<?php

Route::namespace('Core\Sale\Controllers\Web')->prefix('admin')->name('admin.')->group(function () {
    #*** Ex: START: Sale ***#
    // Route::resource('sales', 'SaleController')->except([
    //    'store', 'update', 'destroy'
    // ]);
    #*** END: Sale ***#
});
