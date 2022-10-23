<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">

        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>
            <a href="https://nivachurch.ru/" class="navbar-brand smoothScroll">БожьяНива.рф</a>
        </div>
        <div class="collapse navbar-collapse">

            <ul class="nav navbar-nav navbar-right">
                <li> @if( isset($_REQUEST['res']) ) <a href="https://nivachurch.ru/#top" > @else <a href="#top" class="smoothScroll" >@endif <span>Главная</span></a></li>
                <li>@if( isset($_REQUEST['res']) ) <a href="https://nivachurch.ru/#aboutscroll" > @else <a href="#aboutscroll" class="smoothScroll" >@endif <span>О нас</span></a></li>
                <li>@if( isset($_REQUEST['res']) ) <a href="https://nivachurch.ru/#galleryscroll" > @else <a href="#galleryscroll" class="smoothScroll" >@endif <span>Галерея</span></a></li>
                <li>@if( isset($_REQUEST['res']) ) <a href="https://nivachurch.ru/#contactscroll" > @else <a href="#contactscroll" class="smoothScroll" >@endif <span>Контакты</span></a></li>
                <li role="separator" class="divider"></li>
                <li class="donate">@if( isset($_REQUEST['res']) ) <a href="https://nivachurch.ru/#donscroll" > @else <a href="#donscroll" class="smoothScroll" >@endif <span>Пожертвовать</span></a></li>
            </ul>

            <div class="nav navbar-nav donate navbar-right">

            </div>

        </div>

    </div>
</div>
