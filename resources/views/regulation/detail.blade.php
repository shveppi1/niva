@extends('layout.pages')


@section('page_content')

            <div class="about-thumb">
                <h1>{{$regulation->name}}</h1>

                <div class="decription">
                    {!! $regulation->description !!}
                </div>
                <br/><br/>

                <div class="back_block">
                    @if($regulation->private == 1)
                        <a href="{{route('helps-club')}}" class="btn btn_black">Назад к списку</a>
                    @else
                        <a href="{{route('helps')}}" class="btn btn_black">Назад к списку</a>
                    @endif
                </div>
            </div>

@endsection
