<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SiswaModel extends Model
{
    public function allData()
    {
    return DB::table('tbl_siswa')
    ->leftjoin('tbl_kelas', 'tbl_kelas.id_kelas', '=', 'tbl_siswa.id_kelas')
    ->leftjoin('tbl_mapel', 'tbl_mapel.id_mapel', '=', 'tbl_siswa.id_mapel')
    ->get();
    }
}