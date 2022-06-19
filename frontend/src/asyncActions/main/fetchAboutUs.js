import axios from 'axios';
import {getAboutUsAction} from "../../store/mainReducer";
import {getApiUrl} from "../helpers";

/**
 * Получить записи "О нас"
 * @returns {(function(*): void)|*}
 */
export const fetchAboutUs = () => {
    let url = getApiUrl();
    return (dispatch) => {
        axios.get(`${url}/about/view?id=1`)
            .then(response => response.data)
            .then(data => dispatch(getAboutUsAction(data)))
            .catch(error => console.log(error))
    }
}