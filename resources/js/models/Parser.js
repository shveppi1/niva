import Form from './Form';

export default class Parser extends Form {

    start () {

        let start = 2006;
        let last = 5552;
        let delay = 1000;
        let thisClass = this;


        let timerId = setTimeout(function request() {

            thisClass.submit('get', '/parse/'+start).then(response => {
                    if (response.status == 'ok')
                    {
                        console.log(response.message);

                    } else if(response.status == 'not')
                    {
                        console.log(response);
                    }

                start++;

                let progress =  (start / last) * 100;
                $('#myBar').css({'width': progress+'%'});

                timerId = setTimeout(request, delay);
            });



            if(start == last) {
                clearTimeout(timerId);
            }

        }, delay);


        $('#stop_parse').on('click', function () {
            clearTimeout(timerId);
        })


    }

}

if (document.querySelector('#myProgress')) {
    const parsController = new Parser();
    parsController.start();
}
