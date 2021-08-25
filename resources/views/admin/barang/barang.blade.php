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
                <h5>Data Barang</h5>
                <button type="button ms-auto" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#tambahbarang">Tambah Data</button>
            </div>


            <table class="table table-striped table-bordered ">
                <thead>
                    <th>
                        #
                    </th>
                    <th>
                        nama Barang
                    </th>
                    <th>
                        Jumlah
                    </th>

                    <th>
                        Stock
                    </th>

                    <th>
                        Action
                    </th>

                </thead>

                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        Bola Kasti
                    </td>
                    <td>
                        8
                    </td>
                    <td>
                        5
                    <td>
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editbarang">Ubah</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapus('id', 'nama') ">hapus</button>
                    </td>
                </tr>

            </table>

        </div>


        <div>


            <!-- Modal Tambah-->
            <div class="modal fade" id="tambahbarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="namabarang" class="form-label">Nama Barang</label>
                                    <input type="email" class="form-control" id="namabarang">
                                </div>

                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <div class="d-flex">
                                        <select class="form-select" aria-label="Default select example" name="idguru">
                                            <option selected>Mata Pelajaran</option>
                                            <option value="1">Erfin</option>
                                            <option value="2">Joko A</option>
                                            <option value="3">Joko B</option>
                                        </select>
                                        <a class="btn btn-primary">+</a>
                                    </div>
                                </div>

                                <div class="mt-3 mb-2">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input class="form-control" type="file" id="gambar">
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" id="jumlah">
                                </div>


                                <div class="mb-4"></div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal Edit-->
            <div class="modal fade" id="editbarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="namaeditbarang" class="form-label">Nama Barang</label>
                                    <input type="email" class="form-control" id="namaeditbarang">
                                </div>
                                <div class="mb-3">
                                    <label for="jumlahedit" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" id="jumlahedit">
                                </div>

                                <div class="mb-4"></div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
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

        })

        function hapus(id, name) {
            swal({
                    title: "Menghapus data?",
                    text: "Apa kamu yakin, ingin menghapus data ?!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Berhasil Menghapus data!", {
                            icon: "success",
                        });
                    } else {
                        swal("Data belum terhapus");
                    }
                });
        }
    </script>

@endsection
