@extends('user.dashboard')

@section('contentUser')



    <section class="container">

        @forelse($data as $d)
            <div class="row item-box mb-4">
                <div class="col-12">
                    <div class="col">
                       <div class="d-flex justify-content-between">
                           <div>
                               <p class="title mb-0">Nomor Pesanan : {{$d->id}}</p>
                               <p class="qty">{{date('d F Y', strtotime($d->tanggal_pesanan))}}</p>
                           </div>
                           <div>
                               <a class="btn bt-primary btn-sm" data-id="{{$d->id}}" id="showTerima">Terima</a>
                           </div>
                       </div>
                        <hr>
                        <div class="row">
                            <div class="row col-6">
                                <div class="col">
                                    <p class="mb-0 fw-bold">Alamat Pengiriman</p>
                                    <p class="mb-0">{{auth()->user()->nama}}</p>
                                    <p>{{auth()->user()->no_hp}}</p>
                                </div>
                                <div class="col pt-4"><p class="keterangan">{{$d->getExpedisi->nama_kota}} - {{$d->getExpedisi->nama_propinsi}}</p>
                                    <p class="keterangan">{{$d->alamat_pengiriman}}</p></div>
                            </div>
                            <div class="row col-6">
                                <div class="col">
                                    <p class="mb-0 fw-bold">Pembayaran</p>
                                    <p class="mb-0">{{$d->getBank->nama_bank}} an. {{$d->getBank->holder_bank}}</p>
                                    <p class="mb-0">Nomor Rekening : {{$d->getBank->norek}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                </div>

                <div class="col-12">
                    <table class="table border-0" id="tabelKeranjang">
                        <thead>
                        <tr>
                            <td colspan="2" class="fw-bold">Produk Dipesan</td>
                            <td class="text-center fw-bold">Harga Satuan</td>
                            <td class="text-center fw-bold">Jumlah</td>
                            <td class="text-end fw-bold">Subtotal Produk</td>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($d->getKeranjang as $k)
                            <tr class="item-box border-0 mt-1">
                                <td class="border-0"><img src="{{count($k->getProduk->getImage) > 0 ? $k->getProduk->getImage[0]->url_foto : asset('/static-image/noimage.jpg')}}"/></td>
                                <td class="border-0"><p class="title">{{$k->getProduk->nama_produk}}</p>
                                    <p class="keterangan mb-0">{{$k->keterangan}}</p></td>
                                <td class="border-0 text-center"><p class="qty">Rp. {{number_format($k->getProduk->harga,0)}}</p></td>
                                <td class="border-0 text-center"><p class="qty">{{$k->qty}}</p></td>
                                <td class="border-0 text-end"><p class="totalHarga mb-3" style="font-size: 1rem; color: black">Rp. {{number_format($k->total_harga,0)}}</p></td>
                            </tr>
                        @empty
                            <h5 class="text-center">Tidak ada data pembayaran</h5>
                        @endforelse
                        </tbody>
                    </table>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <table class=" mt-3" width="30%">
                            <tr style="border: none">
                                <td class="border-0"><p>Total Harga</p></td>
                                <td class="border-0"><p>:</p></td>
                                <td class="text-end border-0"><p>Rp. {{number_format($d->total_harga - $d->biaya_pengiriman,0)}}</p></td>
                            </tr>
                            <tr>
                                <td class="border-bottom"><p>Ongkir</p></td>
                                <td class="border-bottom"><p>:</p></td>
                                <td class="text-end border-bottom"><p>Rp. {{number_format($d->biaya_pengiriman,0)}}</p></td>
                            </tr>
                            <tr>
                                <td class="border-0"><p>Grand Total</p></td>
                                <td class="border-0"><p>:</p></td>
                                <td class="totalHarga text-end border-0 fw-bold"><p>Rp. {{number_format($d->total_harga, 0)}}</p></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        @empty
            <h4 class="text-center">Tidak ada data pesanan</h4>
        @endforelse
    </section>


@endsection

@section('scriptUser')

    <script>
        $(document).ready(function() {

            $("#pengiriman").addClass("active");
        });

        $(document).on('click', '#showTerima', function () {
            var id = $(this).data('id');
            var form_data = {
                'id': id,
                '_token': '{{csrf_token()}}'
            }
            saveDataObject('Terima Pesanan', form_data)
            return false;
        })
    </script>

@endsection
