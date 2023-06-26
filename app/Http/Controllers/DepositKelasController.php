<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepositKelasController extends Controller
{
    public function index()
    {
        $aktivasi = DB::table('transaksi')->where('jenis_transaksi', '03')
            ->join('member', 'transaksi.member', '=', 'member.memberid')
            ->join('kasir', 'transaksi.kasir', '=', 'kasir.kasirid')
            ->select('transaksi.*', 'member.nama as nama_member', 'kasir.nama as nama_kasir')
            ->get();
        // dd($aktivasi);
        return view('deposit_kelas.index', [
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
        $kelas = DB::table('kelas_paket')
            ->select('kelas_paket.*', 'kelas.nama as nama_kelas')
            ->join('kelas', 'kelas_paket.kelas', '=', 'kelas.id')->get();
        return view('deposit_kelas.tambah', [
            'member' => $member,
            'kelas' => $kelas,
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
        $kelas = DB::table('kelas_paket')->where('id', $request->kelas)->first();
        $deposit = DB::table('kelas_deposit')->where('memberid', $request->member)->where('id_kelas', $kelas->kelas)->first();
        if ($deposit) {
            if (($deposit->sisa_deposit > 0) or ($deposit->masa_aktif > date('Y-m-d H:i:s'))) {
                return redirect('/deposit_kelas/tambah')->with('gagal', 'Paket Sebelumnya Masih Berlaku!');
            }
        }

        $tgl_now = date('Y-m-d H:i:s');
        $masa_aktif = date('Y-m-d H:i:s', strtotime('+' . $kelas->durasi . ' months', strtotime($tgl_now)));
        // dd($masa_aktif);
        $kasir = session('username');
        $member = DB::table('member')->where('memberid', $request->member)->first();

        // dd($total_deposit);
        DB::table('transaksi')->insert([
            'id' => $newid,
            'no_struk' => $request->no_struk,
            'tanggal' => $tgl_now,
            'jenis_transaksi' => '03',
            'member' => $request->member,
            'kasir' => $kasir,
            'jumlah' => $kelas->harga,
            'kelas_paket' => $request->kelas,
            'masa_aktif_member' => $masa_aktif
        ]);

        if ($deposit > 0) {
            DB::table('kelas_deposit')->where('memberid', $request->member)->where('id_kelas', $kelas->kelas)
                ->update([
                    'sisa_deposit' => ($kelas->sesi + $kelas->gratis),
                    'masa_aktif' => $masa_aktif
                ]);
        } else {
            DB::table('kelas_deposit')
                ->insert([
                    'memberid' => $request->member,
                    'id_kelas' => $kelas->kelas,
                    'sisa_deposit' => ($kelas->sesi + $kelas->gratis),
                    'masa_aktif' => $masa_aktif
                ]);
        }

        return redirect('/deposit_kelas');
    }

    public function cetak($id)
    {
        // dd($id);
        $data = DB::table('transaksi')
            ->join('member', 'transaksi.member', '=', 'member.memberid')
            ->join('kasir', 'transaksi.kasir', '=', 'kasir.kasirid')
            ->join('kelas_paket', 'transaksi.kelas_paket', '=', 'kelas_paket.id')
            ->join('kelas', 'kelas_paket.kelas', '=', 'kelas.id')
            ->select('transaksi.*', 'member.nama as nama_member', 'kasir.nama as nama_kasir', 'kelas_paket.nama as nama_paket', 'kelas.harga as harga1', 'kelas.nama as jenis_kelas', 'kelas_paket.sesi', 'kelas_paket.gratis')
            ->where('transaksi.id', $id)->first();
        // dd($data);
        return view('deposit_kelas.cetak', [
            'data' => $data
        ]);
    }

    public function hapus($id)
    {
        DB::table('transaksi')->where('id', $id)->delete();

        return redirect('/deposit_kelas');
    }
}
