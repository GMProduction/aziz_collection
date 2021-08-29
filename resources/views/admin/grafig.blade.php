@extends('admin.base')

@section('title')
    Data Barang
@endsection

@section('content')


    <section class="m-2">

        <div class="table-container">
            <h5 class="mb-3">Barang Terjual</h5>
            <table class="table table-striped table-bordered ">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nama Kategori</th>
                    <th class="text-center">Nama Barang</th>
                    <th class="text-center">Terjual</th>
                </tr>
                </thead>

                @forelse($data as $key => $d)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$d->nama_kategori}}</td>
                        <td>{{$d->nama}}</td>
                        <td>{{$d->jum}}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidan ada data terjual</td>
                    </tr>
                @endforelse

            </table>

        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        $('.input-daterange input').each(function () {
            $(this).datepicker({
                format: "dd-mm-yyyy"
            });
        });
    </script>

@endsection
