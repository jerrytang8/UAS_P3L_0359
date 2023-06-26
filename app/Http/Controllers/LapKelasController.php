<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LapKelasController extends Controller
{
    public function index()
    {
        $tahun = date('Y');
        $bulan = date('m');
        $kelas = DB::table('kelas')->orderBy('nama', 'asc')->get();
        // dd($kelas);
        foreach ($kelas as $k) {
            $instruktur = DB::table('jadwal_harian')
                ->selectRaw('id_kelas, instruktur.nama')
                ->join('instruktur', 'jadwal_harian.id_instruktur', '=', 'instruktur.id')
                ->where('id_kelas', '=', $k->id)
                // ->groupBy('id_kelas')
                ->first();
            // dd($tgl);

            $peserta = DB::table('transaksi')->selectRaw('count(transaksi.id) as data')
                ->join('jadwal_harian', 'transaksi.jadwal_har', '=', 'jadwal_harian.id')
                ->where('id_kelas', '=', $k->id)
                ->Where(function ($query) {
                    $query->where('jenis_transaksi', '05')
                        ->orwhere('jenis_transaksi', '06');
                })
                ->whereMonth('tanggal', '=', $bulan)
                ->whereYear('tanggal', '=', $tahun)->first();
            // dd($peserta);

            $libur = DB::table('jadwal_harian')->selectRaw('count(id) as data')
                ->where('id_kelas', '=', $k->id)
                ->where('status', '=', 1)
                ->whereMonth('tgl', '=', $bulan)
                ->whereYear('tgl', '=', $tahun)->first();
            // dd($peserta);
            $data[] = array(
                'kelas' => $k->nama,
                'instruktur' => $instruktur->nama,
                'peserta' => $peserta->data,
                'libur' => $libur->data,
            );
        }
        // dd($data);
        return view('lap_kelas.index', [
            'data' => $data,
        ]);
    }

    public function update_lap(Request $request)
    {
        $cek_data = DB::table('transaksi')->selectRaw('count(id) as data')
            ->Where(function ($query) {
                $query->where('jenis_transaksi', '05')
                    ->orwhere('jenis_transaksi', '06');
            })
            ->whereMonth('tanggal', '=', $request->bulan)
            ->whereYear('tanggal', '=', $request->periode)->first();

        if (empty($cek_data->data)) {
            return view('lap_kelas.no_data', ['periode' => $request->periode . '-' . $request->bulan . '-01']);
        } else {
            $tahun = $request->periode;
            $bulan = $request->bulan;
            $kelas = DB::table('kelas')->orderBy('nama', 'asc')->get();
            // dd($kelas);
            foreach ($kelas as $k) {
                $instruktur = DB::table('jadwal_harian')
                    ->selectRaw('id_kelas, instruktur.nama')
                    ->join('instruktur', 'jadwal_harian.id_instruktur', '=', 'instruktur.id')
                    ->where('id_kelas', '=', $k->id)
                    // ->groupBy('id_kelas')
                    ->first();
                // dd($tgl);

                $peserta = DB::table('transaksi')->selectRaw('count(transaksi.id) as data')
                    ->join('jadwal_harian', 'transaksi.jadwal_har', '=', 'jadwal_harian.id')
                    ->where('id_kelas', '=', $k->id)
                    ->Where(function ($query) {
                        $query->where('jenis_transaksi', '05')
                            ->orwhere('jenis_transaksi', '06');
                    })
                    ->whereMonth('tanggal', '=', $bulan)
                    ->whereYear('tanggal', '=', $tahun)->first();
                // dd($peserta);

                $libur = DB::table('jadwal_harian')->selectRaw('count(id) as data')
                    ->where('id_kelas', '=', $k->id)
                    ->where('status', '=', 1)
                    ->whereMonth('tgl', '=', $bulan)
                    ->whereYear('tgl', '=', $tahun)->first();
                // dd($peserta);
                $data[] = array(
                    'kelas' => $k->nama,
                    'instruktur' => $instruktur->nama,
                    'peserta' => $peserta->data,
                    'libur' => $libur->data,
                );
            }

            // dd($data);
            // dd($grand_total);
            return view('lap_kelas.update_lap', [
                'data' => $data,
                // 'periode' => $periode,
            ]);
        }
    }
}
