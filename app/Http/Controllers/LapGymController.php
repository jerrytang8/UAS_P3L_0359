<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LapGymController extends Controller
{
    public function index()
    {
        $tahun = date('Y');
        $bulan = date('m');
        $cek_lap = DB::table('transaksi')->selectRaw('count(id) as data')->where('jenis_transaksi', '=', '04')
            ->whereMonth('tanggal', '=', $bulan)
            ->whereYear('tanggal', '=', $tahun)->first();

        $data_lap = DB::table('transaksi')
            ->selectRaw('DATE_FORMAT(tanggal, "%Y-%m-%d") as tgl, count(id) as data')
            ->where('jenis_transaksi', '=', '04')
            ->whereMonth('tanggal', '=', $bulan)
            ->whereYear('tanggal', '=', $tahun)
            ->groupBy('tgl')
            ->get();
        if (!empty($cek_lap->data)) {
            $total_bulan = 0;
            foreach ($data_lap as $d) {
                $data[] = array(
                    'tgl' => $d->tgl,
                    'jml_member' => $d->data
                );
                $total_bulan += $d->data;
            }
        } else {
            $data = 0;
            $total_bulan = 0;
        }

        // dd($data);
        // dd($grand_total);
        return view('lap_gym.index', [
            'total' => $total_bulan,
            'data' => $data,
            // 'periode' => $periode,
        ]);
    }

    public function update_lap(Request $request)
    {
        $cek_data = DB::table('transaksi')->selectRaw('count(id) as data')
            ->where('jenis_transaksi', '=', '04')
            ->whereMonth('tanggal', '=', $request->bulan)
            ->whereYear('tanggal', '=', $request->periode)->first();

        if (empty($cek_data->data)) {
            return view('lap_gym.no_data', ['periode' => $request->periode . '-' . $request->bulan . '-01']);
        } else {
            $tahun = $request->periode;
            $bulan = $request->bulan;
            $cek_lap = DB::table('transaksi')->selectRaw('count(id) as data')->where('jenis_transaksi', '=', '04')
                ->whereMonth('tanggal', '=', $bulan)
                ->whereYear('tanggal', '=', $tahun)->first();

            $data_lap = DB::table('transaksi')
                ->selectRaw('DATE_FORMAT(tanggal, "%Y-%m-%d") as tgl, count(id) as data')
                ->where('jenis_transaksi', '=', '04')
                ->whereMonth('tanggal', '=', $bulan)
                ->whereYear('tanggal', '=', $tahun)
                ->groupBy('tgl')
                ->get();
            if (!empty($cek_lap->data)) {
                $total_bulan = 0;
                foreach ($data_lap as $d) {
                    $data[] = array(
                        'tgl' => $d->tgl,
                        'jml_member' => $d->data
                    );
                    $total_bulan += $d->data;
                }
            } else {
                $data = 0;
                $total_bulan = 0;
            }

            // dd($data);
            // dd($grand_total);
            return view('lap_gym.update_lap', [
                'total' => $total_bulan,
                'data' => $data,
                // 'periode' => $periode,
            ]);
        }
    }
}
