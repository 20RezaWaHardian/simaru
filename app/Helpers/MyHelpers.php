<?php
namespace App\Helpers;
class MyHelpers
{
    public static function nama_gelar($data)
    {

        if (!empty($data->gelar_belakang)) $koma = ',';
        else $koma = '';
        $nama_gelar = $data->gelar_depan . ' ' . $data->nama_pegawai . $koma . ' ' . $data->gelar_belakang;

        return $nama_gelar;
    }

    public static function get_hari_huruf($angka)
    {
      $hari= $angka;
      $hari_hari=array(
        7 => "Munggu",
        1 => "Senin",
        2 => "Selasa",
        3 => "Rabu",
        4 => "Kamis",
        5 => "Jum'at",
        6 => "Sabtu",
        );
      return $hari_hari[$hari];
    }

    public static function tgl_indo($tgl)
    {
      if($tgl=='0000-00-00'||$tgl==null)
      {
        return "<span class='label label-warning'>Kosong</span>";
      }
      else
      {
        $tanggal = substr($tgl,8,2);
        $bulan = MyHelpers::getBulan(substr($tgl,5,2));
        $tahun = substr($tgl,0,4);
        return $tanggal.' '.$bulan.' '.$tahun;
      }
    }

    public static function time_indo($time)
    {
        $waktu =explode(' ',$time);

        return MyHelpers::tgl_indo($waktu[0]).' '.$waktu[1].'WIB';
    }

    public static function getBulan($bln){
      switch ($bln){
        case 1:
          return "Januari";
          break;
        case 2:
          return "Februari";
          break;
        case 3:
          return "Maret";
          break;
        case 4:
          return "April";
          break;
        case 5:
          return "Mei";
          break;
        case 6:
          return "Juni";
          break;
        case 7:
          return "Juli";
          break;
        case 8:
          return "Agustus";
          break;
        case 9:
          return "September";
          break;
        case 10:
          return "Oktober";
          break;
        case 11:
          return "November";
          break;
        case 12:
          return "Desember";
          break;
      }
    }

}
