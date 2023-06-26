<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LapKinerjaController extends Controller
{
    public function index()
    {
        $tahun = date('Y');
        $bulan = date('m');
        $instruktur = DB::table('instruktur')->orderBy('nama', 'asc')->get();
        // dd($instruktur);
        foreach ($instruktur as $i) {
            $hadir = DB::table('jadwal_harian')
                ->selectRaw('SUM(terlambat) as terlambat, count(jadwal_harian.id) as data')
                ->join('instruktur', 'jadwal_harian.id_instruktur', '=', 'instruktur.id')
                ->whereNotNull('mulai_kelas')
                ->where('id_instruktur', '=', $i->id)
                ->whereMonth('tgl', '=', $bulan)
                ->whereYear('tgl', '=', $tahun)
                // ->groupBy('id_kelas')
                ->first();

            $libur = DB::table('ijin_instruktur')
                ->selectRaw('count(ijin_instruktur.id) as data')
                ->join('jadwal_harian', 'ijin_instruktur.id_jadwalhar', '=', 'jadwal_harian.id')
                ->where('ijin_instruktur.id_instruktur', '=', $i->id)
                ->whereMonth('tgl', '=', $bulan)
                ->whereYear('tgl', '=', $tahun)->first();

            // if($hadir->)
            $data[] = array(
                'nama' => $i->nama,
                'hadir' => $hadir->data,
                'libur' => $libur->data,
                'terlambat' => $hadir->terlambat,
            );
        }
        // dd($data);
        usort($data, function ($a, $b) {
            return $a['terlambat'] - $b['terlambat'];
        });
        return view('lap_kinerja.index', [
            'data' => $data,
        ]);
    }

    public function update_lap(Request $request)
    {
        $cek_data = DB::table('jadwal_harian')
            ->selectRaw('SUM(terlambat) as terlambat, count(jadwal_harian.id) as data')
            ->join('instruktur', 'jadwal_harian.id_instruktur', '=', 'instruktur.id')
            ->whereNotNull('mulai_kelas')
            ->whereMonth('tgl', '=', $request->bulan)
            ->whereYear('tgl', '=', $request->periode)
            // ->groupBy('id_kelas')
            ->first();
        // dd($cek_data);
        if (empty($cek_data->data)) {
            return view('lap_kinerja.no_data', ['periode' => $request->periode . '-' . $request->bulan . '-01']);
        } else {
            $tahun = $request->periode;
            $bulan = $request->bulan;
            $instruktur = DB::table('instruktur')->orderBy('nama', 'asc')->get();
            // dd($instruktur);
            foreach ($instruktur as $i) {
                $hadir = DB::table('jadwal_harian')
                    ->selectRaw('SUM(terlambat) as terlambat, count(jadwal_harian.id) as data')
                    ->join('instruktur', 'jadwal_harian.id_instruktur', '=', 'instruktur.id')
                    ->whereNotNull('mulai_kelas')
                    ->where('id_instruktur', '=', $i->id)
                    ->whereMonth('tgl', '=', $bulan)
                    ->whereYear('tgl', '=', $tahun)
                    // ->groupBy('id_kelas')
                    ->first();

                $libur = DB::table('ijin_instruktur')
                    ->selectRaw('count(ijin_instruktur.id) as data')
                    ->join('jadwal_harian', 'ijin_instruktur.id_jadwalhar', '=', 'jadwal_harian.id')
                    ->where('ijin_instruktur.id_instruktur', '=', $i->id)
                    ->whereMonth('tgl', '=', $bulan)
                    ->whereYear('tgl', '=', $tahun)->first();

                // if($hadir->)
                $data[] = array(
                    'nama' => $i->nama,
                    'hadir' => $hadir->data,
                    'libur' => $libur->data,
                    'terlambat' => $hadir->terlambat,
                );
            }
            // dd($data);
            usort($data, function ($a, $b) {
                return $a['terlambat'] - $b['terlambat'];
            });
            return view('lap_kinerja.update_lap', [
                'data' => $data,
            ]);
        }
    }
}
