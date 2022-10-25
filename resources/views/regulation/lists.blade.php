@extends('layout.pages')


@section('page_content')


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
