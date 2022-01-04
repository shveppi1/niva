@extends('layout.main')

@section('content')
<section class="calendar_section">

    <div class="container">


        <h2 class="section_title">Отслеживайте выход любимого сериала просто и удобно</h2>

        <div class="row">





            <div class="serdate">

                <div class="row">
                    <div class="search_line">
                        <div class="row">
                            <input class="search_line__input" type="text" placeholder="Начните вводить название сериала" />
                            <div class="search_line__prev"></div>
                            <div class="search_line__next"></div>
                        </div>
                    </div>
                </div>

                <div class="serdate__wrap">

                    @foreach($serials as $serial)


                        <a href="{{  route('serial-detail', ['slug' => $serial->season->movie->slug])  }}" class="serdate__item" data-seriaId="{{$serial->id}}">


                            <div class="serdate__poster">
                                @if($serial->season->movie->picture)
                                    <img src="{{ asset('/storage/poster/serial') . '/' .  $serial->season->movie->picture }}" alt="{{ $serial->season->movie->name }}">
                                @else
                                    <img src="{{ asset('/storage/poster/') . '/no-image1.jpg'  }}" alt="">
                                @endif
                            </div>

                            <div class="serdate__ri">
                                <div class="serdate__name">{{ $serial->season->movie->name }}</div>
                                <div class="serdate__season">
                                    <div class="serdate__number">s{{ $serial->season->number }}@e{{ $serial->number }}</div>
                                    <div class="dotted"></div>
                                    <div class="serdate__date">{{ $serial->realease_date->format('d.m.Y')  }}</div>
                                </div>
                            </div>

                        </a>


                    @endforeach




                </div>

            </div>




            <div class="filter">

                <div class="filter__block">
                    <div class="filter__head">
                        <div class="filter__title"></div>
                        <div class="filter__arrow"></div>
                    </div>
                    <div class="filter__content">
                        <div class="appcalendar" id="calendar"></div>
                        <input type="hidden" id="calendar_value" value="14.09.2021">

                    </div>
                </div>

            </div>

        </div>



    </div>




</section>

{{--

<section class="news">

    <div class="line_b"></div>
    <div class="container">
        <h2 class="title">Дайджест</h2>
    </div>


    <div class="wrap">
        <div class="container">
            <div class="row">
                <div class="news__item">

                    <p>text asdsadasdsa asdsadasdasdsa asdsadas</p>

                </div>

                <div class="news__item">

                    <p>text asdsadasdsa asdsadasdasdsa asdsadas</p>

                </div>

                <div class="news__item">

                    <p>text asdsadasdsa asdsadasdasdsa asdsadas</p>

                </div>
            </div>
        </div>
    </div>

</section>

--}}

@endsection
