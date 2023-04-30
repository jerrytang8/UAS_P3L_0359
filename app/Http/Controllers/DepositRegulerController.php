<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepositRegulerController extends Controller
{
    public function index()
    {
        $aktivasi = DB::table('transaksi')->where('jenis_transaksi', '02')
            ->join('member', 'transaksi.member', '=', 'member.memberid')
            ->join('kasir', 'transaksi.kasir', '=', 'kasir.kasirid')
            ->select('transaksi.*', 'member.nama as nama_member', 'kasir.nama as nama_kasir')
            ->get();
        // dd($aktivasi);
        return view('deposit_reguler.index', [
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
        return view('deposit_reguler.tambah', [
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
        $kasir = session('username');
        $member = DB::table('member')->where('memberid', $request->member)->first();

        if ($request->jumlah >= 3000000) {
            $bonus = 300000;
        } else {
            $bonus = 0;
        }
        $total_deposit = $request->jumlah + $bonus + $member->sisa_deposit;
        // dd($total_deposit);
        DB::table('transaksi')->insert([
            'id' => $newid,
            'no_struk' => $request->no_struk,
            'tanggal' => $tgl_now,
            'jenis_transaksi' => '02',
            'member' => $request->member,
            'kasir' => $kasir,
            'jumlah' => $request->jumlah,
            'bonus_deposit' => $bonus,
            'sisa_deposit' => $member->sisa_deposit,
            'total_deposit' => $total_deposit
        ]);
        DB::table('member')->where('memberid', $request->member)->update([
            'sisa_deposit' => $total_deposit
        ]);

        return redirect('/deposit_reguler');
    }

    public function cetak($id)
    {
        // dd($id);
        $data = DB::table('transaksi')
            ->join('member', 'transaksi.member', '=', 'member.memberid')
            ->join('kasir', 'transaksi.kasir', '=', 'kasir.kasirid')
            ->select('transaksi.*', 'member.nama as nama_member', 'kasir.nama as nama_kasir')
            ->where('transaksi.id', $id)->first();
        return view('deposit_reguler.cetak', [
            'data' => $data
        ]);
    }

    public function hapus($id)
    {
        DB::table('transaksi')->where('id', $id)->delete();

        return redirect('/deposit_reguler');
    }
}
