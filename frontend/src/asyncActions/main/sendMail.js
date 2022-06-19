import axios from 'axios';
import {getApiUrl} from "../helpers";

/**
 * Отправка письма
 * @param mail
 * @returns {*|Promise<any>}
 */
export const sendMail = (mail) => {
    let url = getApiUrl();
    return axios.post(`${url}/mail/send-mail`, mail)
        .then(response => response.data)
        .then(data => {
            return data
        })
        .catch(console.error)
}