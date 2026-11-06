<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class VendorController extends Controller
{
    public function index()
    {
        $rows = DB::select(
            "SELECT idvendor, nama_vendor, badan_hukum, status FROM vendor ORDER BY idvendor"
        );
        return view('vendor.index', ['rows' => $rows]);
    }

    public function create()
    {
        return view('vendor.form', ['row' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_vendor' => 'required|max:100',
            'badan_hukum' => 'required|in:P,C,U,N',
            'status'      => 'required|in:A,N',
        ]);

        DB::insert(
            "INSERT INTO vendor (nama_vendor, badan_hukum, status) VALUES (?, ?, ?)",
            [$data['nama_vendor'], $data['badan_hukum'], $data['status']]
        );

        return redirect()->route('vendor.index')->with('ok', 'Vendor berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $found = DB::select(
            "SELECT idvendor, nama_vendor, badan_hukum, status FROM vendor WHERE idvendor = ?",
            [$id]
        );
        abort_if(empty($found), 404);
        return view('vendor.form', ['row' => $found[0]]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_vendor' => 'required|max:100',
            'badan_hukum' => 'required|in:P,C,U,N',
            'status'      => 'required|in:A,N',
        ]);

        DB::update(
            "UPDATE vendor SET nama_vendor = ?, badan_hukum = ?, status = ? WHERE idvendor = ?",
            [$data['nama_vendor'], $data['badan_hukum'], $data['status'], $id]
        );

        return redirect()->route('vendor.index')->with('ok', 'Vendor berhasil diubah.');
    }

    public function destroy($id)
    {
        try {
            DB::delete("DELETE FROM vendor WHERE idvendor = ?", [$id]);
        } catch (QueryException $e) {
            return redirect()->route('vendor.index')
                ->with('err', 'Vendor tidak bisa dihapus karena sudah dipakai di data pengadaan.');
        }
        return redirect()->route('vendor.index')->with('ok', 'Vendor berhasil dihapus.');
    }
}
