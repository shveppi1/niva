@extends('layout.pages')


@section('page_content')

            <div class="about-thumb">
                <h1>{{$regulation->name}}</h1>

                <div class="decription">
                    {!! $regulation->description !!}
                </div>
            </div>

@endsection
