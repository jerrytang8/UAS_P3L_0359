<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwaldefController extends Controller
{
    public function index()
    {
        // $users = DB::table('users')
        //     ->join('contacts', 'users.id', '=', 'contacts.user_id')
        //     ->join('orders', 'users.id', '=', 'orders.user_id')
        //     ->select('users.*', 'contacts.phone', 'orders.price')
        //     ->get();

        $senin = DB::table('jadwal_default')
            ->join('jam', 'jadwal_default.id_jam', '=', 'jam.id')
            ->join('kelas', 'jadwal_default.id_kelas', '=', 'kelas.id')
            ->join('instruktur', 'jadwal_default.id_instruktur', '=', 'instruktur.id')
            ->select('jadwal_default.*', 'jam.slot', 'kelas.nama as kelas', 'instruktur.nama as instruktur')
            ->where('id_hari', 1)->orderBy('id_jam', 'ASC')->get();
        $selasa = DB::table('jadwal_default')
            ->join('jam', 'jadwal_default.id_jam', '=', 'jam.id')
            ->join('kelas', 'jadwal_default.id_kelas', '=', 'kelas.id')
            ->join('instruktur', 'jadwal_default.id_instruktur', '=', 'instruktur.id')
            ->select('jadwal_default.*', 'jam.slot', 'kelas.nama as kelas', 'instruktur.nama as instruktur')
            ->where('id_hari', 2)->orderBy('id_jam', 'ASC')->get();
        $rabu = DB::table('jadwal_default')
            ->join('jam', 'jadwal_default.id_jam', '=', 'jam.id')
            ->join('kelas', 'jadwal_default.id_kelas', '=', 'kelas.id')
            ->join('instruktur', 'jadwal_default.id_instruktur', '=', 'instruktur.id')
            ->select('jadwal_default.*', 'jam.slot', 'kelas.nama as kelas', 'instruktur.nama as instruktur')
            ->where('id_hari', 3)->orderBy('id_jam', 'ASC')->get();
        $kamis = DB::table('jadwal_default')
            ->join('jam', 'jadwal_default.id_jam', '=', 'jam.id')
            ->join('kelas', 'jadwal_default.id_kelas', '=', 'kelas.id')
            ->join('instruktur', 'jadwal_default.id_instruktur', '=', 'instruktur.id')
            ->select('jadwal_default.*', 'jam.slot', 'kelas.nama as kelas', 'instruktur.nama as instruktur')
            ->where('id_hari', 4)->orderBy('id_jam', 'ASC')->get();
        $jumat = DB::table('jadwal_default')
            ->join('jam', 'jadwal_default.id_jam', '=', 'jam.id')
            ->join('kelas', 'jadwal_default.id_kelas', '=', 'kelas.id')
            ->join('instruktur', 'jadwal_default.id_instruktur', '=', 'instruktur.id')
            ->select('jadwal_default.*', 'jam.slot', 'kelas.nama as kelas', 'instruktur.nama as instruktur')
            ->where('id_hari', 5)->orderBy('id_jam', 'ASC')->get();
        $sabtu = DB::table('jadwal_default')
            ->join('jam', 'jadwal_default.id_jam', '=', 'jam.id')
            ->join('kelas', 'jadwal_default.id_kelas', '=', 'kelas.id')
            ->join('instruktur', 'jadwal_default.id_instruktur', '=', 'instruktur.id')
            ->select('jadwal_default.*', 'jam.slot', 'kelas.nama as kelas', 'instruktur.nama as instruktur')
            ->where('id_hari', 6)->orderBy('id_jam', 'ASC')->get();
        $minggu = DB::table('jadwal_default')
            ->join('jam', 'jadwal_default.id_jam', '=', 'jam.id')
            ->join('kelas', 'jadwal_default.id_kelas', '=', 'kelas.id')
            ->join('instruktur', 'jadwal_default.id_instruktur', '=', 'instruktur.id')
            ->select('jadwal_default.*', 'jam.slot', 'kelas.nama as kelas', 'instruktur.nama as instruktur')
            ->where('id_hari', 7)->orderBy('id_jam', 'ASC')->get();
        // ddd($jadwal);
        return view('jadwaldef.index', [
            'senin' => $senin,
            'selasa' => $selasa,
            'rabu' => $rabu,
            'kamis' => $kamis,
            'jumat' => $jumat,
            'sabtu' => $sabtu,
            'minggu' => $minggu
        ]);
    }

    public function tambah()
    {
        $hari = DB::table('hari')->get();
        $jam = DB::table('jam')->get();
        $kelas = DB::table('kelas')->get();
        $instruktur = DB::table('instruktur')->get();
        return view('jadwaldef.tambah', [
            'hari' => $hari,
            'jam' => $jam,
            'kelas' => $kelas,
            'instruktur' => $instruktur
        ]);
    }

    public function save(Request $request)
    {
        $data = DB::table('jadwal_default')
            ->where('id_hari', $request->input('hari'))
            ->where('id_jam', $request->input('waktu'))
            ->where('id_instruktur', $request->input('instruktur'))
            ->first();
        if (!empty($data)) {
            return redirect('/jadwaldef/tambah')->with('gagal', 'Instruktur Sudah ada jadwal!');
        }
        DB::table('jadwal_default')->insert([
            'id_hari' => $request->input('hari'),
            'id_jam' => $request->input('waktu'),
            'id_kelas' => $request->input('kelas'),
            'id_instruktur' => $request->input('instruktur')
        ]);

        return redirect('/jadwaldef');
    }

    public function edit($id)
    {
        $data = DB::table('jadwal_default')->where('id', $id)->first();
        // dd($data);
        $hari = DB::table('hari')->get();
        $jam = DB::table('jam')->get();
        $kelas = DB::table('kelas')->get();
        $instruktur = DB::table('instruktur')->get();
        return view('jadwaldef.edit', [
            'data' => $data,
            'hari' => $hari,
            'jam' => $jam,
            'kelas' => $kelas,
            'instruktur' => $instruktur
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = DB::table('jadwal_default')
            ->where('id_hari', $request->input('hari'))
            ->where('id_jam', $request->input('waktu'))
            ->where('id_instruktur', $request->input('instruktur'))
            ->first();
        if (!empty($data)) {
            return redirect('/jadwaldef/' . $id . '/edit')->with('gagal', 'Instruktur Sudah ada jadwal!');
        }
        DB::table('jadwal_default')->where('id', $id)->update([
            'id_hari' => $request->input('hari'),
            'id_jam' => $request->input('waktu'),
            'id_kelas' => $request->input('kelas'),
            'id_instruktur' => $request->input('instruktur')
        ]);

        return redirect('/jadwaldef');
    }

    public function hapus($id)
    {
        DB::table('jadwal_default')->where('id', $id)->delete();

        return redirect('/jadwaldef');
    }
}
