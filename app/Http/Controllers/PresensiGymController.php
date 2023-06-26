<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresensiGymController extends Controller
{
    public function index()
    {
        $aktivasi = DB::table('transaksi')->where('jenis_transaksi', '04')
            ->join('member', 'transaksi.member', '=', 'member.memberid')
            ->join('kasir', 'transaksi.kasir', '=', 'kasir.kasirid')
            ->select('transaksi.*', 'member.nama as nama_member', 'kasir.nama as nama_kasir')
            ->get();

        return view('presensi_gym.index', [
            'data' => $aktivasi
        ]);
    }

    public function scan()
    {
        return view('presensi_gym.scan');
    }

    public function cek_member(Request $request)
    {
        $hasil = url('/presensi_gym/' . $request->qr_code . '/absensi');
        return response()->json($hasil);
    }

    public function absensi($id)
    {
        // dd($id);
        $maxdb = DB::table('transaksi')->max('id');
        if (empty($maxdb)) {
            $newid = 1;
        } else {
            $newid = $maxdb + 1;
        }
        $no_struk = date('y') . "." . date('m') . "." . $newid;
        $member = DB::table('member')->where('memberid', $id)->first();
        $jam = DB::table('jam')->get();
        return view('presensi_gym.tambah', [
            'memberid' => $id,
            'member' => $member,
            'jam' => $jam,
            'no_struk' => $no_struk
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
        $kasir = session('username');
        $member = DB::table('member')->where('memberid', $request->member)->first();

        // dd($total_deposit);
        DB::table('transaksi')->insert([
            'id' => $newid,
            'no_struk' => $request->no_struk,
            'tanggal' => $tgl_now,
            'jenis_transaksi' => '04',
            'member' => $request->member,
            'kasir' => $kasir,
            'waktu' => $request->waktu
        ]);

        return redirect('/presensi_gym');
    }

    public function cetak($id)
    {
        // dd($id);
        $data = DB::table('transaksi')
            ->join('member', 'transaksi.member', '=', 'member.memberid')
            ->join('kasir', 'transaksi.kasir', '=', 'kasir.kasirid')
            ->select('transaksi.*', 'member.nama as nama_member', 'kasir.nama as nama_kasir')
            ->where('transaksi.id', $id)->first();
        return view('presensi_gym.cetak', [
            'data' => $data
        ]);
    }

    public function hapus($id)
    {
        DB::table('transaksi')->where('id', $id)->delete();

        return redirect('/presensi_gym');
    }
}
