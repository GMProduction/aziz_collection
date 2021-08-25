<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kaka Acc | Pengging Boyolali</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/myStyle.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/gambar.css') }}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shimer.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}"/>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet"/>
    <script src="{{ asset('js/swal.js') }}"></script>

    @yield('moreCss');
</head>

<body class="antialiased">
<header>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top navtop">
        <div class="container">
            <div class="d-flex items-center">
                <a href="/">
                    <img src="{{ asset('static-image/logo.png') }}" style="height: 40px;"/>

                </a>

            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
                    aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarToggler">
                <ul class="navbar-nav mb-2 mb-lg-0 w-50 ms-auto">
                    <form class="form-inline w-100" action="/produk">
                       @if(request('kategori'))
                            <input name="kategori" value="{{request('kategori')}}" hidden>
                           @endif
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" id="inputPassword2" name="produk" placeholder="Cari Produk">
                        </div>
                        <button type="submit" hidden ></button>
                    </form>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="/produk">Produk</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/tentang-kami">Tentang Kami</a>
                    </li>
                </ul>

                <div style="width: 100px">
                    <svg class="icon-sosmed" viewBox="0 0 24 24">
                        <path
                            d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96A10 10 0 0 0 22 12.06C22 6.53 17.5 2.04 12 2.04Z"/>
                    </svg>

                    <svg class="icon-sosmed" viewBox="0 0 24 24">
                        <path
                            d="M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z"/>
                    </svg>
                </div>

                @if (auth()->user())
                    @if(auth()->user()->roles == 'user')
                        <a style="position: relative;" href="/{{auth()->user()->roles}}/keranjang">
                            <i id="iconCart" class='bx bx-cart-alt profile-userpic me-3' style="font-size: 1.7rem; position: relative;">

                            </i>
                        </a>
                    @endif
                    <div class="dropdown">
                        <a class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="profile-userpic" src="{{ asset('static-image/profile.png') }}"/>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right">
                            <a href="/{{auth()->user()->roles}}" class="dropdown-item" style="width: unset">Dashboard</a>
                            <a href="/logout" class="dropdown-item" style="width: unset">Logout</a>
                        </div>
                    </div>

                @else
                    <a href="#!" id="loginButton" class="btn btn-outline-primary btn-sm">Login</a>
                @endif

            </div>
        </div>
    </nav>

</header>
<main>
    <div class="content-wrapper">
        <a class="tombol-wa" href="https://wa.me/send?phone=6289654649151">
            <img src="{{ asset('static-image/WhatsApp.png') }}"/>
        </a>
        @yield('content')
    </div>
</main>

