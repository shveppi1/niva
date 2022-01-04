@extends('layout.main')

@section('content')

    <section class="page_section">

        <div class="container">


            <h2 class="section_title">Сериалы</h2>

            <div class="row">

                <div class="serials">
                    @foreach($serials as $serial)
                    <div class="serials__item">
                        <a href="{{  route('serial-detail', ['slug' => $serial->slug])  }}">
                        @if($serial->picture)
                            <img src="{{ asset('/storage/poster/serial') . '/' .  $serial->picture }}" alt="{{ $serial->name }}">
                        @else
                            <img src="{{ asset('/storage/poster/') . '/no-image1.jpg'  }}" alt="">
                        @endif
                        </a>

                        <div class="serials__name">{{ $serial->name ? $serial->name : $serial->name_original }}</div>

                    </div>
                    @endforeach
                </div>

            </div>


            <div class="d-felx justify-content-center">

                {{ $serials->links('pagination.default') }}

            </div>

        </div>

    </section>

@endsection
