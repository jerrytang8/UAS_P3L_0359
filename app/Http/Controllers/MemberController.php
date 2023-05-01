<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function index()
    {
        $maxdb = DB::table('member')->max('id');
        if (empty($maxdb)) {
            $newid = 1;
        } else {
            $newid = $maxdb + 1;
        }
        $memberid = date('y') . "." . date('m') . "." . $newid;

        $member = DB::table('member')->get();
        return view('member.index', [
            'data' => $member,
            'memberid' => $memberid
        ]);
    }

    public function tambah()
    {
        $maxdb = DB::table('member')->max('id');
        if (empty($maxdb)) {
            $newid = 1;
        } else {
            $newid = $maxdb + 1;
        }
        $memberid = date('y') . "." . date('m') . "." . $newid;

        return view('member.tambah', [
            'memberid' => $memberid
        ]);
    }

    public function save(Request $request)
    {
        $maxdb = DB::table('member')->max('id');
        if (empty($maxdb)) {
            $newid = 1;
        } else {
            $newid = $maxdb + 1;
        }
        DB::table('member')->insert([
            'id' => $newid,
            'memberid' => $request->memberid,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir
        ]);
        DB::table('akun')->insert([
            'username' => $request->memberid,
            'password' => $request->tgl_lahir,
            'role' => 'member'
        ]);

        return redirect('/member');
    }

    public function edit($id)
    {
        $data = DB::table('member')->where('id', $id)->first();
        // dd($data);
        return view('member.edit', [
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::table('member')->where('id', $id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir
        ]);

        return redirect('/member');
    }

    public function hapus($id)
    {
        DB::table('member')->where('id', $id)->delete();

        return redirect('/member');
    }

    public function cetak($id)
    {
        $data = DB::table('member')->where('id', $id)->first();
        return view('member.cetak', [
            'data' => $data
        ]);
    }

    public function reset($id)
    {
        $member = DB::table('member')->where('memberid', $id)->first();
        $akun = DB::table('akun')->where('username', $id)->first();

        if (!empty($akun)) {
            DB::table('akun')->where('username', $id)->update([
                'password' => $member->tgl_lahir
            ]);
            return redirect('/member')->with('berhasil', 'Password berhasil direset.');
        }
    }
}
