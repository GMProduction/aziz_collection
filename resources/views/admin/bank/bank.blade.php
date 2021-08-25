@extends('admin.base')
@section('title')
    Data Bank
@endsection
@section('content')

    <section class="m-2">


        <div class="table-container">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Data Bank</h5>
                <button type="button ms-auto" class="btn btn-primary btn-sm" id="addData">Tambah Data
                </button>
            </div>

            <table class="table table-striped table-bordered ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Nama Bank</th>
                    <th>Nama Pemilik</th>
                    <th>Nomor Rekening</th>
                    <th>Aksi</th>
                </tr>
                </thead>

                @forelse($data as $key => $d)
                    <tr>
                        <td width="20">{{$key+1}}</td>
                        <td width="100"><img src="{{$d->url_gambar}}" height="75"></td>
                        <td>{{$d->nama_bank}}</td>
                        <td>{{$d->holder_bank}}</td>
                        <td>{{$d->norek}}</td>
                        <td width="50">
                            <a class="btn btn-sm btn-primary" id="editData" data-id="{{$d->id}}" data-norek="{{$d->norek}}" data-holder="{{$d->holder_bank}}" data-nama="{{$d->nama_bank}}" data-image="{{$d->url_gambar}}">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="8">Tidak ada data bank</td>
                    </tr>
                @endforelse

            </table>
            <div class="d-flex justify-content-end">
                {{$data->links()}}
            </div>
        </div>

        <div class="modal fade" id="tambahkategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formKategori" onsubmit="return saveKategori()">
                            @csrf
                            <input id="id" name="id" type="number" hidden>
                            <div class="mb-3">
                                <label for="nama_bank" class="form-label">Nama Bank</label>
                                <input type="text" class="form-control" id="nama_bank" name="nama_bank">
                            </div>
                            <div class="mb-3">
                                <label for="holder_bank" class="form-label">Nama Pemilik</label>
                                <input type="text" class="form-control" id="holder_bank" name="holder_bank">
                            </div>
                            <div class="mb-3">
                                <label for="norek" class="form-label">Nomor Rekening</label>
                                <input type="text" class="form-control" id="norek" name="norek">
                            </div>
                            <div class="mb-3">
                                <label for="url_gambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="url_gambar" accept="image/*" name="url_gambar">
                            </div>
                            <img id="imgBank" src="" style="width: 100%">

                            <div class="mb-4"></div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>


@endsection

@section('script')
    <script>
        $(document).on('click','#addData', function () {
            $('#tambahkategori #id').val('')
            $('#tambahkategori #nama_bank').val('')
            $('#tambahkategori #norek').val('')
            $('#tambahkategori #holder_bank').val('')
            $('#tambahkategori #url_gambar').val('')
            $('#tambahkategori #imgBank').attr('src','')

            $('#tambahkategori').modal('show')
        })

        $(document).on('click','#editData', function () {
            $('#tambahkategori #id').val($(this).data('id'))
            $('#tambahkategori #nama_bank').val($(this).data('nama'))
            $('#tambahkategori #norek').val($(this).data('norek'))
            $('#tambahkategori #holder_bank').val($(this).data('holder'))
            $('#tambahkategori #url_gambar').val('')
            $('#tambahkategori #imgBank').attr('src',$(this).data('image'))
            $('#tambahkategori').modal('show')
        })

        function saveKategori() {
            saveData('Tambah Bank', 'formKategori');
            return false;
        }
    </script>

@endsection