<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" id="formLogin" onsubmit="return Login()" method="post">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                    </div>
                    <div class="form-group mb-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary btn-sm border-0 w-100" type="submit" name="submit">Login</button>
                        <span class="d-block mt-2">Anda Pengguna Baru ?<a class="ms-2 link" href="#!" id="registerButton">Buat akun.</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalRegister" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="formRegister" onsubmit="return saveRegister()">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <label for="namaeditbarang" class="form-label t">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-2 text-left">
                                <label for="namaeditbarang" class="form-label t">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>

                            <div class="mb-2 text-left">
                                <label for="namaeditbarang" class="form-label t">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>


                            <div class="mb-2 text-left">
                                <label for="namaeditbarang" class="form-label t">Password Konfirmasi</label>
                                <input type="password" class="form-control" id="password" name="password_confirmation" required>
                            </div>
                            <div class="mb-2">
                                <label for="namaeditbarang" class="form-label t">No. Hp</label>
                                <input type="number" class="form-control" id="no_hp" name="no_hp" required>
                            </div>
                            <div class="mb-2">
                                <label for="ttlsiswa" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                            </div>

                            <div class="text-center mt-5">
                                <button class="btn btn-primary btn-sm border-0 ms-auto" type="submit"
                                        name="submit">Register
                                </button>
                                <span class="d-block mt-2">Sudah punya akun ? <a class="ms-2 link"
                                                                                 href="#!" id="loginButton">Sign In.</a></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="container-fluid footerstyle">
    <div class="footer-up">
        <div class="row row-cols-lg-3">
            <div class="col">
                <p class="title-footer">
                    Contact
                </p>

                <div class="content-footer">
                    <table>
                        <td style="vertical-align:top">
                            <svg class="icon me-2" viewBox="0 0 24 24">
                                <path
                                    d="M12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5M12,2A7,7 0 0,1 19,9C19,14.25 12,22 12,22C12,22 5,14.25 5,9A7,7 0 0,1 12,2M12,4A5,5 0 0,0 7,9C7,10 7,12 12,18.71C17,12 17,10 17,9A5,5 0 0,0 12,4Z"/>
                            </svg>
                        </td>

                        <td>
                            <p>Jl. Pengging- Banyudono, Cikalang, Ngaru Aru, Kec. Banyudono, Kabupaten Boyolali,
                                Jawa Tengah 57373
                            </p>

                        </td>

                    </table>
                </div>

                <table>
                    <td style="vertical-align:top">
                        <svg class="icon me-2" viewBox="0 0 24 24">
                            <path
                                d="M20,15.5C18.8,15.5 17.5,15.3 16.4,14.9C16.3,14.9 16.2,14.9 16.1,14.9C15.8,14.9 15.6,15 15.4,15.2L13.2,17.4C10.4,15.9 8,13.6 6.6,10.8L8.8,8.6C9.1,8.3 9.2,7.9 9,7.6C8.7,6.5 8.5,5.2 8.5,4C8.5,3.5 8,3 7.5,3H4C3.5,3 3,3.5 3,4C3,13.4 10.6,21 20,21C20.5,21 21,20.5 21,20V16.5C21,16 20.5,15.5 20,15.5M5,5H6.5C6.6,5.9 6.8,6.8 7,7.6L5.8,8.8C5.4,7.6 5.1,6.3 5,5M19,19C17.7,18.9 16.4,18.6 15.2,18.2L16.4,17C17.2,17.2 18.1,17.4 19,17.4V19Z"/>
                        </svg>
                    </td>

                    <td>
                        <p>0813 2969 4570
                        </p>

                    </td>

                </table>

                <table>
                    <td style="vertical-align:top">
                        <svg class="icon me-2" viewBox="0 0 24 24">
                            <path
                                d="M22 6C22 4.9 21.1 4 20 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6M20 6L12 11L4 6H20M20 18H4V8L12 13L20 8V18Z"/>
                        </svg>
                    </td>

                    <td>
                        <p>kakacc@gmail.com</p>

                    </td>

                </table>


            </div>
            <div class="col">
                <p class="title-footer">Menu</p>
                <div class="content-footer">
                    <a href="/belanja" class="d-block link">Belanja</a>
                    <a href="/tentang-kami" class="d-block link">Tentang Kami</a>
                </div>
            </div>

            <div class="col">
                <p class="title-footer">Stay Connected</p>
                <div class="d-flex">
                    <svg class="icon-sosmed me-2" viewBox="0 0 24 24">
                        <path
                            d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96A10 10 0 0 0 22 12.06C22 6.53 17.5 2.04 12 2.04Z"/>
                    </svg>

                    <svg class="icon-sosmed" viewBox="0 0 24 24">
                        <path
                            d="M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    {{-- <div style="height: 50px; background-color: #1caa5c" class="d-flex justify-content-center align-items-center">
        <p class="mb-0 "> Copy Right 2020</p>
    </div> --}}

</footer>

<script src="{{ asset('bootstrap/js/jquery.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/myStyle.js') }}"></script>
<script type="text/javascript" src="{{ asset('slick/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dialog.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown()
        getJumKeranjang();
    })

    function getJumKeranjang() {
        $.get('/get-keranjang', function (data) {
            if (data > 0) {
                $('#iconCart').html('<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">\n' +
                    '                                    <span class="visually-hidden">New alerts</span>\n' +
                    '                                  </span>')
            }
        })
    }

    $(document).on('click', '#loginButton', function () {
        $('#modalLogin').modal('show')
        $('#modalRegister').modal('hide')
    })

    $(document).on('click', '#registerButton', function () {
        $('#modalRegister').modal('show')
        $('#modalLogin').modal('hide')
    })

    function saveRegister() {
        saveData('Register', 'formRegister', '/register-member')
        return false;
    }

    function Login() {
        saveData('Login', 'formLogin', '/login')
        return false;
    }
</script>


@yield('script')


</body>

</html>
