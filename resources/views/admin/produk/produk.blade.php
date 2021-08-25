@extends('admin.base')

@section('title')
    Data Barang
@endsection
@section('css')

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
                <h5>Data Produk</h5>
                <a type="button ms-auto" class="btn btn-primary btn-sm" id="addData" href="/admin/produk/data">Tambah Data
                </a>
            </div>


            <table class="table table-striped table-bordered ">
                <thead>
                <th>#</th>
                <th>nama Produk</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Sisa Stok</th>
                <th>Harga</th>
                <th>Action</th>
                </thead>
                @forelse($data as $key => $d)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$d->nama_produk}}</td>
                        <td>{{$d->getKategori->nama_kategori}}</td>
                        <td>{{$d->stok}}</td>
                        <td>{{$d->sisa}}</td>
                        <td>Rp. {{number_format($d->harga,0)}}</td>
                        <td>
                            <a type="button" class="btn btn-success btn-sm" id="editData" href="/admin/produk/data?id={{$d->id}}">Ubah
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus('id', 'nama') ">hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="5">Tidak ada data produk</td>
                    </tr>
                @endforelse
            </table>

        </div>

    </section>

@endsection

@section('script')

    <script>
        $(document).ready(function () {

        })
    </script>

@endsection
