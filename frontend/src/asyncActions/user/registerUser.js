import axios from 'axios';
import {getApiUrl} from "../helpers";

/**
 * Регистрация пользователя
 * @param user
 * @returns {*|Promise<any>}
 */
export const registerUser = (user) => {
    let url = getApiUrl();
    return axios.post(`${url}/user/register`, user)
        .then(response => response.data)
        .then(data => {
            return data;
        })
        .catch(error => console.error(error))
}