<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\GuruModel;
use PhpParser\Mode\Expr\New_;


class GuruController extends Controller
{
    public function __construct()
    {
        $this->GuruModel = New GuruModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'guru'  => $this->GuruModel->allData(),
        ];
        return view('v_guru', $data);
    }

    //Detail data guru
    public function detail($id_guru)
    {
        if (!$this->GuruModel->detailData($id_guru)) {
            abort(404);
        }

        $data = [
            'guru'  => $this->GuruModel->detailData($id_guru),
        ];
        return view('v_detailguru', $data);
    }

    //Menambahkan data guru
    public function add()
    {
        return view('v_addguru');
    }

       public function insert()
    {
        request()->validate([
        'nip'           => 'required|unique:tbl_guru,nip|min:4|max:5',
        'nama_guru'     => 'required',
        'mapel'         => 'required',
        'foto_guru'     => 'required|mimes:png,jpg,jpeg,bmp|max:1024',
        ],[
            'nip.required'       => 'NIP WAJIB DIISI !!!',
            'nip.unique'         => 'NIP INI SUDAH ADA !!!', //akan muncul jika isi data yang ada di DB
            'nip.min'            => 'NIP MIN. 4 KARAKTER (ANGKA)', //muncul jika angka kurang dari 4
            'nip.max'            => 'NIP MAX. 5 KARAKTER (ANGKA)', //muncul jika angka lebih dari 5
            'nama_guru.required' => 'NAMA GURU WAJIB DIISI !!!',
            'mapel.required'     => 'MATA PELAJARAN WAJIB DIISI !!!',
            'foto_guru.required' => 'FOTO GURU WAJIB DIISI !!!',
        ]);

        $file   = Request()->foto_guru;
        $fileName   = Request()->nip . '.' . $file->extension();
        $file->move(public_path('foto_guru'), $fileName);

        $data = [
            'nip'            => Request()->nip,
            'nama_guru'      => Request()->nama_guru,
            'mapel'          => Request()->mapel,
            'foto_guru'      => $fileName,
        ];

        $this->GuruModel->addData($data);
        return redirect()->route('guru')->with('pesan', 'Data Berhasil Ditambahkan :)');
    }
        //Edit data dan foto
        public function edit($id_guru)
        {
        if (!$this->GuruModel->detailData($id_guru)) {
        abort(404);
        }
        $data = [
            'guru' => $this->GuruModel->detailData($id_guru),
        ];
        return view('v_editguru', $data);
        }

        //Update data
        public function update()
        {
            request()->validate([
                'nip'           => 'required|min:4|max:5',
                'nama_guru'     => 'required',
                'mapel'         => 'required',
                'foto_guru'     => 'mimes:png,jpg,jpeg,bmp|max:1024',
            ],[
                //kalau gada foto
                'nip.required'       => 'NIP WAJIB DIISI !!!',
                'nip.min'            => 'NIP MIN. 4 KARAKTER (ANGKA)',
                'nip.max'            => 'NIP MAX. 5 KARAKTER (ANGKA)',
                'nama_guru.required' => 'NAMA GURU WAJIB DIISI !!!',
                'mapel.required'     => 'MATA PELAJARAN WAJIB DIISI !!!',
            ]);
                  
            $guru = $this->GuruModel->detailData(Request()->id_guru);
        
            if (!$guru) {
                abort(404);
            }
        
            $fileName = $guru->foto_guru;
        
            if (Request()->hasFile('foto_guru')) {
                $file = Request()->foto_guru;
                $fileName = Request()->nip . '.' . $file->extension();
                $file->move(public_path('foto_guru'), $fileName);
            }
        
            $data = [
                'nip'       => Request()->nip,
                'nama_guru' => Request()->nama_guru,
                'mapel'     => Request()->mapel,
                'foto_guru' => $fileName,
            ];
        
            $this->GuruModel->editData(Request()->id_guru, $data);
        
            return redirect()->route('guru')->with('pesan', 'Data Berhasil Diupdate :)');
        }
        
        
        //Hapus data dan foto
        public function delete($id_guru)
        {
            $guru = $this->GuruModel->detailData($id_guru);
            if (!$guru) {
                return redirect()->route('guru')->with('error', 'Guru tidak ditemukan.');
            }
        
            // Hapus foto guru
            if ($guru->foto_guru !== "" && file_exists(public_path('foto_guru') . '/' . $guru->foto_guru)) {
                unlink(public_path('foto_guru') . '/' . $guru->foto_guru);
            }
        
            // Hapus data guru dari database
            $this->GuruModel->deleteData($id_guru);
        
            return redirect()->route('guru')->with('delete', 'Data Berhasil Dihapus :/');
        }
    }

