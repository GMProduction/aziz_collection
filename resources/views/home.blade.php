@extends('base')

@section('moreCss')
@endsection

@section('content')

    <section>
        <div style="height: 57px"></div>

        <div id="slider" class="">
            <div style="height: 500px" class="w-100 shine">

            </div>
        </div>

        <div style="height: 50px"></div>
    </section>
    <section class="container">
        <h4 class="text-center fw-bold">Kategori</h4>
        <div id="kategori" class="">
            <div class="row" style="height: 150px">
                @for($i = 0; $i < 6; $i++)
                    <div class="col shine mx-2"></div>
                @endfor
            </div>
        </div>


        <div style="height: 50px"></div>
        <div>
            <h4 class="mb-5 text-center fw-bold">Rekomendasi Untukmu</h4>

            <div class="row" id="produk" style="min-height: 400px">
                @for($i = 0; $i < 4; $i++)
                    <div class="col shine mx-2"></div>
                @endfor
            </div>


        </div>
    </section>


@endsection

@section('script')

    <script>
        $(document).ready(function () {

            getBaner();
            getkategori();
            getproduk();
        });

        function getkategori() {
            $.get('/kategori', function (data) {
                if (data.length > 0) {
                    var kategori = $('#kategori');
                    kategori.empty();
                    $('#kategori').addClass('slider-kategori');
                    $.each(data, function (key, value) {
                        kategori.append('<div>\n' +
                            '                <a class="card-kategori d-flex flex-column" href="/produk?kategori=' + value['nama_kategori'] + '">\n' +
                            '                    <img\n' +
                            '                         src="' + value['url_foto'] + '">\n' +
                            '                    <p class="title">' + value['nama_kategori'] + '</p>\n' +
                            '                </a>\n' +
                            '            </div>')
                    })
                    $('.slider-kategori').slick({
                        infinite: true,
                        slidesToShow: 6,
                        slidesToScroll: 1
                    });
                } else {
                    kategori.append('<h4 class="text-center">Tidak ada kategori</h4>')
                }

            })
        }

        function getBaner() {
            $.get('/baner', function (data) {
                if (data.length > 0) {
                    var slider = $('#slider');
                    slider.empty();
                    $('#slider').addClass('slider');
                    $.each(data, function (key, value) {
                        slider.append('<img  src="'+value['url_gambar']+'"/>')
                    })
                    $('.slider').slick({
                        dots: true,
                        infinite: true,
                        speed: 500,
                        fade: true,
                        cssEase: 'linear',
                        autoplay: true,
                        autoplaySpeed: 2000,
                        arrows: false
                    });
                }else{
                    slider.append('<h4 class="text-center">Tidak ada baner</h4>')
                }
            })
        }

        function getproduk() {
            $.get('/get-produk-recomend', function (data) {
                console.log(data)
                if (data.length > 0) {
                    var produk = $('#produk');
                    produk.empty();

                    $.each(data, function (key, value) {
                        var foto = value['get_image'].length > 0 ? value['get_image'][0]['url_foto'] : "{{asset('/static-image/noimage.jpg')}}";
                        produk.append('<div class="col-lg-3 col-md-6 col-sm-12">\n' +
                            '                    <a class="cardku" href="/produk/detail/' + value['id'] + '">\n' +
                            '                        <img\n' +
                            '                            src="' + foto + '"/>\n' +
                            '                        <div class="content">\n' +
                            '                            <p class="title mb-0">' + value['nama_produk'] + '</p>\n' +
                            '                            <p class="description mb-0">' + value['get_kategori']['nama_kategori'] + '</p>\n' +
                            '                            <p class="description mb-0">Rp. ' + value['harga'].toLocaleString() + '</p>\n' +
                            '\n' +
                            '                        </div>\n' +
                            '                    </a>\n' +
                            '                </div>')
                    })
                } else {
                    produk.append('<h4 class="text-center">Tidak ada kategori</h4>')
                }
            })
        }
    </script>

@endsection
