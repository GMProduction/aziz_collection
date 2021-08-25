@extends('user.dashboard')

@section('contentUser')

  

    <section class="container">

        <div class="row item-box">
            <div class="col-6">
                <div class="d-flex">

                    <div class="ms-4">
                        <p class="title mb-0">Nomor Pesanan : 123</p>
                        <hr>
                        <p class="qty">tanggal</p>
                        <p class="keterangan">alamat pengiriman</p>
                        <p class="totalHarga">Total Harga</p>
                    </div>

                </div>

            </div>

            <div class="col-6">
                <p>Produk yang di beli</p>
                <div class="item-box">
                    <div class="d-flex">
                        <img
                            src="https://fastwork.id/blog/wp-content/uploads/2018/09/desain-undangan-pernikahan-736x540.jpg" />
                        <div class="ms-4 flex-fill">
                            <div class="d-flex justify-content-between">
                                <p class="title">Nama Produk</p>
                                <a class="d-block" style="cursor: pointer">
                                    <i class='bx bx-trash'></i>
                                </a>
                            </div>
                            <p class="qty mb-3">Qty</p>
                            <p class="keterangan mb-0">Keterangan</p>
                        </div>

                    </div>

                </div>

                <div class="item-box">
                    <div class="d-flex">
                        <img
                            src="https://fastwork.id/blog/wp-content/uploads/2018/09/desain-undangan-pernikahan-736x540.jpg" />
                        <div class="ms-4 flex-fill">
                            <div class="d-flex justify-content-between">
                                <p class="title">Nama Produk</p>
                                <a class="d-block" style="cursor: pointer">
                                    <i class='bx bx-trash'></i>
                                </a>
                            </div>
                            <p class="qty mb-3">Qty</p>
                            <p class="keterangan mb-0">Keterangan</p>
                        </div>

                    </div>

                </div>
               
            </div>
        </div>


        <!-- Modal Tambah-->
        <div class="modal fade" id="register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Register</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Payment Slip</label>
                                <input class="form-control" type="file" id="formFile">
                            </div>


                            <div class="mb-4"></div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>


@endsection

@section('scriptUser')

    <script>
        $(document).ready(function() {
            
            $("#proses").addClass("active");
        });
    </script>

@endsection
