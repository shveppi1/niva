<!-- Select template field. Used in Backpack/PageManager to redirect to a form with different fields if the template changes. A fork of the select_from_array field with an extra ID and an extra javascript file. -->
@php

    use Illuminate\Database\Eloquent\Builder;
    use App\Models\Season;

    if(isset($crud->entry->id)) {
        $seasons = Season::where('movie_id', $crud->entry->id)->orderBy('id')->get();
    } else {
        $seasons = [];
    }

@endphp

<div class="col-lg-12 col-md-12">
    <div>
        <label>{{ $field['label'] }}</label>
    </div>



    @forelse($seasons as $season)

        <div class="seasonsTab">
            <div class="seasonsTab__block tab_picker">

                <div class="seasonsTab__number">
                    {{ $season->number }}
                </div>

                <div class="seasonsTab__picture">


                    @if($season->picture)
                        <img class="" src="{{ asset('/storage/poster/serial/seasons') . '/' .  $season->picture }}" alt="{{ $season->name }}" />
                    @else
                        <img class="" src="{{ asset('/storage/poster/') . '/no-image1.jpg'  }}" alt="{{ $season->name }}" />
                    @endif

                </div>

                <div class="seasonsTab__name">
                    <div class="seasonsTab__name-strong">
                        {{ $season->name }}
                        {{ $season->og_name }}
                    </div>
                    <div class="seasonsTab__action">
                        <a class="btn btn-sm btn-info" href="/admin/season/{{$season->id}}/edit">Изменить</a>
                        {{--<a class="btn btn-sm btn-danger" href="/admin/season/{{$season->id}}/edit">Удалить</a>--}}
                    </div>
                </div>

                <div class="seasonsTab__desc">
                    {{($season['description']) ? $season['description'] : $season['description_en']}}

                </div>


            </div>

            <div class="season__series active {{$loop->first ? 'active' : ''}}">
                <table class="table box table-striped reservation_table table-hover display responsive nowrap m-t-0 dataTable">
                <thead>
                <tr scope="row">
                    <th>№</th>
                    <th>IMG</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Даты</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @foreach($season->series->sortDesc() as $seria)
                    <tr scope="row">
                        <td scope="col"> {{$seria['number']}} </td>
                        <td scope="col">

                            @if($seria->picture)
                                <img class="" src="{{ asset('/storage/still/serial/series') . '/' .  $seria->picture }}" height="100" alt="{{ $seria->name }}" />
                            @else
                                <img class="" src="{{ asset('/storage/poster/') . '/no-image1.jpg'  }}" height="100" alt="{{ $season->name }}" />
                            @endif

                        </td>
                        <td scope="col">{{$seria['name']}} <br /> {{$seria['or_name']}}</td>
                        <td scope="col">{{($seria['description']) ? $seria['description'] : $seria['description_en']}}</td>
                        <td scope="col">{{\Carbon\Carbon::parse($seria['realease_date'])->format('d.m.Y')}}</td>
                        <td scope="col"><button type="button" class="btn btn-sm btn-danger del-reserv" onclick="del_reserv_tr(this); return false;"  data-id="{{$seria['id']}}">Удалить</button></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            </div>

        </div>

    @empty
    @endforelse
</div>

<div class="col-lg-12 col-md-12">
    <button type="button" class="btn btn-primary open_modal_add" data-toggle="modal" data-target="create_reserv_form">
        Добавить запись
    </button>
</div>

@push('crud_fields_scripts')
    <script>

        function del_reserv_tr (elem) {
            let id = $(elem).attr('data-id');
            const element = $(elem);
            $.ajax({
                delay: 500,
                url: '',
                dataType: 'json',
                method: 'POST',
                data: {id:id},
            }).done(function(response) {
                if (response.status == 'ok') {
                    element.parent('td').parent('tr').remove()
                }
            });
        }

        $(document).ready(function() {
            $('.reservDateAddBtn').on('click', function (e) {
                e.preventDefault();
                let modal_form = $('#create_reserv_form');
                let form = {};
                $.each($('.reservDateAdd').serializeArray(), function() {
                    form[this.name] = this.value;
                });
                $.ajax({
                    delay: 500,
                    url: '',
                    dataType: 'json',
                    method: 'POST',
                    data: form,
                }).done(function(response) {
                    if (response.status == 'ok') {
                        console.log(response);
                        let newtr = '<tr scope="row">';
                        newtr += '<td>' + form.start_off_bron + '</td>';
                        newtr += '<td>' + form.finish_off_bron + '</td>';
                        newtr += '<td>' + form.store_id + '</td>';
                        newtr += '<td>' + form.user_name + '</td>';
                        newtr += '<td>' + form.id_task + '</td>';
                        newtr += '<td scope="col"><button type="button" class="btn btn-sm btn-danger del-reserv" onclick="del_reserv_tr(this); return false;" data-id="' + response.model + '">Удалить</button></td>';
                        $('.reservation_table').prepend(newtr)
                        modal_form.modal('hide');
                    }
                });
            });

            $('body .open_modal_add').on('click', function() {
                $('#create_reserv_form').modal('show');
            })
        });
    </script>
@endpush
