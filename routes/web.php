<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\VisitorController;

Route::get('/', function () {
    return redirect()->route('visitors.index');
});

// Visitor management routes
Route::resource('visitors', VisitorController::class);

// Temporary database SSL diagnostic
Route::get('/db-check', function () {

    $options = config('database.connections.mysql.options', []);

    $caPath = extension_loaded('pdo_mysql')
        ? ($options[PDO::MYSQL_ATTR_SSL_CA] ?? null)
        : null;

    $diagnostics = [
        'pdo_mysql_enabled' => extension_loaded('pdo_mysql'),
        'ssl_ca_configured' => !empty($caPath),
        'ssl_ca_path' => $caPath,
        'ssl_ca_file_exists' => $caPath ? file_exists($caPath) : false,
        'ssl_ca_readable' => $caPath ? is_readable($caPath) : false,
        'laravel_config_cached' => app()->configurationIsCached(),
    ];

    try {
        DB::connection()->getPdo();

        return response()->json([
            'status' => 'success',
            'diagnostics' => $diagnostics,
            'message' => 'Render successfully connected to Aiven MySQL!'
        ]);

    } catch (\Throwable $e) {

        return response()->json([
            'status' => 'error',
            'diagnostics' => $diagnostics,
            'error' => $e->getMessage()
        ], 500);
    }
});
