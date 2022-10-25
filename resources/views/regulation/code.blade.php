@extends('layout.pages')



@section('page_content')

        <div class="about-thumb" style="filter: blur(10px);">
            <h1>Подтвердите членство церкви, чтоб увидеть содержимое раздела.</h1>

            <div class="decription">
                <p>Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне.</p>
                <p>Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века.
                <p>В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов.</p>
                <p>Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.
                <p>Его популяризации в новое время послужили публикация листов Letraset
                    с образцами Lorem Ipsum в 60-х годах и, в более недавнее время,
                    программы электронной вёрстки типа Aldus PageMaker,
                    в шаблонах которых используется Lorem Ipsum.</p>

                <br/> <br/>
                <p>Почему он используется?</p>
                <p>Давно выяснено, что при оценке дизайна и композиции читаемый
                текст мешает сосредоточиться.</p>
                <p>Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона,
                    а также реальное распределение букв и пробелов в абзацах, которое не получается
                    при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." </p>
                <p>Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве
                    текста по умолчанию, так что поиск по ключевым словам "lorem ipsum" сразу показывает, как
                    много веб-страниц всё ещё дожидаются своего настоящего рождения. </p>
                <p>За прошедшие годы текст Lorem Ipsum получил много версий. </p>
                <p>Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).</p>

                <br/> <br/>
                <p>Откуда он появился?</p>
                <p>Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. </p>
                <p>Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. </p>
                <p>Ричард МакКлинток, профессор латыни из колледжа Hampden-Sydney, штат Вирджиния, взял одно из самых странных
                слов в Lorem Ipsum, "consectetur", и занялся его поисками в классической латинской литературе. </p>
                <p>В результате он нашёл неоспоримый первоисточник Lorem Ipsum в разделах 1.10.32 и 1.10.33 книги
                    "de Finibus Bonorum et Malorum" ("О пределах добра и зла"), написанной Цицероном в 45 году н.э. </p>
                <p>Этот трактат по теории этики был очень популярен в эпоху Возрождения. Первая строка Lorem Ipsum,
                "Lorem ipsum dolor sit amet..", происходит от одной из строк в разделе 1.10.32</p>

                <br/> <br/>
                <p>Классический текст Lorem Ipsum, используемый с XVI века, приведён ниже. </p>
                <p>Также даны разделы 1.10.32 и 1.10.33 "de Finibus Bonorum et Malorum" Цицерона
                и их английский перевод, сделанный H. Rackham, 1914 год.</p>

                <br/> <br/>
                <p>Где его взять?</p>
                <p>Есть много вариантов Lorem Ipsum, но большинство из них имеет не всегда приемлемые
                модификации, например, юмористические вставки или слова, которые даже отдалённо не напоминают латынь.</p>
                <p>Если вам нужен Lorem Ipsum для серьёзного проекта, вы наверняка не хотите какой-нибудь шутки, скрытой в середине абзаца.</p>
                <p>Также все другие известные генераторы Lorem Ipsum используют один и тот же текст,
                который они просто повторяют, пока не достигнут нужный объём.</p>
                <p>Это делает предлагаемый здесь генератор единственным настоящим Lorem Ipsum генератором.</p>
                <p>Он использует словарь из более чем 200 латинских слов, а также набор моделей предложений.</p>
                <p>В результате сгенерированный Lorem Ipsum выглядит правдоподобно, не имеет повторяющихся абзацей или "невозможных" слов.</p>
            </div>
        </div>


        {{--<a data-fancybox href="#hidden">Открыть Fancybox (Inline)</a>--}}





@endsection


@section('modals')


    <div class="pop_container">
        <div class="pop_bg"></div>
        <div class="pop_inner">
            <div class="pop_stage">
                <div class="pop_slide">
                    <div class="pop_content">
                        <h2>Авторизоваться на сайте</h2>
                        <form class="nivaForm" action="{{route('login')}}">
                            <input class="form-control" name="email" type="text" placeholder="Эмейл">
                            <input class="form-control" name="password" type="password" placeholder="Пароль">
                            <div class="d-flex">
                                <input type="submit" class="btn_niva btn_black" value="Отправить">
                                <a href="/" class="btn_niva btn_empty">Регистрация</a>
                            </div>
                        </form>

                        <form action="">
                            <br />
                            <p>Открыть по коду</p>
                            <input class="form-control" name="code" type="text" placeholder="xxxxxx">
                            <input type="submit" class="btn_niva btn_red" value="Отправить код">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection