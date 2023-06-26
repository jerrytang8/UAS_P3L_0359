<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresensiKelasController extends Controller
{
    public function index()
    {
        $cek_data = DB::table('instruktur')->where('instrukturid', session('username'))->first();
        $data = DB::table('jadwal_harian')
            ->selectRaw('jadwal_harian.*,kelas.nama as kelas, jam_kelas.slot as jam')
            // ->join('instruktur', 'jadwal_harian.id_instruktur', '=', 'instruktur.id')
            ->join('jam_kelas', 'jadwal_harian.id_jam', '=', 'jam_kelas.id')
            ->join('kelas', 'jadwal_harian.id_kelas', '=', 'kelas.id')
            // ->leftJoin('instruktur AS ins2', 'jadwal_harian.id_instruktur2', '=', 'ins2.id')
            ->where('id_instruktur', $cek_data->id)
            ->orwhere('id_instruktur2', $cek_data->id)
            ->orderBy('id', 'desc')
            ->get();
        // dd($data);
        return view('presensi_kelas.index', [
            'data' => $data
        ]);
    }

    public function absen_member($id)
    {
        $Token = 'ddf52faf2605806145a7ca3bb2279fffda12d9a947f2532f5caab19175d37fec';
        $cmd    = 'child';
        $code     = 'THREE';
        // dd(hash('sha256', $cmd . $code . $Token));
        $data = DB::table('transaksi')
            ->join('member', 'transaksi.member', '=', 'member.memberid')
            ->join('kasir', 'transaksi.kasir', '=', 'kasir.kasirid', 'left')
            ->join('jenis_transaksi', 'transaksi.jenis_transaksi', '=', 'jenis_transaksi.kode')
            ->select('transaksi.*', 'member.nama as nama_member', 'kasir.nama as nama_kasir', 'jenis_transaksi.keterangan')
            ->where('transaksi.jadwal_har', $id)
            ->Where(function ($query) {
                $query->where('jenis_transaksi', '05')
                    ->orwhere('jenis_transaksi', '06');
            })
            ->get();

        $kelas = DB::table('jadwal_harian')
            ->join('kelas', 'jadwal_harian.id_kelas', '=', 'kelas.id')
            ->where('jadwal_harian.id', $id)
            ->first();

        $member = DB::table('member')->get();
        // dd($data);
        return view('presensi_kelas.absen_member', [
            'data' => $data,
            'jadwal_har' => $id,
            'member' => $member,
            'kelas' => $kelas->nama,
        ]);
    }

    public function save_absensi(Request $request)
    {
        $maxdb = DB::table('transaksi')->max('id');
        if (empty($maxdb)) {
            $newid = 1;
        } else {
            $newid = $maxdb + 1;
        }
        $tgl_now = date('Y-m-d H:i:s');
        $no_struk = date('y') . "." . date('m') . "." . $newid;
        $jadwal = DB::table('jadwal_harian')
            ->join('kelas', 'jadwal_harian.id_kelas', '=', 'kelas.id')
            ->where('jadwal_harian.id', $request->jadwal_har)
            ->first();
        $cek_deposit_kelas = DB::table('kelas_deposit')->where('memberid', $request->member)->where('id_kelas', $jadwal->id_kelas)->first();
        if (empty($cek_deposit_kelas)) {
            // echo 'tidak ada kelas';
            $kelas = DB::table('kelas')->where('id', $jadwal->id_kelas)->first();
            $member = DB::table('member')->where('memberid', $request->member)->first();

            if ($member->sisa_deposit < $kelas->harga) {
                return redirect('/presensi_kelas/' . $request->jadwal_har . '/absen_member');
            } else {
                DB::table('transaksi')->insert([
                    'id' => $newid,
                    'no_struk' => $no_struk,
                    'tanggal' => $tgl_now,
                    'jenis_transaksi' => '05',
                    'member' => $request->member,
                    'jumlah' => $kelas->harga,
                    'jadwal_har' => $request->jadwal_har,
                    'sisa_deposit' => ($member->sisa_deposit - $kelas->harga)
                ]);
                DB::table('member')->where('memberid', $request->member)->update([
                    'sisa_deposit' => ($member->sisa_deposit - $kelas->harga)
                ]);
                return redirect('/presensi_kelas/' . $request->jadwal_har . '/absen_member');
            }
        } else {
            // echo 'ada kelas';
            if ($cek_deposit_kelas->sisa_deposit < 1) {
                return redirect('/presensi_kelas/' . $request->jadwal_har . '/absen_member');
            } else {
                // dd($cek_deposit_kelas);
                DB::table('transaksi')->insert([
                    'id' => $newid,
                    'no_struk' => $no_struk,
                    'tanggal' => $tgl_now,
                    'jenis_transaksi' => '06',
                    'member' => $request->member,
                    'masa_aktif_member' => $cek_deposit_kelas->masa_aktif,
                    'jadwal_har' => $request->jadwal_har,
                    'sisa_deposit' => ($cek_deposit_kelas->sisa_deposit - 1)
                ]);
                DB::table('kelas_deposit')->where('memberid', $request->member)->where('id_kelas', $cek_deposit_kelas->id_kelas)->update([
                    'sisa_deposit' => ($cek_deposit_kelas->sisa_deposit - 1)
                ]);
                return redirect('/presensi_kelas/' . $request->jadwal_har . '/absen_member');
            }
        }
        // dd($cek_deposit_kelas);


        return redirect('/presensi_gym');
    }

    public function index_kasir()
    {
        $data = DB::table('transaksi')
            ->join('jadwal_harian', 'transaksi.jadwal_har', '=', 'jadwal_harian.id')
            ->join('kelas', 'jadwal_harian.id_kelas', '=', 'kelas.id')
            ->join('member', 'transaksi.member', '=', 'member.memberid')
            ->join('kasir', 'transaksi.kasir', '=', 'kasir.kasirid', 'left')
            ->join('jenis_transaksi', 'transaksi.jenis_transaksi', '=', 'jenis_transaksi.kode')
            ->select('transaksi.*', 'member.nama as nama_member', 'kasir.nama as nama_kasir', 'jenis_transaksi.keterangan', 'kelas.nama as kelas')
            ->Where(function ($query) {
                $query->where('jenis_transaksi', '05')
                    ->orwhere('jenis_transaksi', '06');
            })
            ->get();
        // dd($data);
        $member = DB::table('member')->get();
        // dd($data);
        return view('presensi_kelas.index_kasir', [
            'data' => $data,
            'member' => $member,
        ]);
    }

    public function cetak($id)
    {
        // dd($id);
        $data = DB::table('transaksi')
            ->join('jadwal_harian', 'transaksi.jadwal_har', '=', 'jadwal_harian.id')
            ->join('kelas', 'jadwal_harian.id_kelas', '=', 'kelas.id')
            ->join('instruktur as ins1', 'jadwal_harian.id_instruktur', '=', 'ins1.id')
            ->join('instruktur as ins2', 'jadwal_harian.id_instruktur2', '=', 'ins2.id', 'left')
            ->join('member', 'transaksi.member', '=', 'member.memberid')
            ->select('transaksi.*', 'member.nama as nama_member', 'jadwal_harian.status', 'kelas.nama as kelas', 'kelas.harga', 'ins1.nama as ins1', 'ins2.nama as ins2')
            ->where('transaksi.id', $id)->first();
        // dd($data);
        return view('presensi_kelas.cetak', [
            'data' => $data
        ]);
    }

    public function cetak_paket($id)
    {
        // dd($id);
        $data = DB::table('transaksi')
            ->join('jadwal_harian', 'transaksi.jadwal_har', '=', 'jadwal_harian.id')
            ->join('kelas', 'jadwal_harian.id_kelas', '=', 'kelas.id')
            ->join('instruktur as ins1', 'jadwal_harian.id_instruktur', '=', 'ins1.id')
            ->join('instruktur as ins2', 'jadwal_harian.id_instruktur2', '=', 'ins2.id', 'left')
            ->join('member', 'transaksi.member', '=', 'member.memberid')
            ->select('transaksi.*', 'member.nama as nama_member', 'jadwal_harian.status', 'kelas.nama as kelas', 'kelas.harga', 'ins1.nama as ins1', 'ins2.nama as ins2')
            ->where('transaksi.id', $id)->first();
        // dd($data);
        return view('presensi_kelas.cetak_paket', [
            'data' => $data
        ]);
    }

    public function mulai_kelas($id)
    {
        $data = DB::table('jadwal_harian')->where('jadwal_harian.id', $id)
            // ->selectRaw('jadwal_harian.*')
            ->join('jam_kelas', 'jadwal_harian.id_jam', '=', 'jam_kelas.id')->first();

        $waktukelas = $data->tgl . ' ' . $data->slot . ':00';
        // $waktukelas = "2023-05-24 11:10:30";
        $waktunow = date('Y-m-d H:i:s');

        // Konversi string ke objek DateTime
        $dateTimeNow = new \DateTime($waktunow);
        $dateTimeKelas = new \DateTime($waktukelas);

        // Hitung selisih waktu dalam detik
        $selisihDetik = $dateTimeNow->getTimestamp() - $dateTimeKelas->getTimestamp();

        if ($selisihDetik < 0) {
            $terlambat = 0;
        } else {
            $terlambat = $selisihDetik;
        }
        // dd($terlambat);
        DB::table('jadwal_harian')->where('id', $id)->update([
            'mulai_kelas' => $waktunow,
            'terlambat' => $terlambat
        ]);

        return redirect('/presensi_kelas');
    }
}
