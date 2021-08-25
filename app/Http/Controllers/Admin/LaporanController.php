<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    //

    public function getPesanan($start, $end)
    {
        $pesanan = Pesanan::with('getKeranjang')->where('status_pesanan', '=', 4);
        if ($start) {
            $pesanan = $pesanan->whereBetween('tanggal_pesanan', [date('Y-m-d 00:00:00', strtotime($start)), date('Y-m-d 23:59:59', strtotime($end))]);

        }
        $pesanan = $pesanan->paginate(10);
        return $pesanan;
    }

    public function index()
    {
        $start   = \request('start');
        $end     = \request('end');
        $pesanan = $this->getPesanan($start, $end);
        $total   = Pesanan::where('status_pesanan', '=', 4)->sum('total_harga');
        $data    = [
            'data'  => $pesanan,
            'total' => $total,
        ];

        return view('admin.laporan')->with($data);
    }

    public function cetakLaporan()
    {
//        return $this->dataLaporan();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataLaporan())->setPaper('f4', 'landscape');

        return $pdf->stream();
    }

    public function dataLaporan()
    {
        $start   = \request('start');
        $end     = \request('end');
        $pesanan = $this->getPesanan($start, $end);
        $total   = Pesanan::where('status_pesanan', '=', 4);
        if ($start) {
            $total = $total->whereBetween('tanggal_pesanan', [date('Y-m-d 00:00:00', strtotime($start)), date('Y-m-d 23:59:59', strtotime($end))]);
        }
        $total = $total->sum('total_harga');
        $data = [
            'start' => \request('start'),
            'end' => \request('end'),
            'data' => $pesanan,
            'total' => $total
        ];

        return view('admin/cetaklaporan')->with($data);
    }
}
