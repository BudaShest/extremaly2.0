import axios from 'axios';
import {getApiUrl} from "../helpers";

/**
 * Авторизация пользователя
 * @param user
 * @returns {*|Promise<any>}
 */
export const loginUser = (user) => {
    let url = getApiUrl();
    return axios.post(`${url}/user/login`, user)
        .then(response => response.data)
        .then(data => {
            return data;
        })
        .catch(error => console.error(error));
}