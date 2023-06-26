<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        $kelas = DB::table('kelas')->get();
        return view('kelas.index', [
            'data' => $kelas
        ]);
    }

    public function tambah(Request $request)
    {
        $maxdb = DB::table('kelas')->max('id');
        if (empty($maxdb)) {
            $newid = 1;
        } else {
            $newid = $maxdb + 1;
        }
        DB::table('kelas')->insert([
            'id' => $newid,
            'nama' => $request->nama,
            'harga' => $request->harga
        ]);

        return redirect('/kelas');
    }

    public function update(Request $request, $id)
    {
        DB::table('kelas')->where('id', $id)->update([
            'nama' => $request->nama,
            'harga' => $request->harga
        ]);

        return redirect('/kelas');
    }

    public function hapus($id)
    {
        DB::table('kelas')->where('id', $id)->delete();

        return redirect('/kelas');
    }
}
