<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
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
        $data  = [
            'start' => \request('start'),
            'end'   => \request('end'),
            'data'  => $pesanan,
            'total' => $total,
        ];

        return view('admin/cetaklaporan')->with($data);
    }

    public function grafig()
    {
        $pesanan = Keranjang::whereHas(
            'getPesanan',
            function ($q) {
                $q->where('status_pesanan', '=', 4);
            }
        )->selectRaw('Sum(qty) as jum,produks.nama_produk as nama, kategoris.nama_kategori')->groupBy('id_produk', 'produks.nama_produk', 'kategoris.nama_kategori')->join(
            'produks',
            'keranjangs.id_produk',
            '=',
            'produks.id'
        )->join('kategoris', 'produks.id_kategori','=','kategoris.id')->orderBy('jum', 'DESC')->orderBy('keranjangs.created_at', 'ASC')->get();
        return view('admin.grafig')->with(['data' => $pesanan]);
    }

    public function getChart()
    {
        $pesanan = Keranjang::whereHas(
            'getPesanan',
            function ($q) {
                $q->where('status_pesanan', '=', 4);
            }
        )->selectRaw('Sum(qty) as jum,produks.nama_produk as nama, DATE_FORMAT(keranjangs.created_at,"%b") as bulan')->groupBy('id_produk', 'keranjangs.created_at', 'produks.nama_produk')->join(
            'produks',
            'keranjangs.id_produk',
            '=',
            'produks.id'
        )->orderBy('produks.nama_produk', 'ASC')->orderBy('keranjangs.created_at', 'ASC')->get();

        $pesananKolom = Keranjang::whereHas(
            'getPesanan',
            function ($q) {
                $q->where('status_pesanan', '=', 4);
            }
        )->selectRaw('produks.nama_produk as nama, DATE_FORMAT(keranjangs.created_at,"%b") as bulan')->groupBy('id_produk', 'keranjangs.created_at', 'produks.nama_produk')->join(
            'produks',
            'keranjangs.id_produk',
            '=',
            'produks.id'
        )->orderBy('keranjangs.created_at', 'ASC')->get();

        $dataChart = [];
        $dataBulan = [];
        $dataNama  = [];
        foreach ($pesanan as $key => $p) {
            $dataChart[][$p->bulan][0][$p->nama] = $p->jum;
            $dataBulan[]['bulan']              = $p->bulan;
            $dataNama[]['nama']                = $p->nama;
        }
//        usort($dataChart, array('App\Http\Controllers\Admin\LaporanController', 'cmp'));
        $data = [
            'bulan' => array_unique($dataBulan, SORT_REGULAR),
            'nama'  => array_unique($dataNama, SORT_REGULAR),
            'chart' => $dataChart,
        ];

        return $data;
    }

    private static function cmp($a, $b)
    {
        return strcmp($a['bulan'], $b['bulan']);
    }
}
