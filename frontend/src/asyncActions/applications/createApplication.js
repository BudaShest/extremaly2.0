import axios from 'axios';
import {getUserToken, getApiUrl} from "../helpers";

/**
 * Создание заявки
 * @param application
 * @returns {*|Promise<any>}
 */
export const createApplication = (application) => {
    let token = getUserToken();
    let url = getApiUrl();
    const config = {
        headers: {"Authorization": `Bearer ${token}`}
    };
    return axios.post(`${url}/application/create-application`, application)
        .then(response => response.data)
        .then(data => {
            return data;
        })
        .catch(error => console.log(error))

}