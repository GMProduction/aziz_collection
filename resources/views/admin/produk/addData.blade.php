@extends('admin.base')

@section('title')
    Data Barang
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/dropzone/css/basic.min.css') }} " type="text/css">
    <link rel="stylesheet" href="{{ asset('css/dropzone/css/dropzone.min.css') }} " type="text/css">
    <link rel="stylesheet" href="{{ asset('summernote/summernote.css') }}" type="text/css">
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
                <h5>Form Produk</h5>
                <a type="button ms-auto" class="btn btn-primary btn-sm" id="addData" href="/admin/produk/data">Tambah Data Baru
                </a>
            </div>
            <form id="formProduk" onsubmit="return saveProduk()">
                <input id="id" name="id" hidden>
                @csrf
                <div class="mb-3">
                    <label for="namaProduk" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="namaProduk" name="nama_produk">
                </div>

                <div class="mb-3">
                    <label for="id_kategori" class="form-label">Kategori</label>
                    <div class="d-flex">
                        <select class="form-select" aria-label="Default select example" id="id_kategori" name="id_kategori">
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="text" class="form-control" id="stok" name="stok">
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga">
                </div>
                <div class="mb-3">
                    <label for="deskripsi1" class="form-label">Deskripsi</label>
                    <textarea id="deskripsi1" name="deskripsi" class="form-control"></textarea>
                </div>
                <div class="mb-4"></div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
            <div id="divImg" class="d-none mt-4">
                <h6 class="heading-small text-muted mb-2">Masukkan Foto</h6>
                <div class="pl-lg-4">
                    <form id="formImg" action="/admin/produk/image" method="post" class="dropzone mb-2" enctype="multipart/form-data" style="border-radius: 10px">
                        @csrf
                        <input id="id" name="id" hidden>

                        <div class="fallback">
                            <input name="image" type="file" multiple/>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('css/dropzone/js/dropzone.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('summernote/summernote.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/compressor.js') }} "></script>


    <script>
        var id, idproduk;
        $(document).ready(function () {
            $("#deskripsi1").summernote('code','{!! $data->deskripsi ?? '' !!}');
            getSelect('id_kategori', '/kategori', 'nama_kategori',{{$data->id_kategori ?? null}})
            $('#formProduk #id').val('{{$data->id ?? null}}');
            $('#namaProduk').val('{{$data->nama_produk ?? null}}');
            $('#stok').val('{{$data->stok ?? null}}');
            $('#harga').val('{{$data->harga ?? null}}');
            id = '{{request('id')}}'
            $('#formImg #id').val('{{$data->id ?? null}}');

            if ('{{$data}}') {
                $('#divImg').removeClass('d-none');

            }
        })

        function afterSave() {
        }

        function saveProduk() {
            console.log(window.location.pathname)
            swal({
                title: 'Simpan data',
                text: "Apa kamu yakin ?",
                icon: "info",
                buttons: true,
                primariMode: true,
            })
                .then((res) => {
                    if (res) {
                        $.post(window.location.pathname, $('#formProduk').serialize(), function (data, textStatus, xhr) {
                            console.log(data);
                            console.log(data['data']['id']);
                            if (xhr.status === 200) {
                                swal("Data Updated ", {
                                    icon: "success",
                                }).then((dat) => {
                                    window.location = window.location.pathname + '?id=' + data['data']['id'];
                                });
                            } else {
                                swal(data['msg'])
                            }
                        })
                    }
                });
            return false;
        }

        Dropzone.options.formImg = {
            // paramName: 'image',
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
            addRemoveLinks: true,
            // thumbnailWidth: 120,
            // thumbnailHeight: 120,
            transformFile: function (file, done) {
                // const imageCompressor = new ImageCompressor();
                new Compressor(file, {
                    quality: 0.6,
                    success(result) {
                        console.log(result);
                        done(result)
                    },
                    error(err) {
                        console.log(err.message);
                    },
                });

            },
            removedfile: function (file) {
                var idImg, name;
                console.log(file)
                if (file.xhr) {
                    idImg = JSON.parse(file.xhr.response)['id'];
                    name = JSON.parse(file.xhr.response)['image'];
                } else {
                    idImg = file['idImg'];
                    name = file['name'];
                }
                console.log(idImg);
                {{--var name = JSON.parse(file.xhr.response)['payload']['image'];--}}
                {{--var idImg = JSON.parse(file.xhr.response)['payload']['id'];--}}
                {{--console.log('delete')--}}
                swal({
                    title: 'Hapus foto',
                    text: "Apa kamu yakin ?",
                    icon: "info",
                    buttons: true,
                    dangerMode: true,
                }).then((res) => {
                    if (res) {
                        $.ajax({
                            type: 'POST',
                            url: '/admin/produk/image',
                            data: {name: name, id: idImg, action: 2, '_token': '{{csrf_token()}}',},
                            sucess: function (data, textStatus, xhr) {
                                swal("Data Foto Dihapus ", {
                                    icon: "success",
                                })

                            }
                        });
                        var _ref;
                        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                    }
                });
                return false
            },
            sending: function (file, xhr, formData) {
                file.myCustomName = "my-new-name" + file.name;
                // formData.append("filesize", file.size);
                formData.append("fileName", file.myCustomName);
                formData.append("id_facility", $('#visi #id').val());
            },
            success: function (file, response) {

                console.log(file);
                console.log(response);
                file.previewElement.querySelector("img").src = response['image'];
                file.previewElement.children[1].children[1].children[0].innerHTML = response['image'];
                file.previewElement.children[1].children[0].children[0].innerHTML = response['size'];
                $('.dz-image img').attr('height', '120')

            },
            accept: function (file, done) {
                this.options.resizeWidth = 650;
                this.options.resizeQuality = 0.75;
                console.log(this.options);
                done();
                return;
            },
            init: async function () {
                let myDropzone = this;
                var existing_files = $('[name="image[]"]').val();
                $.get('/admin/produk/image', {'id': '{{request('id')}}'}, function (data) {
                    if (data.length > 0) {
                        $.each(data, function (key, value) {
                            console.log(myDropzone)
                            var mockFile = {name: value['image'], size: value['size'], idImg: value['id']};
                            myDropzone.displayExistingFile(mockFile, value['image']);
                        })

                    }
                })
                $('.dz-image img').attr('height', '120');
            }
        }
    </script>

@endsection
