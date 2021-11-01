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



                    <div class="serdate__item">


                        <div class="serdate__poster">
                            <img src="/img/sherlock.jpg" alt="">
                        </div>

                        <div class="serdate__ri">
                            <div class="serdate__name">Шерлок</div>
                            <div class="serdate__season">
                                <div class="serdate__number">s1@e04</div>
                                <div class="dotted"></div>
                                <div class="serdate__date">02.09.2021</div>
                            </div>
                        </div>

                    </div>


                    <div class="serdate__item">


                        <div class="serdate__poster">
                            <img src="/img/sherlock.jpg" alt="">
                        </div>

                        <div class="serdate__ri">
                            <div class="serdate__name">Шерлок</div>
                            <div class="serdate__season">
                                <div class="serdate__number">s1@e04</div>
                                <div class="dotted"></div>
                                <div class="serdate__date">02.09.2021</div>
                            </div>
                        </div>

                    </div>

                    <div class="serdate__item">


                        <div class="serdate__poster">
                            <img src="/img/sherlock.jpg" alt="">
                        </div>

                        <div class="serdate__ri">
                            <div class="serdate__name">Шерлок</div>
                            <div class="serdate__season">
                                <div class="serdate__number">s1@e04</div>
                                <div class="dotted"></div>
                                <div class="serdate__date">02.09.2021</div>
                            </div>
                        </div>

                    </div>


                    <div class="serdate__item">


                        <div class="serdate__poster">
                            <img src="/img/sherlock.jpg" alt="">
                        </div>

                        <div class="serdate__ri">
                            <div class="serdate__name">Шерлок</div>
                            <div class="serdate__season">
                                <div class="serdate__number">s1@e04</div>
                                <div class="dotted"></div>
                                <div class="serdate__date">02.09.2021</div>
                            </div>
                        </div>

                    </div>


                    <div class="serdate__item">


                        <div class="serdate__poster">
                            <img src="/img/sherlock.jpg" alt="">
                        </div>

                        <div class="serdate__ri">
                            <div class="serdate__name">Шерлок</div>
                            <div class="serdate__season">
                                <div class="serdate__number">s1@e04</div>
                                <div class="dotted"></div>
                                <div class="serdate__date">02.09.2021</div>
                            </div>
                        </div>

                    </div>



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


@endsection
