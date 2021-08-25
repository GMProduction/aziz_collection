@extends('base')

@section('moreCss')
@endsection

@section('content')

    <section>
        <div style="height: 57px"></div>


        <div class="slider">
            <img src="{{$kategori ? $kategori->url_foto : 'https://lostvape.com/wp-content/uploads/2020/09/Z100A_01.jpg'}}" alt="img04"/>
        </div>
        <div style="height: 50px"></div>
    </section>
    <section class="container">

        <div>
            <h4 class="mb-5 text-center fw-bold">Produk {{request('kategori')}} Yang Kami Punya</h4>
            <div class="row">
                @forelse($data as $d)
                    <div class="col-lg-3">
                        <a class="cardku" href="/produk/detail/{{$d->id}}">
                            <img
                                src="{{count($d->getImage) > 0 ? $d->getImage[0]->url_foto : asset('/static-image/noimage.jpg')}}"/>
                            <div class="content">
                                <p class="title mb-0">{{$d->nama_produk}}</p>
                                <p class="description mb-0">{{$d->getKategori->nama_kategori}}</p>
                                <p class="description mb-0">Rp. {{number_format($d->harga,0)}}</p>
                            </div>
                        </a>
                    </div>
                @empty
                    <h4 class="text-center">Tidak ada Produk</h4>
                @endforelse
            </div>
            <div class="d-flex justify-content-end">
                {{$data->links()}}
            </div>
        </div>


    </section>


@endsection

@section('script')

    <script>

    </script>

@endsection
