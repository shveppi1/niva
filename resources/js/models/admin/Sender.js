import axios from './axios';

export default class Sender {

    async submit(method, url, parameters = [])
    {
        let data = [];

        if (method == 'get')
        {
            data = {
                params : (parameters.data || parameters || [])
            }
        } else
        {
            data = (parameters || []);
        }

        return axios[method](url, data)
            .then(this.onSuccess.bind(this))
            .catch(this.onFail.bind(this));
    }

    onSuccess(response)
    {
        return response.data;
    }

    onFail(errors)
    {
        return errors.response.data;
    }
}
