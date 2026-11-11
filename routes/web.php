
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;

Route::get('/', function () {
    return redirect()->route('visitors.index');
});

Route::resource('visitors', VisitorController::class);
