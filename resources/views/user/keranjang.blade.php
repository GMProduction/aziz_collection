@extends('user.dashboard')



@section('contentUser')



    <section class="container">
        <div class="row">
            <div class="col-8">
                @forelse($data as $d)
                    <div class="item-box mb-2">
                        <div class="d-flex">
                            <img src="{{count($d->getProduk->getImage) > 0 ? $d->getProduk->getImage[0]->url_foto : asset('/static-image/noimage.jpg')}}"/>
                            <div class="ms-4 flex-fill">
                                <div class="d-flex justify-content-between">
                                    <p class="title">{{$d->getProduk->nama_produk}}</p>
                                    <a class="d-block" style="cursor: pointer" data-id="{{$d->id}}" data-nama="{{$d->getProduk->nama_produk}}" id="deleteData">
                                        <i class='bx bx-trash'></i>
                                    </a>
                                </div>
                                <p class="qty">Qty : {{$d->qty}}</p>
                                <p class="qty mb-3">Keterangan : {{$d->keterangan}}</p>
                                <p class="totalHarga mb-3">Harga : Rp. {{number_format($d->total_harga,0)}}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <h5 class="text-center">Tidak ada data keranjang</h5>
                @endforelse
            </div>

            <div class="col-4">
                @if(count($data) > 0)
                    <form id="form" onsubmit="return savePesanan()">
                        @csrf
                        <div class="item-box">
                            <div class="mb-3">
                                <label for="qty" class="form-label">Kota Pengiriman</label>
                                <select class=" me-2 w-100" aria-label="Default select example" id="kota" name="kota" onchange="setOngkir()" required>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="qty" class="form-label">Expedisi</label>
                                <select class=" me-2 w-100" aria-label="Default select example" id="kurir" name="kurir" onchange="setOngkir()">
                                    <option selected value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="pos">POS Indonesia</option>
                                </select>
                            </div>
                            <div id="tipeKurir" class="mb-3"></div>
                            <div class="mb-3">
                                <label for="keteranganTambahan" class="form-label">Alamat Detail Pengiriman</label>
                                <textarea class="form-control" id="alamat" rows="3" name="alamat" required></textarea>
                            </div>

                            <p class="mb-0 mt-5 fw-bold">Biaya</p>
                            <div class="d-flex justify-content-between">
                                <p>Pesanan</p>
                                <h5 class="mb-0" id="txtTotalPesanan"></h5>

                            </div>

                            <div class="d-flex justify-content-between">
                                <p>Ongkir</p>
                                <h5 class="mb-0" id="txtOngkir">Rp. 12.000</h5>

                            </div>

                            <hr>
                            <input id="ongkir" name="ongkir" hidden>
                            <input id="service" name="service" hidden>
                            <input id="estimasi" name="estimasi" hidden>
                            <input id="namaKota" name="nama_kota" hidden>
                            <input id="propinsi" name="propinsi" hidden>
                            <input id="propinsiid" name="propinsiid" hidden>
                            <input id="totalHarga" name="totalHarga" hidden>
                            <div class="d-flex justify-content-between">
                                <p>Total</p>
                                <h4 class="mb-5 fw-bold" id="tampilTotal"></h4>

                            </div>

                            <div class="ms-auto">
                                <button type="submit" class="btn bt-primary ms-auto " data-bs-toggle="modal" data-bs-target="#submitpesanan">Submit
                                    Pesanan
                                </button>
                            </div>
                        </div>
                    </form>
                @endif

            </div>
        </div>


    </section>

@endsection

