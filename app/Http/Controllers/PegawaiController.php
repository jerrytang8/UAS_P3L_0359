<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $pegawai = DB::table('pegawai')->get();
        return view('pegawai.index', [
            'data' => $pegawai
        ]);
    }

    public function tambah(Request $request)
    {
        $maxdb = DB::table('pegawai')->max('id');
        if (empty($maxdb)) {
            $newid = 1;
        } else {
            $newid = $maxdb + 1;
        }

        // dd($request);
        DB::table('pegawai')->insert([
            'id' => $newid,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon
        ]);

        return redirect('/pegawai');
    }

    public function update(Request $request, $id)
    {
        DB::table('pegawai')->where('id', $id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon
        ]);

        return redirect('/pegawai');
    }

    public function hapus($id)
    {
        DB::table('pegawai')->where('id', $id)->delete();

        return redirect('/pegawai');
    }
}
