<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class GuruModel extends Model
{
    public function allData()
    {
        return DB::table('tbl_guru')->get();
    }
//detail data
    public function detailData($id_guru)
    {
        return DB::table('tbl_guru')->where('id_guru', $id_guru)->first();
    }
//tambah data
    public function addData($data)
    {
        DB::table('tbl_guru')->insert($data);
    }
//edit data
    public function editData($id_guru, $data)
    {
        DB::table('tbl_guru')->where('id_guru', $id_guru)->update($data);
    }
//hapus data
    public function deleteData($id_guru)
    {
        DB::table('tbl_guru')->where('id_guru', $id_guru)->delete();
    }
}

