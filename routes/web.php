<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('stream', function () {
    $path = 'storage/test.mp4';
    $headers = [
        'Content-Type'        => 'video/mp2t',
        'Content-Length'      => File::size($path),
        'Content-Disposition' => 'attachment; filename="test.ts"'
    ];

    return Response::stream(function() use ($path) {
//        $toggle = Manager::query()->find(1); // just an example
        try {
//            if ($toggle->is_active) {
            if (true) {
//                $toggle->update(['is_active' => false]);
                $stream = fopen($path, 'r');
                fpassthru($stream);
            } else {
                throw new Exception();
            }

        } catch(Exception $e) {
            dd('not found');
        }
    }, 200, $headers);
});
