@extends('layout.pages')


@section('page_content')

    @if(url()->current() != route('helps-club'))
    <div class="d-flex align-content-end">
        <a  href="{{route('helps-club')}}" class="btn btn_black">Перейти к информации для членов клуба</a>
    </div>

    <br><br>
    @else
        <div class="d-flex align-content-end">
            <a  href="{{route('helps')}}" class="btn btn_black">Перейти к информации для всех</a>
        </div>

        <br><br>
    @endif

    @foreach($regulations as $regular)

        <a class="regular" href="{{ route('help-detail', $regular->id) }}">
            <h3>{{$regular->name}}</h3>
            <p class="regular__short">
                {{$regular->short}}
            </p>

            <span class="link_detail">Прочитать полностью</span>
        </a>

    @endforeach


@endsection
