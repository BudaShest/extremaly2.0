import {getClimatesAction} from "../../store/placesReducer";
import axios from 'axios';
import {getApiUrl} from "../helpers";

/**
 * Получить климаты
 * @returns {(function(*): void)|*}
 */
export const fetchClimates = () => {
    let url = getApiUrl();
    return (dispatch) => {
        axios.get(`${url}/climat`)
            .then(response => response.data)
            .then(data => dispatch(getClimatesAction(data)))
    }
}