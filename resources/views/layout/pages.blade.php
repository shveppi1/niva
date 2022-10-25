@extends('layout.lay')


@section('content')

    <section id="page">
        <div class="container">
            <div class="row">
                <div class="page_wrap col-md-12 col-sm-12" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                    @yield('page_content')
                </div>
            </div>
        </div>
    </section>



@endsection
