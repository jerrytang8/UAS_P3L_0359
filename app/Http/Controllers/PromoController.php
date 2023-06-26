<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        $promo = DB::table('promo')->get();
        return view('promo.index', [
            'data' => $promo
        ]);
    }

    public function tambah(Request $request)
    {
        $maxdb = DB::table('promo')->max('id');
        if (empty($maxdb)) {
            $newid = 1;
        } else {
            $newid = $maxdb + 1;
        }

        // dd($request);
        DB::table('promo')->insert([
            'id' => $newid,
            'nama' => $request->nama,
            'detail' => $request->detail,
            'jenis' => $request->jenis,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai
        ]);

        return redirect('/promo');
    }

    public function update(Request $request, $id)
    {
        DB::table('promo')->where('id', $id)->update([
            'nama' => $request->nama,
            'detail' => $request->detail,
            'jenis' => $request->jenis,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai
        ]);

        return redirect('/promo');
    }

    public function hapus($id)
    {
        DB::table('promo')->where('id', $id)->delete();

        return redirect('/promo');
    }
}
