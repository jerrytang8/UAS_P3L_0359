<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class MyHelper
{
    public static function nf($angka)
    {
        return number_format($angka, 0, ",", ".");
    }

    public static function get_username($user_id)
    {
        $user = DB::table('users')->where('userid', $user_id)->first();
        return (isset($user->username) ? $user->username : '');
    }

    public static function tglstruk($date)
    {
        $tahun = substr($date, 2, 2);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $waktu = substr($date, 11, 5);
        return $result = $tgl . "/" . $bulan . "/" . $tahun . " " . $waktu;
    }

    public static function masa_aktif($date)
    {
        $tahun = substr($date, 2, 2);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        return $result = $tgl . "/" . $bulan . "/" . $tahun;
    }

    public static function tglwaktu_lengkap($date)
    {
        $Bulan = array(
            "Januari", "Februari", "Maret", "April",
            "Mei", "Juni", "Juli", "Agustus", "September",
            "Oktober", "November", "Dessember"
        );
        $Hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $tahun = substr($date, 2, 2);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $waktu = substr($date, 11, 5);
        $hari = date("w", strtotime($date));
        return $result = $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun . "<br>" . $waktu;
    }

    public static function tgl_lengkap($date)
    {
        $Bulan = array(
            "Januari", "Februari", "Maret", "April",
            "Mei", "Juni", "Juli", "Agustus", "September",
            "Oktober", "November", "Dessember"
        );
        $Hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $waktu = substr($date, 11, 5);
        $hari = date("w", strtotime($date));
        return $result = $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun;
    }

    public static function bulan($date)
    {
        $Bulan = array(
            "Januari", "Februari", "Maret", "April",
            "Mei", "Juni", "Juli", "Agustus", "September",
            "Oktober", "November", "Dessember"
        );
        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        return $result = $Bulan[(int)$bulan - 1] . " Tahun " . $tahun;
    }
}
