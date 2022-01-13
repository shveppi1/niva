import Sender from './Sender';


export default class Crud extends Sender {





    setTmdbMov(id, id_this_movie) {

        let thisClass = this;

        let data = {};
        data.idTMDB = id;

        thisClass.submit('get', '/setTmdbSource/' + id_this_movie, data).then(response => {
            console.log(response);

            if(response.message) {
                $('#pars_search_res').after(`<div class="error_block" style="border: 2px solid red; font-size: 18px; padding: 4px;">Ошибка скачивания данных. Сообщите об ошибке! <br /><pre>${response.message}</pre></div>`);
            }

            if(response.status == 'ok') {

                //console.log(response);

            }
        })

    }


    getSerialsSearch() {

        let thisClass = this;
        let name = $("input[name='name']").val();



        thisClass.submit('get', '/searchSerialTmdb/' + name).then(response => {
            if(response.status == 'ok') {


                if((Object.keys(response.serials).length != 0)) {
                    response.serials.forEach((serial) => {
                        let html = ``;

                        html += `
                        <div class="serres__item search_tmdb_click" data-sertmdbid="${serial.id}">
                            <img src="${response.conf.images.secure_base_url + response.conf.images.poster_sizes[0] + serial.poster_path}" alt="">
                            <div class="serres__info">
                                <div class="serres__name">${serial.name}</div>
                                <div class="serres__orname">${serial.original_name}</div>
                                <div class="serres__year">${serial.first_air_date}</div>
                                <div class="serres__desc">${serial.overview}</div>
                            </div>
                        </div>
                    `;

                        $('#pars_search_res').append(html);

                    });
                }

                //$('.create_search_tmdb').append();
            } else {
                $('#pars_search_res').append(`<div style="font-size: 20px; color: red;">${response.message}</div>`);
            }
        })



    }


}


if (document.querySelector('.create_search_tmdb')) {
    const crudController = new Crud();

    if($("input[name='name']").val()) {
        $('.create_search_tmdb').on('click', function () {
            crudController.getSerialsSearch();
        });
    }

    $(document).on('click', '.search_tmdb_click', function () {
        console.log('click')
        let idmov = $('#pars_search_res').attr('data-idmovie');
        crudController.setTmdbMov($(this).attr('data-sertmdbid'), idmov);
    })

}

