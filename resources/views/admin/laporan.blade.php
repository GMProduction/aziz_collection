@extends('admin.base')

@section('title')
    Data Barang
@endsection

@section('content')

    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            swal("Berhasil!", "Berhasil Menambah data!", "success");
        </script>
    @endif

    <section class="m-2">

        <div class="table-container">

            <div class="d-flex justify-content-between align-items-center mb-3">

            <h5 class="mb-3">Laporan</h5>
                <form id="formTanggal">
                    <div class="d-flex align-items-center">
                        <i class='bx bx-calendar me-2' style="font-size: 1.4rem"></i>
                        <div class="me-2">
                            <div class="input-group input-daterange">
                                <input type="text" class="form-control me-2" name="start" value="{{request('start')}}" required>
                                <div class="input-group-addon">to</div>
                                <input type="text" class="form-control ms-2" name="end" value="{{request('end')}}" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mx-2">Cari</button>
                        <a class="btn btn-warning" id="cetak" target="_blank">Cetak</a>
                    </div>
                </form>

            </div>

            <table class="table table-striped table-bordered ">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nama Pelanggan</th>
                    <th class="text-center">Tanggal Pembelian</th>
                    <th class="text-center">Produk</th>
                    <th class="text-center">Ongkir</th>
                    <th class="text-center">Total Harga</th>
                </tr>
                </thead>

                @forelse($data as $key => $d)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$d->getPelanggan->nama}}</td>
                        <td>{{date('d F Y', strtotime($d->tanggal_pesanan))}}</td>
                        <td>
                            <table class="table mb-0">
                                @foreach($d->getKeranjang as $num => $k)
                                    <tr>
                                        <td rowspan="2" class="py-0">{{$num + 1}}</td>
                                        <td colspan="5" class="py-0 border-bottom-0">{{$k->getProduk->nama_produk}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-0">{{number_format($k->getProduk->harga,0)}}</td>
                                        <td class="py-0">x</td>
                                        <td class="py-0">{{$k->qty}}</td>
                                        <td class="py-0">=</td>
                                        <td class="py-0">{{number_format($k->total_harga,0)}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                        <td>Rp. {{number_format($d->biaya_pengiriman, 0)}}</td>
                        <td>Rp. {{number_format($d->total_harga, 0)}}</td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidan ada data pesanan</td>
                    </tr>
                @endforelse

            </table>
            <div class="d-flex justify-content-end">
                {{$data->links()}}
            </div>
            <div class="d-flex justify-content-end">
                <h5>Total Pendapatan : Rp. {{number_format($total, 0)}}</h5>
            </div>
        </div>

    </section>

@endsection

@section('script')
    <script>
        $('.input-daterange input').each(function () {
            $(this).datepicker({
                format: "dd-mm-yyyy"
            });
        });
        $(document).on('click','#cetak', function () {
            console.log('/cetaklaporan?'+$('#formTanggal').serialize());
            $(this).attr('href', '/admin/cetaklaporan?'+$('#formTanggal').serialize());
        })
    </script>

@endsection
