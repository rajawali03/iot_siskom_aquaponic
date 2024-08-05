<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MSensor;

class Sensorlaravel extends Controller
{
    public function baca_sisamakanan()
    {
        //baca nilai /isi tabel post_table_aquaponic dan ambil nilai sisa_makanan
        $sensor = MSensor::select('*')->get();
        //kirim ketampilan baca suhu (buat view baca suhu)
        return view('baca_sisamakanan', ['nilaisensor' => $sensor]);
    }

    public function baca_kekeruhan()
    {
        //baca nilai /isi tabel post_table_aquaponic dan ambil nilai sisa_makanan
        $sensor = MSensor::select('*')->get();
        //kirim ketampilan baca suhu (buat view baca suhu)
        return view('baca_kekeruhan', ['nilaisensor' => $sensor]);
    }

    public function simpansensor() {
        MSensor::where('id', '1')->update(['sisa_makanan' => request()->nilai_sisamakanan, 'kekeruhan_air' => request()->nilai_kekeruhan]);
    }
}