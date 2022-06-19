import axios from 'axios';
import {getApiUrl} from "../helpers";

/**
 * Обновить пользовательскую информацию
 * @param user
 * @returns {*|Promise<any>}
 */
export const updateUser = (user) => {
    let url = getApiUrl();
    return axios.post(`${url}/user/update-user?id=${user.id}`, user)
        .then(response => response.data)
        .then(data => {
            return data;
        })
        .catch(error => console.error(error));
}