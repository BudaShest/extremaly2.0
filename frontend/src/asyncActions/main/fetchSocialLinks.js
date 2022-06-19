import axios from 'axios';
import {getSocialLinksAction} from "../../store/mainReducer";
import {getApiUrl} from "../helpers";

/**
 * Получить социальные сети проекта
 * @returns {(function(*): void)|*}
 */
export const fetchSocialLinks = () => {
    let url = getApiUrl();
    return (dispatch) => {
        axios.get(`${url}/social-link`)
            .then(response => response.data)
            .then(data => dispatch(getSocialLinksAction(data)))
            .catch(error => console.log(error))
    }
}