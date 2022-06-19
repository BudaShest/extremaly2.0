import axios from 'axios';
import {getApiUrl, logout} from "../helpers";

/**
 * Выход из учётной записи
 * @returns {*|Promise<any>}
 */
export const logoutUser = () => {
    let url = getApiUrl();
    return axios.post(`${url}/user/logout`)
        .then(response => response.data)
        .then(data => {
            logout();
            return data;
        })
        .catch(error => console.error(error));
}