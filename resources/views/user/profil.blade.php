@extends('user.dashboard')

@section('contentUser')



    <section class="container">

        <div class="">
            <div class="d-flex justify-content-center">
                <div class="item-box" style="width: 400px">
                    <form id="form">
                        @csrf
                        <input name="id" value="{{$data->id}}" hidden>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" readonly id="nama" name="nama" value="{{$data->nama}}">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Username</label>
                            <input type="text" class="form-control" readonly id="username" name="username" value="{{$data->username}}">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" readonly id="password" name="password" value="*****">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Password Konfirmasi</label>
                            <input type="password" class="form-control" readonly id="password_confirmation" name="password_confirmation" value="*****">
                        </div>
                        <div class="mb-3">
                            <label for="nohp" class="form-label">No Hp</label>
                            <input type="text" class="form-control" readonly id="nohp" name="no_hp" value="{{$data->no_hp}}">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" readonly rows="3">{{$data->alamat}}</textarea>
                        </div>
                        <div class="mb-3 d-flex justify-content-center">
                            <a class="btn btn-primary" id="editData">Edit</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </section>


@endsection

@section('scriptUser')

    <script>
        $(document).ready(function () {

            $("#profil").addClass("active");
        });

        $(document).on('click', '#editData', function () {
            var txtHtml = $(this).html();
            if (txtHtml === 'Edit'){
                $('#form input').removeAttr('readonly');
                $('#form textarea').removeAttr('readonly');
                $(this).addClass('btn-success').removeClass('btn-primary')
                $(this).html('Save')
            }else{
                saveData('Update Profile','form');
                return false
                // $('#form input').attr('readonly','');
                // $('#form textarea').attr('readonly','');
                // $(this).addClass('btn-primary').removeClass('btn-success')
                // $(this).html('Edit')
            }
        })
    </script>

@endsection
