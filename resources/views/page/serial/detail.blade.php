@extends('layout.main')


@section('content')

    <section class="page_section serialDetail">

        <div class="title_block">
            <div class="container">
                <div class="row">

                    <div class="title_val">
                        <h2 class="name_ru">{{ $serial->name  }}</h2>
                        <h2 class="name_org">{{ $serial->name_original  }}</h2>
                    </div>

                    <ul class="navigation">
                        <li class="tab">Описание</li>
                        <li class="tab">Сезоны</li>
                        <li class="tab">Медиа</li>
                        <li class="tab">Состав</li>
                    </ul>

                </div>
            </div>
        </div>




        <div class="serialDetail__top" @if($serial->screen_url)style="background-image: url('{{ asset('/storage/backdrop/serial') . '/' .  $serial->screen_url }}');"@endif>

            <div class="container">

                <div class="row">


                    <div class="posterBlock">
                        <div class="poster">
                        @if($serial->picture)
                            <img class="" src="{{ asset('/storage/poster/serial') . '/' .  $serial->picture }}" alt="{{ $serial->name }}" />
                        @else
                            <img class="" src="{{ asset('/storage/poster/') . '/no-image1.jpg'  }}" alt="{{ $serial->name }}" />
                        @endif
                        </div>
                    </div>



                    <div class="inform">

                        <div class="inform__text">Год: {{ $serial->year }}</div>
                        <div class="inform__text">Статус: {{ $serial->status_movie }}</div>
                        <div class="inform__text">Длительность: {{ $serial->duration }}</div>
                        <div class="inform__text">Слоган: {{ $serial->tagline }}</div>
                        {{--
                        <div class="inform__text">Оригинальный язык: {{ $serial->language }}</div>
                        <div class="inform__text">Выход в России: {{ $serial->date_pub_rus }}</div>
                        <div class="inform__text">Выход в Мире: {{ $serial->date_pub_world }}</div>
                        --}}


                    </div>


                </div>

            </div>


        </div>



        <div class="serialContainer">



            <div class="container">










                @foreach($serial->seasons as $season)

                <div class="serdate__wrap">

                    @foreach($season->series->sortByDesc('number') as $seria)

                    <a href="http://localhost/serial/yunye-titany-vpered-041221042611" class="serdate__item" data-seriaid="90391">


                        <div class="serdate__poster">
                            @if($serial->picture)
                                <img src="{{ asset('/storage/poster/serial') . '/' .  $serial->picture }}" alt="{{ $serial->name }}">
                            @else
                                <img src="{{ asset('/storage/poster/') . '/no-image1.jpg'  }}" alt="{{ $serial->name }}">
                            @endif
                        </div>

                        <div class="serdate__ri">
                            <div class="serdate__name">{{$seria->name}}</div>
                            <div class="serdate__season">
                                <div class="serdate__number">s{{ $season->number }}@e{{$seria->number}}</div>
                                <div class="dotted"></div>
                                <div class="serdate__date">{{$seria->realease_date->format('d.m.Y')}}</div>
                            </div>
                        </div>

                    </a>

                    @endforeach


                </div>

                @endforeach




{{--

                <div class="flex">


                    <div class="leftCont">


                        <div class="seasonsSeries">

                            @foreach($serial->seasons as $season)
                            <div class="season_tab @if ($loop->first) active @endif" data-season="{{$season->number}}">


                                @if($season->series)
                                    <table>
                                        @foreach($season->series->sortByDesc('number') as $seria)
                                            <tr>
                                                <td>{{$seria->name}}</td>
                                                <td>{{$seria->or_name}}</td>
                                                <td>№ {{$seria->number}}</td>
                                                <td>{{$seria->realease_date}}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                @endif


                            </div>
                            @endforeach

                        </div>


                    </div>


                    <div class="rightCont">

                        <div class="seasons">
                            <ul>
                                @foreach($serial->seasons as $season)
                                    <li class="tab_nav" data-season="{{ $season->number }}"> {{ $season->name }} </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>


                </div>

                --}}



            </div>






        </div>





                            {{--
                            <div class="poster">
                                @if($serial->picture)
                                    <img src="{{ asset('/storage/poster/serial') . '/' .  $serial->picture }}" alt="{{ $serial->name }}" />
                                @else
                                    <img src="{{ asset('/storage/poster/') . '/no-image1.jpg'  }}" alt="{{ $serial->name }}" />
                                @endif
                            </div>
                            --}}









    </section>

@endsection


@section('script')

    <script>

        $('.tab_nav').on('click', function() {
            let season = $(this).attr('data-season');


            $('.season_tab').each(function (element) {
                if($(this).attr('data-season') == season){
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }
            })

        })

    </script>

@endsection
