@extends('layout.lay')


@section('content')


    <section id="home">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">

                <div class="col-md-offset-1 col-md-10 col-sm-12 wow fadeInUp" style="padding-top: 10px;" data-wow-delay="0.3s">
                    <h1 class="wow fadeInUp" data-wow-delay="0.6s">Божья <strong style="color: #FFC074">НИВА</strong></h1>
                    <p class="wow fadeInUp" data-wow-delay="0.9s"><i>Церковь христиан веры евангельской (пятидесятников) "Божья нива"<br/>город Липецк, Липецкая область.</i></p>
                </div>

            </div>
        </div>
    </section>


    <section id="about">
        <div class="container">
            <div class="row">

                <div class="col-md-9 col-sm-8 wow fadeInUp" id="aboutscroll" data-wow-delay="0.2s">
                    <div class="about-thumb">
                        <h1 style="letter-spacing: 6px;" >Добро пожаловать</h1>
                        <p style="color: #c1510a;">Божья Нива &ndash; это церковь евангельских христиан (пятидесятников). <br />Мы являемся частью одной из трех ветвей традиционного христианства &ndash; Протестантизма и входим в объединенный союз <a href="https://www.cef.ru/" target="_blank">РОСХВЕ</a>. <br />Приглашаем Вас посетить наши Богослужения, которые проходят каждое Воскресенье в 11:00 (как нас найти смотрите ниже)! Также, вы можете познакомиться с нашей церковью ближе в наших социальных сетях (<a target="_blank" href="https://vk.com/nivachurch">ВКонтакте</a>) и на <a href="https://www.youtube.com/channel/UCx1JJxB0o__PD85tmXg-7Vw" target="_blank" >Youtube-канале</a>.</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-4 wow fadeInUp about-img" data-wow-delay="0.6s">
                    <img src="/images/117GGHWCufnUg.jpg" width="150" class="img-responsive img-circle" alt="About">
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </section>


    <section id="gallery">
        <div class="container">
            <div class="row">

                <div class="col-md-offset-2 col-md-8 col-sm-12 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="section-title">
                        <h1 id="galleryscroll">Галерея</h1>
                    </div>
                </div>


                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="item-gallery">
                        <div class="img-gallery">
                            <a href="#"
                               class="bg-gallery gallery_click"
                               data-getfile="gallery2"
                               style="background-image: url('/images/img/gallery2/3-mini.jpg');">

                            </a>
                        </div>
                        <a href="#"
                           data-getfile="gallery2"
                           class="nm-gallery gallery_click">Сокол</a>

                    </div>
                </div>


                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="item-gallery">
                        <div class="img-gallery">
                            <a href="#"
                               class="bg-gallery gallery_click"
                               data-getfile="gallery1"
                               style="background-image: url('/images/img/gallery1/4-mini.jpg');">
                            </a>
                        </div>
                        <a href="#" data-getfile="gallery1"
                           class="nm-gallery gallery_click">Сырский</a>

                    </div>
                </div>


                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.8s">
                    <div class="item-gallery">
                        <div class="img-gallery">
                            <a href="#"
                               class="bg-gallery gallery_click"
                               data-getfile="gallery3"
                               style="background-image: url('/images/img/gallery3/1-mini.jpg');">

                            </a>
                        </div>

                        <a href="#" data-getfile="gallery3"
                           class="nm-gallery gallery_click">Грязи</a>
                    </div>
                </div>

            </div>
        </div>
    </section>




    <section id="contact">
        <div class="container">
            <div class="row justify-content-center">


                <div class="contact_top">

                    <div class="col-md-offset-1 col-md-10 col-sm-12">

                        <div class="col-lg-offset-1 col-lg-10 section-title wow fadeInUp" data-wow-delay="0.4s">
                            <h1 id="contactscroll">Контакты</h1>
                            <p style="text-align: left;">Полное наименование: <br />Местная религиозная организация церковь христиан веры евангельской (пятидесятников) "Божья Нива" г. Липецка<br />Юридический/фактический адрес: <br />398902, Липецкая обл, Липецк г, Ударников ул, сооружение № 24А<br />Эл. почта: <a href="mailto:nivachurch48@gmail.com">nivachurch48@gmail.com</a><br />Телефон: +7 (920) 5056630/+7 (910) 2590816<br />ИНН/КПП: 4825044359/482601001<br />ОГРН: 1064800003180</p>
                        </div>
                    </div>

                </div>

                <div class="contact_bottom">

                    <div class="col-md-offset-1 col-md-10 col-sm-12">

                        <div class="col-lg-offset-1 col-lg-10 section-title wow fadeInUp" data-wow-delay="0.4s">
                            <h1>Наглядно где мы</h1>
                            <p>Собрания проходят в трех разных местах, рекомендуем <br/>предварительно ознакомиться с нашим местоположением</p>
                        </div>
                    </div>

                    <div style="clear: both;"></div>


                    <ul role="tablist" class="tab-contact">
                        <li role="presentation">
                            <a href="#sokol" data-map="sokol" class="click_map">Сокол</a>
                        </li>
                        <li role="presentation">
                            <a href="#sirskiy" data-map="sirskiy" class="click_map active">Сырский</a>
                        </li>
                        <li role="presentation">
                            <a href="#gryazi" data-map="gryazi" class="click_map">Грязи</a>
                        </li>
                    </ul>

                    <div class="tab-content">





                        <div role="tabpanel" class="tab-pane active" id="sirskiy">


                            <p>Адрес: г. Липецк, пр. Ударников 24А (Сырский рудник, остановка "школа 23")</p>

                            <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A7455a0aababc5d6a0f31b6eb7c47d54e2b8540a8533549af62c3438c8f78c16b&amp;source=constructor" width="100%" height="350" frameborder="0"></iframe>

                            <div style="clear: both;"></div>


                        </div>





                    </div>

                </div>



            </div>
        </div>




    </section>






@endsection
