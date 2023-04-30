<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AktivasiController extends Controller
{
    public function index()
    {
        $aktivasi = DB::table('transaksi')->where('jenis_transaksi', '01')
            ->join('member', 'transaksi.member', '=', 'member.memberid')
            ->join('kasir', 'transaksi.kasir', '=', 'kasir.kasirid')
            ->select('transaksi.*', 'member.nama as nama_member', 'kasir.nama as nama_kasir')
            ->get();
        // dd($aktivasi);
        return view('aktivasi.index', [
            'data' => $aktivasi
        ]);
    }

    public function tambah()
    {
        $maxdb = DB::table('transaksi')->max('id');
        if (empty($maxdb)) {
            $newid = 1;
        } else {
            $newid = $maxdb + 1;
        }
        $aktivasiid = date('y') . "." . date('m') . "." . $newid;
        $member = DB::table('member')->get();
        return view('aktivasi.tambah', [
            'member' => $member,
            'aktivasiid' => $aktivasiid
        ]);
    }

    public function save(Request $request)
    {
        $maxdb = DB::table('transaksi')->max('id');
        if (empty($maxdb)) {
            $newid = 1;
        } else {
            $newid = $maxdb + 1;
        }
        $tgl_now = date('Y-m-d H:i:s');
        $tgl_satu_tahun = date('Y-m-d H:i:s', strtotime('+1 year', strtotime($tgl_now)));
        $kasir = session('username');
        // dd($kasir);
        DB::table('transaksi')->insert([
            'id' => $newid,
            'no_struk' => $request->no_struk,
            'tanggal' => $tgl_now,
            'jenis_transaksi' => '01',
            'member' => $request->member,
            'kasir' => $kasir,
            'masa_aktif_member' => $tgl_satu_tahun,
            'jumlah' => $request->jumlah
        ]);
        DB::table('member')->where('memberid', $request->member)->update([
            'status' => 1,
            'masa_aktif' => $tgl_satu_tahun
        ]);

        return redirect('/aktivasi');
    }

    public function cetak($id)
    {
        // dd($id);
        $data = DB::table('transaksi')
            ->join('member', 'transaksi.member', '=', 'member.memberid')
            ->join('kasir', 'transaksi.kasir', '=', 'kasir.kasirid')
            ->select('transaksi.*', 'member.nama as nama_member', 'kasir.nama as nama_kasir')
            ->where('transaksi.id', $id)->first();
        return view('aktivasi.cetak', [
            'data' => $data
        ]);
    }

    public function hapus($id)
    {
        DB::table('transaksi')->where('id', $id)->delete();

        return redirect('/aktivasi');
    }
}
