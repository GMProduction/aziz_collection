@extends('base')

@section('moreCss')

<link rel="stylesheet" type="text/css" href="{{ asset('css/tab.css') }}" />

@endsection

@section('content')

    <section>
        <div style="height: 80px"></div>


    </section>
    <section class="container">



        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <p class="category">Selamat datang {{auth()->user()->nama}}</p>
                    <!-- Nav tabs -->
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs justify-content-center" role="tablist">

                                <li class="nav-item">
                                    <a id="keranjang" class="nav-link" data-toggle="tab" href="/user/keranjang" role="tab">
                                        <i class="bx bx-cart"></i> Keranjang
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a id="pembayaran" class="nav-link" data-toggle="tab" href="/user/pembayaran" role="tab">
                                        <i class="bx bx-time-five"></i> Pembayaran
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="menunggu" class="nav-link" data-toggle="tab" href="/user/menunggu" role="tab">
                                        <i class='bx bx-message-rounded-edit'></i> Menunggu Konfirmasi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="dikemas" class="nav-link" data-toggle="tab" href="/user/dikemas" role="tab">
                                        <i class='bx bxs-box'></i> Dikemas
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="pengiriman" class="nav-link" data-toggle="tab" href="/user/pengiriman" role="tab">
                                        <i class='bx bxs-truck' ></i> Pengiriman
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a id="selesai" class="nav-link" data-toggle="tab" href="/user/selesai" role="tab">
                                        <i class='bx bx-check' ></i> Selesai
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a id="profil" class="nav-link" data-toggle="tab" href="/user/profile" role="tab">
                                        <i class='bx bx-user'></i> Profil
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body" style="min-height: 23vh">
                            <!-- Tab panes -->
                            @yield('contentUser')
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </section>


@endsection

@section('script')

    <script>
        $(document).ready(function() {

            $("#menunggu").removeClass("active");
            $("#proses").removeClass("active");
            $("#pengiriman").removeClass("active");
            $("#dikemas").removeClass("active");
            $("#selesai").removeClass("active");
            $("#profil").removeClass("active");

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
        });
    </script>

    @yield('scriptUser')
@endsection
