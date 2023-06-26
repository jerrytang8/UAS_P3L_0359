<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IjinInstrukturController extends Controller
{
    public function index()
    {
        if (session('role') == 'instruktur') {
            $ijin = DB::table('ijin_instruktur')
                ->join('jadwal_harian', 'ijin_instruktur.id_jadwalhar', '=', 'jadwal_harian.id')
                ->join('jam_kelas', 'jadwal_harian.id_jam', '=', 'jam_kelas.id')
                ->join('kelas', 'jadwal_harian.id_kelas', '=', 'kelas.id')
                ->join('instruktur AS ins1', 'jadwal_harian.id_instruktur', '=', 'ins1.id')
                ->select('jadwal_harian.tgl', 'ijin_instruktur.*', 'kelas.nama as kelas', 'jam_kelas.slot')
                ->where('ins1.instrukturid', session('username'))
                ->get();
            // dd($ijin);
            return view('ijin_instruktur.index', [
                'data' => $ijin
            ]);
        }
        if (session('role') == 'manager') {
            $ijin = DB::table('ijin_instruktur')
                ->join('jadwal_harian', 'ijin_instruktur.id_jadwalhar', '=', 'jadwal_harian.id')
                ->join('jam_kelas', 'jadwal_harian.id_jam', '=', 'jam_kelas.id')
                ->join('kelas', 'jadwal_harian.id_kelas', '=', 'kelas.id')
                ->join('instruktur AS ins1', 'ijin_instruktur.id_instruktur', '=', 'ins1.id')
                ->leftJoin('instruktur AS ins2', 'ijin_instruktur.id_pengganti', '=', 'ins2.id')
                ->select('jadwal_harian.tgl', 'ijin_instruktur.*', 'kelas.nama as kelas', 'jam_kelas.slot', 'ins1.nama as instruktur', 'ins2.nama as pengganti', 'ins1.id as id_ins', 'ins2.id as id_ins2')
                ->get();
            // dd($ijin);
            return view('ijin_instruktur.index_manager', [
                'data' => $ijin
            ]);
        }
    }

    public function tambah()
    {
        $jadwal = DB::table('jadwal_harian')
            ->join('jam_kelas', 'jadwal_harian.id_jam', '=', 'jam_kelas.id')
            ->join('kelas', 'jadwal_harian.id_kelas', '=', 'kelas.id')
            ->join('instruktur AS ins1', 'jadwal_harian.id_instruktur', '=', 'ins1.id')
            ->select('jadwal_harian.*', 'jam_kelas.slot', 'kelas.nama as kelas')
            ->where('ins1.instrukturid', session('username'))
            ->get();
        $instruktur = DB::table('instruktur')->where('instrukturid', '!=', session('username'))->get();
        // dd($jadwal);
        return view('ijin_instruktur.tambah', [
            'jadwal' => $jadwal,
            'instruktur' => $instruktur
        ]);
    }

    public function save(Request $request)
    {
        // dd($request->input());
        // $data = DB::table('jadwal_harian')
        //     ->where('id_hari', $request->input('hari'))
        //     ->where('id_jam', $request->input('waktu'))
        //     ->where('id_instruktur', $request->input('instruktur'))
        //     ->first();
        // if (!empty($data)) {
        //     return redirect('/jadwalhar/tambah')->with('gagal', 'Instruktur Sudah ada jadwal!');
        // }
        DB::table('ijin_instruktur')->insert([
            'id_jadwalhar' => $request->input('id_jadwalhar'),
            'keterangan' => $request->input('keterangan'),
            'id_pengganti' => $request->input('id_pengganti')
        ]);

        return redirect('/ijin_instruktur');
    }

    public function konfirmasi(Request $request)
    {
        // dd($request->input());
        // $data = DB::table('jadwal_harian')
        //     ->where('id_hari', $request->input('hari'))
        //     ->where('id_jam', $request->input('waktu'))
        //     ->where('id_instruktur', $request->input('instruktur'))
        //     ->first();
        // if (!empty($data)) {
        //     return redirect('/jadwalhar/tambah')->with('gagal', 'Instruktur Sudah ada jadwal!');
        // }
        DB::table('ijin_instruktur')->where('id', $request->id)->update([
            'status' => $request->input('status')
        ]);

        return redirect('/ijin_instruktur');
    }
}
