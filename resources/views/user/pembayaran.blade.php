@extends('user.dashboard')

@section('contentUser')

<style>
    #tabelKeranjang>:not(caption)>*>*{
        border: 0 !important;
    }
</style>

    <section class="container">

        <div class="row item-box mb-5">
            <p class="fw-bold">Pembayaran Bisa di Lakukan di</p>

            @forelse($bank as $b)
                <div class="item-box mb-2">
                    <div class="d-flex">
                        <img
                            src="{{$b->url_gambar}}"/>
                        <div class="ms-4 flex-fill">
                            <div class="d-flex justify-content-between">
                                <p class="title">{{$b->nama_bank}}</p>
                            </div>
                            <p class=" qty mb-0">Holder Name : {{$b->holder_bank}}</p>
                            <p class="keterangan mb-3">No Rekening : {{$b->norek}}</p>
                        </div>

                    </div>

                </div>
            @empty
            @endforelse
            <label class="fw-bold">Batas waktu pembayaran maksimal 1 x 24 jam</label>

        </div>

        @forelse($data as $d)
            <div class="row item-box mb-4">
                <div class="col-12">
                    <div class="">

                        <div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="title mb-0">Nomor Pesanan : {{$d->id}}</p>
                                    <p class="qty">{{date('d F Y', strtotime($d->tanggal_pesanan))}}</p>
                                </div>
                                <div>
                                    <a class="btn bt-primary btn-sm ms-auto" data-id="{{$d->id}}" id="addBukti">Upload Pembayaran</a>
                                </div>
                            </div>

                            <hr>
                            <p class="mb-0 fw-bold">Alamat Pengiriman</p>
                            <div class="row">
                                <div class="col-3">
                                    <p class="mb-0">{{auth()->user()->nama}}</p>
                                    <p>{{auth()->user()->no_hp}}</p>
                                </div>
                                <div class="col"><p class="keterangan">{{$d->getExpedisi->nama_kota}} - {{$d->getExpedisi->nama_propinsi}}</p>
                                    <p class="keterangan">{{$d->alamat_pengiriman}}</p></div>
                            </div>
                            <hr>

                        </div>
                    </div>
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
                               <td class="text-end border-0"><p>Rp. {{number_format($d->total_harga - $d->biaya_pengiriman,0)}}</p> </td>
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

    <!-- Modal Tambah-->
        <div class="modal fade" id="uploadpembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form" onsubmit="return saveBukti()">
                            @csrf
                            <input id="id" name="id" hidden>
                            <div class="mb-3">
                                <label for="image" class="form-label">Bukti Transfer</label>
                                <input class="form-control" type="file" id="image" name="image" required accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Bank</label>
                                <select id="bank" name="bank" class="form-control" required></select>
                            </div>
                            <div class="mb-4"></div>
                            <button type="submit" class="btn bt-primary">Save</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>


@endsection

@section('scriptUser')

    <script>
        $(document).ready(function () {

            $("#pembayaran").addClass("active");
        });

        function afterSave() {

        }

        function saveBukti() {
            saveData('Upload Bukti', 'form')
            return false;
        }

        $(document).on('click', '#addBukti', function () {
            var id = $(this).data('id');
            getBank()
            $('#uploadpembayaran #id').val(id);
            $('#uploadpembayaran').modal('show');
        })

        function getBank(idValue) {
            var select = $('#bank');
            select.empty();
            select.append('<option value="" disabled selected>Pilih Data</option>')
            $.get('/bank', function (data) {
                $.each(data, function (key, value) {
                    if (idValue === value['id']) {
                        select.append('<option value="' + value['id'] + '" selected>' + value['nama_bank'] + ' ( an. ' + value['holder_bank'] + ' )</option>')
                    } else {
                        select.append('<option value="' + value['id'] + '">' + value['nama_bank'] + ' ( an. ' + value['holder_bank'] + ' )</option>')
                    }
                })
            })
        }
    </script>

@endsection
