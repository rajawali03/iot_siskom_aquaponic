<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sensorlaravel;

Route::get('/', function () {
    return view('monitoring');
});

Route::get('/baca_sisamakanan', [Sensorlaravel::class, 'baca_sisamakanan']);
Route::get('/baca_kekeruhan', [Sensorlaravel::class, 'baca_kekeruhan']);

//route untuk menyimpan nilai sensor ke tabel post_table_aquaponic
Route::get('simpan/{nilai_sisamakanan}/{nilai_kekeruhan}', [Sensorlaravel::class, 'simpansensor']);