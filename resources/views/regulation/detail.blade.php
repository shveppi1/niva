@extends('layout.pages')


@section('page_content')

            <div class="about-thumb regular_detail">
                <h1>{{$regulation->name}}</h1>

                <div class="decription detail">
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


@section('bottom_content')

    <div class="back_fixed" style="display: none">
        @if($regulation->private == 1)
            <a href="{{route('helps-club')}}" class="">Назад к списку</a>
        @else
            <a href="{{route('helps')}}" class="">Назад к списку</a>
        @endif
    </div>

@endsection
