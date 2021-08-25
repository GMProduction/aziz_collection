@extends('admin.base')

@section('title')
    Dashboard
@endsection

@section('content')

    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            swal("Berhasil!", "Berhasil Menambah data!", "success");
        </script>
    @endif

    <section class="m-2">

        <div class="table-container">

            <div class="d-flex">
                <h5 class="mb-3">Pesanan Baru</h5>
            </div>

            <table class="table table-striped table-bordered ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal Pesan</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>

                @forelse($data as $key => $d)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$d->getPelanggan->nama}}</td>
                        <td>{{date('d F Y', strtotime($d->tanggal_pesanan))}}</td>
                        <td>Rp. {{number_format($d->total_harga, 0)}}</td>
                        <td>{{$d->status_pesanan == 1 ? 'Menungu Konfirmasi' : ($d->status_pesanan == 2 ? 'Dikemas' : ($d->status_pesanan == 3 ? 'Dikirim' : ($d->status_pesanan == 4 ? 'Selesai' : ($d->status_pesanan === 5 ? 'Dikembalikan' : 'Menunggu Pembayaran' ))))}}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-id="{{$d->id}}" id="detailData">Detail
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidan ada data pesanan</td>
                    </tr>
                @endforelse

            </table>


        </div>


        <!-- Modal Detail-->
        <div class="modal fade" id="detail1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row ">
                            <div class="col-8">
                                <div class="row  border rounded p-3 g-2">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="dtanggalPesanan" class="form-label fw-bold">Tanggal</label>
                                            <p id="dtanggalPesanan"></p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="dNamaPelanggan" class="form-label fw-bold">Nama Pelanggan</label>
                                            <p id="dNamaPelanggan"></p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="dAlamatPengiriman" class="form-label fw-bold">Alamat Pengiriman</label>
                                            <p id="dAlamatPengirimanKota" class="mb-0"></p>
                                            <textarea type="text" class="form-control" readonly
                                                      id="dAlamatPengiriman"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="dNamaPelanggan" class="form-label fw-bold">Detail Expedisi</label>
                                            <p id="" class="mb-0">Expedisi : <span id="dExpedisi"></span> </p>
                                            <p id="">Estimasi : <span id="dEstimasi"></span></p>
                                        </div>
                                        <p class="mb-0 fw-bold">Biaya</p>
                                        <div class="d-flex justify-content-between">
                                            <p>Pesanan</p>
                                            <h5 class="mb-0" id="dBiaya"></h5>

                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <p>Ongkir</p>
                                            <h5 class="mb-0" id="dOngkir"></h5>

                                        </div>

                                        <hr>

                                        <div class="d-flex justify-content-between">
                                            <p>Total</p>
                                            <h4 class="mb-5 fw-bold" id="dTotal"></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 border rounded px-3">
                                <div class="mb-3">
                                    <a for="dBuktiTransfer" class="d-block">Bukti Transfer</a>
                                    <a id="dBuktiTransfer" style="cursor: pointer"
                                       href=""
                                       target="_blank">
                                        <img src=""
                                             style="width: 100px; height: 50px; object-fit: cover"/>
                                    </a>
                                </div>

                                <div class="mb-3 d-none" id="btnKonfirmasi">
                                    <label for="kategori" class="form-label">Konfirmasi Pembayaran</label>
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-sm btn-success me-2" onclick="saveKonfirmasi(2)">Terima</button>
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="saveKonfirmasi(0)">Tolak</button>
                                    </div>
                                </div>

                                <div>
                                    <p>Action</p>
                                    <a class="btn btn-sm btn-primary" id="dChat" target="_blank">chat</a>
                                    <a class="btn btn-sm btn-warning d-none" id="btnKirim" onclick="saveKonfirmasi(3)">Kirim Barang</a>
                                </div>

                                <div class="mt-3">
                                    <p class="mb-1">Status : <span id="dStatus" class="fw-bold"></span></p>
                                    <p id="dAlasan"></p>
                                </div>

                            </div>
                        </div>

                        <div class="table-container mt-5">
                            <h5 class="mb-3">Isi Keranjang Pesanan</h5>
                            <div style="max-height: 300px" class="overflow-auto">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Gambar</th>
                                        <th>Produk</th>
                                        <th>Qty</th>
                                        <th>Keterangan</th>
                                        <th>Total Harga</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tabelDetail"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#statusCari').val('{{request('status')}}')
        })
        var idPesanan;
        $(document).on('click', '#detailData', function () {
            idPesanan = $(this).data('id');
            getDetail(idPesanan);
            $('#detail1').modal('show');
        })

        $(document).on('change', '#statusCari', function () {
            document.getElementById('formCari').submit();
        })

        function getDetail() {
            $.get('/admin/pesanan/' + idPesanan, function (data) {
                console.log(data);
                $('#dNamaPelanggan').html(data['get_pelanggan']['nama'])
                $('#dChat').attr('href','https://wa.me/'+data['get_pelanggan']['no_hp'])
                $('#dAlamatPengirimanKota').html(data['get_expedisi']['nama_kota'] + ' - ' + data['get_expedisi']['nama_propinsi'])
                $('#dAlamatPengiriman').html(data['alamat_pengiriman'])
                $('#dtanggalPesanan').html(moment(data['tanggal_pesanan']).format('DD MMMM YYYY'))
                var biaya = parseInt(data['total_harga'] - data['biaya_pengiriman']);
                $('#dBiaya').html(biaya.toLocaleString())
                $('#dOngkir').html(data['biaya_pengiriman'].toLocaleString())
                $('#dTotal').html(data['total_harga'].toLocaleString())
                $('#dBuktiTransfer').attr('href', data['url_pembayaran'])
                $('#dBuktiTransfer img').attr('src', data['url_pembayaran'])
                $('#dExpedisi').html(data['get_expedisi']['nama'].toUpperCase()+' ( '+data['get_expedisi']['service']+' )')
                $('#dEstimasi').html(data['get_expedisi']['estimasi']+' Hari')
                var status = data['status_pesanan'];
                var txtStatus = 'Menunggu Pembayaran';
                $('#btnKonfirmasi').addClass('d-none')
                $('#btnKirim').addClass('d-none')
                $('#dAlasan').html('')
                if (status === 1) {
                    $('#btnKonfirmasi').removeClass('d-none')
                    txtStatus = 'Menunggu Konfirmasi'
                }else if(status === 2){
                    $('#btnKirim').removeClass('d-none')
                    txtStatus = 'Dikemas'
                }else if(status === 3){
                    txtStatus = 'Dikirim'
                    if(data['get_retur'] && data['get_retur']['status'] === 0){
                        txtStatus = 'Minta Retur'
                        $('#dAlasan').html(data['get_retur']['alasan'])
                    }
                }else if(status === 4){
                    txtStatus = 'Selesai'
                }else if(status === 5){
                    txtStatus = 'Dikembalikan'
                    $('#dAlasan').html(data['get_retur']['alasan'])
                }

                $('#dStatus').html(txtStatus)

                var tabel = $('#tabelDetail');
                tabel.empty();
                $.each(data['get_keranjang'], function (key, value) {
                    console.log(value['get_produk']['get_image'])
                    var foto = value['get_produk']['get_image'].length > 0 ? value['get_produk']['get_image'][0]['url_foto'] : '/static-image/noimage.jpg';
                    tabel.append('<tr>' +
                        '<td>' + parseInt(key + 1) + '</td>' +
                        '<td><img src="' + foto + '" height="50"/></td>' +
                        '<td>' + value['get_produk']['nama_produk'] + '</td>' +
                        '<td>' + value['qty'] + '</td>' +
                        '<td>' + value['keterangan'] + '</td>' +
                        '<td>' + value['total_harga'].toLocaleString() + '</td>' +
                        '</tr>')
                })
            })
        }

        function saveKonfirmasi(a) {
            var title = 'Tolak Pembayaran'
            if (a === 2) {
                title = 'Terima Pembayaran'
            }else if(a === 3){
                title = 'Kirim Pesanan'
            }
            var form_data = {
                'status' : a,
                '_token' : '{{csrf_token()}}'
            };
            saveDataObject(title,form_data,'/admin/pesanan/'+idPesanan,getDetail)
            return false;

        }
    </script>

@endsection
