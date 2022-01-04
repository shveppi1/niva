@extends('layout.main')


@section('content')

    <section class="calendar_section">

    <div class="container">


        <h2 class="section_title">Парсер</h2>

        <div class="row">

            <div id="myProgress">
                <div id="myBar"></div>
            </div>

        </div>

        <div class="row">

            <button id="stop_parse" style="
    margin: 30px auto;
    background: white;
    border: 1px solid lightgrey;
    padding: 6px 26px;">Stop</button>

        </div>

    </div>

    </section>

@endsection
