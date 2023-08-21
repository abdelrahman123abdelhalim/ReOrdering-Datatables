<?php

use App\Http\Controllers\ReOrderController;

Route::get('getsortabledatatable', [ReOrderController::class, 'showDatatable'])->name('reorder');
Route::post('sortabledatatable', [ReOrderController::class, 'update'])->name('update');