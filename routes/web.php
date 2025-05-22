<?php

use Illuminate\Support\Facades\Route;

Route::get('/docker-containers', function () {
    $containers = shell_exec('docker ps --format "{{.Names}} {{.Status}}"');
    dd($containers);
});