@section('scriptUser')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        var service, ongkir = 0, estimasi, total, subTotal;

        $(document).ready(function () {
            subTotal = parseInt('{{$jumlah}}');
            total = subTotal + ongkir;
            $('#txtTotalPesanan').html('Rp. ' + subTotal.toLocaleString())
            $('#tampilTotal').html(total.toLocaleString());
            $('#txtOngkir').html('Rp. ' + ongkir.toLocaleString())
            $("#keranjang").addClass("active");
            getCity()
        });

        function savePesanan() {
            saveData('Buat Pesanan', 'form')
            return false;
        }

        $(document).on('click', '#deleteData', function () {
            var id = $(this).data('id');
            var nama = $(this).data('nama');

            deleteData(nama, '/user/keranjang/'+id+'/delete');
            return false;
        })

        $(document).on('change', '[name=tipePaket]', function () {
            service = $(this).val();
            ongkir = $(this).data('biaya');
            estimasi = $(this).data('estimasi');
            total = subTotal + ongkir;
            $('#ongkir').val(ongkir);
            $('#service').val(service);
            $('#estimasi').val(estimasi);
            $('#txtOngkir').html(ongkir.toLocaleString());
            $('#tampilTotal').html(total.toLocaleString());
            $('#totalHarga').val(total);
        })

        function setOngkir() {
            var kurir = $('#kurir').val();
            var kota = $('#kota').val();
            var namaKota = $('#kota').find(':selected').data('nama');
            var propinsi = $('#kota').find(':selected').data('propinsi');
            var propinsiid = $('#kota').find(':selected').data('propinsiid');
            $('#namaKota').val(namaKota)
            $('#propinsi').val(propinsi)
            $('#propinsiid').val(propinsiid)
            var data = {
                'kurir': kurir,
                'tujuan': kota
            }
            $('#tipeKurir').html('');
            $.ajax({
                url: '/get-cost',
                dataType: 'json',
                type: 'GET',
                delay: 250,
                // crossDomain: true,
                data: data,

                error: function (error, xhr, textStatus) {

                },
                success: function (data) {
                    console.log(data)
                    console.log(data['rajaongkir']['results'][0]['costs'])
                    $('#tipeKurir').empty();
                    $('#tipeKurir').append('<label>Layanan Pengiriman</labell>');
                    $.each(data['rajaongkir']['results'][0]['costs'], function (key, value) {
                        $('#tipeKurir').append('<div class="form-check">\n' +
                            '  <input class="form-check-input" type="radio" required name="tipePaket" id="tipe' + key + '" data-estimasi="' + value['cost'][0]['etd'] + '" data-biaya="' + value['cost'][0]['value'] + '" value="' + value['service'] + '">\n' +
                            '  <label class="form-check-label" for="tipe' + key + '">\n' +
                            '    ' + value['service'] + ' ( ' + value['cost'][0]['etd'] + ' ) ' + value['cost'][0]['value'] + '\n' +
                            '  </label>\n' +
                            '</div>')
                    })
                },
                headers: {
                    'Accept': "application/json",
                    'key': '7366bbad708dcf7d2f1b3d69e5f4219f',
                    'Access-Control-Allow-Origin': 'http://localhost:8002/'
                },
                cache: true
            })
        }

        function getCity() {
            var select = $('#kota');
            $.ajax({
                url: '/get-city',
                dataType: 'json',
                type: 'GET',
                delay: 250,
                // crossDomain: true,
                callback: '?',

                error: function (error, xhr, textStatus) {

                },
                success: function (data) {
                    console.log(data['rajaongkir'])
                    select.append('<option value="">Pilih Kota Pengiriman</option>')
                    $.each(data['rajaongkir']['results'], function (key, value) {
                        select.append('<option value="' + value['city_id'] + '" data-nama="' + value['city_name'] + '" data-propinsi="' + value['province'] + '" data-propinsiid="' + value['province_id'] + '">' + value['city_name'] + '</option>')
                    })
                    select.select2();
                },
                headers: {
                    'Accept': "application/json",
                    'key': '7366bbad708dcf7d2f1b3d69e5f4219f',
                    'Access-Control-Allow-Origin': 'http://localhost:8002/'
                },

                cache: true
            })
        }
    </script>

@endsection
