<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\KoperasiModel; 

class KoperasiController extends Controller
{
    protected $koperasiModel; 

    public function __construct(KoperasiModel $koperasiModel)
    {
        $this->koperasiModel = $koperasiModel;
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'koperasi' => $this->koperasiModel->allData(), 
        ];
        return view('v_koperasi', $data);
    }

    //print ke print
    public function print()
    {
        $data = [
            'koperasi' => $this->koperasiModel->allData(),
        ];
        return view('v_print', $data);
    }

    //print ke pdf
    public function printpdf()
    {
        $data = [
            'koperasi' => $this->koperasiModel->allData(),
        ];
        $html = view('v_printpdf', $data)->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();

        $dompdf->stream();
    }
}
