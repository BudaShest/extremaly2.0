import axios from 'axios';
import {getPlaceAction} from '../../store/placesReducer';
import {getApiUrl} from "../helpers";

/**
 * Получить место
 * @param id
 * @returns {(function(*): void)|*}
 */
export const fetchPlace = (id) => {
    let url = getApiUrl();
    return (dispatch) => {
        axios.get(`${url}/place/view?id=${id}`)
            .then(response => response.data)
            .then(data => dispatch(getPlaceAction(data)))
            .catch(console.error)
    }
}