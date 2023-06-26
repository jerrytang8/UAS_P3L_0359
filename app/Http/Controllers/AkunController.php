<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AkunController extends Controller
{
    public function auth(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $data = DB::table('akun')->where('username', $username)->where('password', $password)->first();
        if (empty($data)) {
            return redirect('/')->with('gagal', 'Kombinasi username dan password tidak sesuai.');
        }
        $user_role = substr($username, 0, 3);
        if ($user_role == 'ADM') {
            session([
                'id_user' => $data->id,
                'username' => $data->username,
                'nama' => $data->role,
                'role' => $data->role
            ]);
            return redirect('/dashboard');
        }
        if ($user_role == 'KAS') {
            $kasir = DB::table('kasir')->where('kasirid', $data->username)->first();
            // dd($kasir);
            session([
                'id_user' => $data->id,
                'username' => $data->username,
                'nama' => $kasir->nama,
                'role' => $data->role
            ]);
            return redirect('/dashboard');
        }
        if ($user_role == 'MO-') {
            $manager = DB::table('manager')->where('managerid', $data->username)->first();
            // dd($manager);
            session([
                'id_user' => $data->id,
                'username' => $data->username,
                'nama' => $manager->nama,
                'role' => $data->role
            ]);
            return redirect('/dashboard');
        }
        if ($user_role == 'INS') {
            $instruktur = DB::table('instruktur')->where('instrukturid', $data->username)->first();
            // dd($instruktur);
            session([
                'id_user' => $data->id,
                'username' => $data->username,
                'nama' => $instruktur->nama,
                'role' => $data->role
            ]);
            return redirect('/dashboard');
        } else {
            $member = DB::table('member')->where('memberid', $data->username)->first();
            // dd($member);
            if (empty($member)) {
                return redirect('/');
            }
            session([
                'id_user' => $data->id,
                'username' => $data->username,
                'nama' => $member->nama,
                'role' => $data->role
            ]);
            return redirect('/dashboard');
        }
        // dd($data->role);
    }

    public function ubah(Request $request)
    {
        if ($request->password == $request->konfirmasi) {
            DB::table('akun')->where('id', session('id_user'))->update([
                'password' => $request->password
            ]);

            return redirect('/akun/ubahpassword')->with('berhasil', 'Password berhasil diubah.');
        } else {
            return redirect('/akun/ubahpassword')->with('gagal', 'Konfirmasi password tidak sesuai');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
