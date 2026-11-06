<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class BarangController extends Controller
{
    private function rules(): array
    {
        return [
            'nama'     => 'required|max:45',
            'jenis'    => 'required|in:M,N,L',
            'idsatuan' => 'required|integer',
            'harga'    => 'required|integer|min:0',
            'status'   => 'required|in:0,1',
        ];
    }

    private function daftarSatuan(): array
    {
        return DB::select("SELECT idsatuan, nama_satuan FROM satuan WHERE status = 1 ORDER BY nama_satuan");
    }

    public function index()
    {
        $rows = DB::select(
            "SELECT b.idbarang, b.nama, b.jenis, s.nama_satuan, b.harga, b.status
             FROM barang b
             JOIN satuan s ON s.idsatuan = b.idsatuan
             ORDER BY b.idbarang"
        );
        return view('barang.index', ['rows' => $rows]);
    }

    public function create()
    {
        return view('barang.form', ['row' => null, 'satuan' => $this->daftarSatuan()]);
    }

    public function store(Request $request)
    {
        $d = $request->validate($this->rules());

        DB::insert(
            "INSERT INTO barang (jenis, nama, idsatuan, status, harga) VALUES (?, ?, ?, ?, ?)",
            [$d['jenis'], $d['nama'], $d['idsatuan'], $d['status'], $d['harga']]
        );

        return redirect()->route('barang.index')->with('ok', 'Barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $found = DB::select(
            "SELECT idbarang, jenis, nama, idsatuan, status, harga FROM barang WHERE idbarang = ?",
            [$id]
        );
        abort_if(empty($found), 404);
        return view('barang.form', ['row' => $found[0], 'satuan' => $this->daftarSatuan()]);
    }

    public function update(Request $request, $id)
    {
        $d = $request->validate($this->rules());

        DB::update(
            "UPDATE barang SET jenis = ?, nama = ?, idsatuan = ?, status = ?, harga = ? WHERE idbarang = ?",
            [$d['jenis'], $d['nama'], $d['idsatuan'], $d['status'], $d['harga'], $id]
        );

        return redirect()->route('barang.index')->with('ok', 'Barang berhasil diubah.');
    }

    public function destroy($id)
    {
        try {
            DB::delete("DELETE FROM barang WHERE idbarang = ?", [$id]);
        } catch (QueryException $e) {
            return redirect()->route('barang.index')
                ->with('err', 'Barang tidak bisa dihapus karena sudah dipakai di transaksi. Ubah statusnya menjadi nonaktif.');
        }
        return redirect()->route('barang.index')->with('ok', 'Barang berhasil dihapus.');
    }
}
