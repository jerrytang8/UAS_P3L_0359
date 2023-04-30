<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalharController extends Controller
{
    public function index()
    {
        $tgl = DB::table('jadwal_harian')->select('tgl')->groupBy('tgl')
            ->orderBy('tgl', 'desc')
            ->get();
        $jadwal = array();
        $date = 0;
        foreach ($tgl as $t) {
            // dd($t->tgl);
            // $data = DB::table('jadwal_harian')->where('tgl', $t->tgl)->get();
            $data = DB::table('jadwal_harian')
                ->join('jam', 'jadwal_harian.id_jam', '=', 'jam.id')
                ->join('kelas', 'jadwal_harian.id_kelas', '=', 'kelas.id')
                ->join('instruktur AS ins1', 'jadwal_harian.id_instruktur', '=', 'ins1.id')
                ->leftJoin('instruktur AS ins2', 'jadwal_harian.id_instruktur2', '=', 'ins2.id')
                ->select('jadwal_harian.*', 'jam.slot', 'kelas.nama as kelas', 'ins1.nama as instruktur', 'ins2.nama as instruktur2', 'ins1.id as id_ins', 'ins2.id as id_ins2')
                ->where('tgl', $t->tgl)->orderBy('id_jam', 'asc')->get();
            // dd($data);
            $data_waktu = array();
            $c = 0;
            foreach ($data as $i) {
                $data_waktu[$c++] = [
                    'id' => $i->id,
                    'jam' => $i->slot,
                    'kelas' => $i->kelas,
                    'status' => $i->status,
                    'instruktur' => $i->instruktur,
                    'instruktur2' => $i->instruktur2,
                    'id_ins' => $i->id_ins,
                    'id_ins2' => $i->id_ins2,
                ];
            }
            // dd($data_waktu);
            // foreach ($data as $d) {
            $jadwal[$date] = array('hari' => date('D', strtotime($t->tgl)), 'bulan' => date('M d', strtotime($t->tgl)),);
            $jadwal[$date]['waktu'] = $data_waktu;
            // }
            $date++;
        }
        // dd($jadwal);
        $instruktur = DB::table('instruktur')->get();
        return view('jadwalhar.index', [
            'jadwal' => $jadwal,
            'instruktur' => $instruktur
        ]);
    }

    public function generate()
    {
        // echo date('W', strtotime("2023-04-30"));
        $senin = date('Y-m-d', strtotime("monday 0 week"));
        $selasa = date('Y-m-d', strtotime($senin . "+1 day"));
        $rabu = date('Y-m-d', strtotime($selasa . "+1 day"));
        $kamis = date('Y-m-d', strtotime($rabu . "+1 day"));
        $jumat = date('Y-m-d', strtotime($kamis . "+1 day"));
        $sabtu = date('Y-m-d', strtotime($jumat . "+1 day"));
        $minggu = date('Y-m-d', strtotime($sabtu . "+1 day"));
        $cek = DB::table('jadwal_harian')
            ->where('tgl', $senin)
            ->first();
        if (!empty($cek)) {
            return redirect('/jadwalhar')->with('gagal', 'Jadwal Minggu Depan Sudah Pernah Digenerate!');
        }
        $minggu = [
            '1' => ['tgl' => $senin, 'hari' => 1,],
            '2' => ['tgl' => $selasa, 'hari' => 2,],
            '3' => ['tgl' => $rabu, 'hari' => 3,],
            '4' => ['tgl' => $kamis, 'hari' => 4,],
            '5' => ['tgl' => $jumat, 'hari' => 5,],
            '6' => ['tgl' => $sabtu, 'hari' => 6,],
            '7' => ['tgl' => $minggu, 'hari' => 7,],
        ];
        // dd($minggu);
        $simpan = array();
        foreach ($minggu as $m) {
            $data = DB::table('jadwal_default')->where('id_hari', $m['hari'])->orderBy('id_jam', 'asc')->get();
            foreach ($data as $d)
                $simpan[] = array(
                    'tgl' => $m['tgl'],
                    'id_kelas' => $d->id_kelas,
                    'id_jam' => $d->id_jam,
                    'id_instruktur' => $d->id_instruktur,
                    'id_hari' => $d->id_hari
                );
        }
        // dd($simpan);
        DB::table('jadwal_harian')->insert($simpan);
        return redirect('/jadwalhar');
    }

    public function tambah()
    {
        $hari = DB::table('hari')->get();
        $jam = DB::table('jam')->get();
        $kelas = DB::table('kelas')->get();
        $instruktur = DB::table('instruktur')->get();
        return view('jadwalhar.tambah', [
            'hari' => $hari,
            'jam' => $jam,
            'kelas' => $kelas,
            'instruktur' => $instruktur
        ]);
    }

    public function save(Request $request)
    {
        $data = DB::table('jadwal_harian')
            ->where('id_hari', $request->input('hari'))
            ->where('id_jam', $request->input('waktu'))
            ->where('id_instruktur', $request->input('instruktur'))
            ->first();
        if (!empty($data)) {
            return redirect('/jadwalhar/tambah')->with('gagal', 'Instruktur Sudah ada jadwal!');
        }
        DB::table('jadwal_harian')->insert([
            'id_hari' => $request->input('hari'),
            'id_jam' => $request->input('waktu'),
            'id_kelas' => $request->input('kelas'),
            'id_instruktur' => $request->input('instruktur')
        ]);

        return redirect('/jadwalhar');
    }

    public function editinstruktur($id)
    {
        $data = DB::table('jadwal_harian')->where('id', $id)->first();
        // dd($data);
        $instruktur = DB::table('instruktur')->get();
        return view('jadwalhar.editinstruktur', [
            'data' => $data,
            'instruktur' => $instruktur
        ]);
    }

    public function simpaninstruktur(Request $request, $id)
    {
        $data = DB::table('jadwal_harian')
            ->where('id_hari', $request->input('hari'))
            ->where('id_jam', $request->input('waktu'))
            ->where('id_instruktur', $request->input('instruktur2'))
            ->first();
        if (!empty($data)) {
            return redirect('/jadwalhar/' . $id . '/editinstruktur')->with('gagal', 'Instruktur Sudah ada jadwal!');
        }
        DB::table('jadwal_harian')->where('id', $id)->update([
            'status' => 2,
            'id_instruktur2' => $request->input('instruktur2')
        ]);

        return redirect('/jadwalhar');
    }

    public function ubahstatus(Request $request, $id)
    {
        DB::table('jadwal_harian')->where('id', $id)->update([
            'status' => $request->input('status')
        ]);

        return redirect('/jadwalhar');
    }

    public function edit($id)
    {
        $data = DB::table('jadwal_harian')->where('id', $id)->first();
        // dd($data);
        $hari = DB::table('hari')->get();
        $jam = DB::table('jam')->get();
        $kelas = DB::table('kelas')->get();
        $instruktur = DB::table('instruktur')->get();
        return view('jadwalhar.edit', [
            'data' => $data,
            'hari' => $hari,
            'jam' => $jam,
            'kelas' => $kelas,
            'instruktur' => $instruktur
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = DB::table('jadwal_harian')
            ->where('id_hari', $request->input('hari'))
            ->where('id_jam', $request->input('waktu'))
            ->where('id_instruktur', $request->input('instruktur'))
            ->first();
        if (!empty($data)) {
            return redirect('/jadwalhar/' . $id . '/edit')->with('gagal', 'Instruktur Sudah ada jadwal!');
        }
        DB::table('jadwal_harian')->where('id', $id)->update([
            'id_hari' => $request->input('hari'),
            'id_jam' => $request->input('waktu'),
            'id_kelas' => $request->input('kelas'),
            'id_instruktur' => $request->input('instruktur')
        ]);

        return redirect('/jadwalhar');
    }

    public function hapus($id)
    {
        DB::table('jadwal_harian')->where('id', $id)->delete();

        return redirect('/jadwalhar');
    }
}
