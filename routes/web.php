
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\VisitorController;

Route::get('/', function () {
    return redirect()->route('visitors.index');
});

Route::resource('visitors', VisitorController::class);

// Temporary database connection test
Route::get('/db-check', function () {
    try {
        DB::connection()->getPdo();

        return response()->json([
            'status' => 'success',
            'message' => 'Render successfully connected to Aiven MySQL!'
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});
