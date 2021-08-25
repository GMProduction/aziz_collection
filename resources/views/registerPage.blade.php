<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Peminjaman Alat</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bona+Nova:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/myStyle.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" type="text/css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Styles -->

</head>


<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card login-content shadow-lg border-0">
                    <div class="card-body">

                        <h3 class="text-logo">Register</h3>
                        <br>
                        <form>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-2">
                                        <label for="namaeditbarang" class="form-label t">Name</label>
                                        <input type="text" class="form-control" id="namaeditbarang">
                                    </div>
                                    <div class="mb-2 text-left">
                                        <label for="namaeditbarang" class="form-label t">Country</label>
                                        <input type="text" class="form-control" id="namaeditbarang">
                                    </div>

                                    <div class="mb-2 text-left">
                                        <label for="namaeditbarang" class="form-label t">Institude</label>
                                        <input type="email" class="form-control" id="namaeditbarang">
                                    </div>


                                    <div class="mb-2 text-left">
                                        <label for="namaeditbarang" class="form-label t">Email</label>
                                        <input type="email" class="form-control" id="namaeditbarang">
                                    </div>

                                    <div class="mb-2">
                                        <label for="ttlsiswa" class="form-label">Date Of Birth</label>
                                        <input type="text" class="form-control" id="datepicker">
                                    </div>
                                </div>

                                <div class="col-lg-6">

                                    <label class="mb-2">Gender</label>
                                    <div class="d-flex">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault1" checked>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Man
                                            </label>
                                        </div>
                                        <div class="form-check ms-3">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault2">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Woman
                                            </label>
                                        </div>
                                    </div>



                                    <div class="mt-3 mb-2">
                                        <label for="formFile" class="form-label">Paspor</label>
                                        <input class="form-control" type="file" id="formFile">
                                    </div>

                                    <div class="mb-2 text-left">
                                        <label for="namaeditbarang" class="form-label t">Phone</label>
                                        <input type="email" class="form-control" id="namaeditbarang">
                                    </div>
                                    <div class="mb-2 text-left">
                                        <label for="namaeditbarang" class="form-label t">Address</label>
                                        <input type="email" class="form-control" id="namaeditbarang">
                                    </div>

                                    <div class="text-center mt-5">
                                        <button class="btn btn-primary btn-sm border-0 ms-auto" type="submit"
                                            name="submit">Register</button>
                                        <span class="d-block mt-2">Have an account ? <a class="ms-2 link"
                                                href="/register">Sign In.</a></span>
                                    </div>

                                </div>
                            </div>




                        </form>
                    </div>

                </div>

		<div style="height: 50px"></div>

            </div>
        </div>
    </div>

    <script src="{{ asset('bootstrap/js/jquery.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/myStyle.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker();
        });
    </script>
</body>


</html>
