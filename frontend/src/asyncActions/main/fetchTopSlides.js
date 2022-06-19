import {getTopSlidesAction} from "../../store/mainReducer";
import axios from 'axios';
import {getApiUrl} from "../helpers";

/**
 * Получить слайды для главной страницы
 * @returns {(function(*): void)|*}
 */
export const fetchTopSlides = () => {
    let url = getApiUrl();
    return (dispatch) => {
        axios.get(`${url}/static-content`)
            .then(response => response.data)
            .then(data => dispatch(getTopSlidesAction(data)))
            .catch(error => console.log(error))
    }
}