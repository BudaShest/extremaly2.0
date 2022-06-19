import axios from 'axios';
import {getApiUrl} from "../helpers";

/**
 * Обновить аватар пользователя
 * @param formData
 * @returns {*|Promise<any>}
 */
export const updateAvatar = (formData) => {
    let url = getApiUrl();
    return axios.post(`${url}/user/update-avatar`, formData)
        .then(response => response.data)
        .then(data => {
            return data;
        })
        .catch(error => console.error(error));
}