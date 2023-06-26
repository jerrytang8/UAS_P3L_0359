<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LapPendapatanController extends Controller
{
    public function index()
    {
        $tahun = date('Y');

        $urut = array("0", "1", "2", "3", "4", "5");
        foreach ($urut as $p) {
            $angka = $tahun - $p;
            $periode[] = array(
                'tahun' => $angka
            );
        }
        // dd($periode);
        $bulan = array(
            "Jan", "Feb", "Mar", "Apr",
            "Mei", "Jun", "Jul", "Agu", "Sep",
            "Okt", "Nov", "Des"
        );
        $int_bulan = 1;
        $grand_total = 0;
        foreach ($bulan as $b) {
            $bln = '0' . $int_bulan;
            $aktivasi_all = DB::table('transaksi')
                ->selectRaw('SUM(jumlah) AS jumlah')
                ->where('jenis_transaksi', '=', '01')
                ->whereYear('tanggal', '=', $tahun)
                ->whereMonth('tanggal', $bln)
                ->groupBy('jenis_transaksi')
                ->first();
            if ($aktivasi_all) {
                $aktivasi_awal = $aktivasi_all->jumlah;
            } else {
                $aktivasi_awal = 0;
            }

            $reguler_all = DB::table('transaksi')
                ->selectRaw('SUM(jumlah) AS jumlah')
                ->where('jenis_transaksi', '=', '02')
                ->whereYear('tanggal', '=', $tahun)
                ->whereMonth('tanggal', $bln)
                ->groupBy('jenis_transaksi')
                ->first();
            if ($reguler_all) {
                $reguler_awal = $reguler_all->jumlah;
            } else {
                $reguler_awal = 0;
            }

            $kelas_all = DB::table('transaksi')
                ->selectRaw('SUM(jumlah) AS jumlah')
                ->where('jenis_transaksi', '=', '03')
                ->whereYear('tanggal', '=', $tahun)
                ->whereMonth('tanggal', $bln)
                ->groupBy('jenis_transaksi')
                ->first();
            if ($kelas_all) {
                $kelas_awal = $kelas_all->jumlah;
            } else {
                $kelas_awal = 0;
            }
            $total = 0;
            $data[] = array(
                'bulan' => $b,
                'kode_bulan' => $bln,
                'aktivasi' => $aktivasi_awal,
                'deposit' => ($reguler_awal + $kelas_awal),
                'total' => $total += ($aktivasi_awal + $reguler_awal + $kelas_awal)
            );
            $int_bulan++;
            $grand_total += ($aktivasi_awal + $reguler_awal + $kelas_awal);
        }
        // dd($grand_total);
        return view('lap_pendapatan.index', [
            'data' => $data,
            'total' => $grand_total,
            'tahun' => $tahun,
            // 'periode' => $periode,
        ]);
    }

    public function update_lap(Request $request)
    {
        $cek_tahun = DB::table('transaksi')->selectRaw('count(id) as data')->whereYear('tanggal', '=', $request->periode)->first();

        if (empty($cek_tahun->data)) {
            return view('lap_pendapatan.no_data', ['tahun' => $request->periode]);
        } else {
            $tahun = $request->periode;

            $urut = array("0", "1", "2", "3", "4", "5");
            foreach ($urut as $p) {
                $angka = $tahun - $p;
                $periode[] = array(
                    'tahun' => $angka
                );
            }
            // dd($periode);
            $bulan = array(
                "Jan", "Feb", "Mar", "Apr",
                "Mei", "Jun", "Jul", "Agu", "Sep",
                "Okt", "Nov", "Des"
            );
            $int_bulan = 1;
            $grand_total = 0;
            foreach ($bulan as $b) {
                $bln = '0' . $int_bulan;
                $aktivasi_all = DB::table('transaksi')
                    ->selectRaw('SUM(jumlah) AS jumlah')
                    ->where('jenis_transaksi', '=', '01')
                    ->whereYear('tanggal', '=', $tahun)
                    ->whereMonth('tanggal', $bln)
                    ->groupBy('jenis_transaksi')
                    ->first();
                if ($aktivasi_all) {
                    $aktivasi_awal = $aktivasi_all->jumlah;
                } else {
                    $aktivasi_awal = 0;
                }

                $reguler_all = DB::table('transaksi')
                    ->selectRaw('SUM(jumlah) AS jumlah')
                    ->where('jenis_transaksi', '=', '02')
                    ->whereYear('tanggal', '=', $tahun)
                    ->whereMonth('tanggal', $bln)
                    ->groupBy('jenis_transaksi')
                    ->first();
                if ($reguler_all) {
                    $reguler_awal = $reguler_all->jumlah;
                } else {
                    $reguler_awal = 0;
                }

                $kelas_all = DB::table('transaksi')
                    ->selectRaw('SUM(jumlah) AS jumlah')
                    ->where('jenis_transaksi', '=', '03')
                    ->whereYear('tanggal', '=', $tahun)
                    ->whereMonth('tanggal', $bln)
                    ->groupBy('jenis_transaksi')
                    ->first();
                if ($kelas_all) {
                    $kelas_awal = $kelas_all->jumlah;
                } else {
                    $kelas_awal = 0;
                }
                $total = 0;
                $data[] = array(
                    'bulan' => $b,
                    'kode_bulan' => $bln,
                    'aktivasi' => $aktivasi_awal,
                    'deposit' => ($reguler_awal + $kelas_awal),
                    'total' => $total += ($aktivasi_awal + $reguler_awal + $kelas_awal)
                );
                $int_bulan++;
                $grand_total += ($aktivasi_awal + $reguler_awal + $kelas_awal);
            }
            // dd($grand_total);
            return view('lap_pendapatan.update_lap', [
                'data' => $data,
                'total' => $grand_total,
                'tahun' => $tahun,
                // 'periode' => $periode,
            ]);
        }
    }
}
