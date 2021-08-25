@extends('admin.base')
@section('title')
    Data Baner
@endsection
@section('content')

    <section class="m-2">


        <div class="table-container">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Data Baner</h5>
                <button type="button ms-auto" class="btn btn-primary btn-sm" id="addData">Tambah Data
                </button>
            </div>

            <table class="table table-striped table-bordered ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Link</th>
                    <th>Aksi</th>
                </tr>
                </thead>

                @forelse($data as $key => $d)
                    <tr>
                        <td width="20">{{$key+1}}</td>
                        <td width="100"><img src="{{$d->url_gambar}}" height="75"></td>
                        <td>{{$d->url_web}}</td>
                        <td width="150">
                            <a class="btn btn-sm btn-primary" id="editData" data-id="{{$d->id}}" data-link="{{$d->url_web}}" data-image="{{$d->url_gambar}}">Edit</a>
                            <a class="btn btn-sm btn-danger" id="deleteData" data-id="{{$d->id}}">Delete</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="8">Tidak ada Baner</td>
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
                                <label for="jenisKertas" class="form-label">Link Url</label>
                                <textarea class="form-control" id="url_web" name="url_web"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="url_foto" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="url_foto" accept="image/*" name="url_gambar">
                            </div>
                            <img id="imgKate" src="" style="width: 100%">

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
        $('#tambahkategori #url_web').val('')
        $('#tambahkategori #url_gambar').val('')
        $('#tambahkategori #imgKate').attr('src','')

        $('#tambahkategori').modal('show')
    })

    $(document).on('click','#editData', function () {
        $('#tambahkategori #id').val($(this).data('id'))
        $('#tambahkategori #url_web').val($(this).data('link'))
        $('#tambahkategori #url_gambar').val('')
        $('#tambahkategori #imgKate').attr('src',$(this).data('image'))
        $('#tambahkategori').modal('show')
    })

    $(document).on('click', '#deleteData', function () {
        var id = $(this).data('id');
        deleteData('', '/admin/baner/'+id+'/delete');
        return false;
    })

    function saveKategori() {
        saveData('Tambah Baner', 'formKategori');
        return false;
    }
</script>

@endsection
