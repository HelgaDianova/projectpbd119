<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class SatuanController extends Controller
{
    public function index()
    {
        $rows = DB::select("SELECT idsatuan, nama_satuan, status FROM satuan ORDER BY idsatuan");
        return view('satuan.index', ['rows' => $rows]);
    }

    public function create()
    {
        return view('satuan.form', ['row' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_satuan' => 'required|max:45',
            'status'      => 'required|in:0,1',
        ]);

        DB::insert(
            "INSERT INTO satuan (nama_satuan, status) VALUES (?, ?)",
            [$data['nama_satuan'], $data['status']]
        );

        return redirect()->route('satuan.index')->with('ok', 'Satuan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $found = DB::select("SELECT idsatuan, nama_satuan, status FROM satuan WHERE idsatuan = ?", [$id]);
        abort_if(empty($found), 404);
        return view('satuan.form', ['row' => $found[0]]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_satuan' => 'required|max:45',
            'status'      => 'required|in:0,1',
        ]);

        DB::update(
            "UPDATE satuan SET nama_satuan = ?, status = ? WHERE idsatuan = ?",
            [$data['nama_satuan'], $data['status'], $id]
        );

        return redirect()->route('satuan.index')->with('ok', 'Satuan berhasil diubah.');
    }

    public function destroy($id)
    {
        try {
            DB::delete("DELETE FROM satuan WHERE idsatuan = ?", [$id]);
        } catch (QueryException $e) {
            return redirect()->route('satuan.index')
                ->with('err', 'Satuan tidak bisa dihapus karena masih dipakai data barang.');
        }
        return redirect()->route('satuan.index')->with('ok', 'Satuan berhasil dihapus.');
    }
}
