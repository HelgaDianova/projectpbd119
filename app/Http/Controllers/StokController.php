<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StokController extends Controller
{
    // Menampilkan data dari VIEW v_stok_barang (syarat: tampilan konten dengan view)
    public function index()
    {
        $rows = DB::select(
            "SELECT idbarang, nama_barang, satuan, stok FROM v_stok_barang ORDER BY nama_barang"
        );

        // Memanggil FUNCTION fn_harga_jual() langsung dari SQL
        $harga = DB::select(
            "SELECT idbarang, nama, fn_harga_jual(idbarang) AS harga_jual FROM barang WHERE status = 1"
        );

        return view('stok.index', ['rows' => $rows, 'harga' => $harga]);
    }
}
