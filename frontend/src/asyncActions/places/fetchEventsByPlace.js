import axios from 'axios';
import {getPlaceEventsAction} from '../../store/placesReducer';
import {getApiUrl} from "../helpers";

/**
 * Получить события по месту проведения
 * @param placeId
 * @returns {(function(*): void)|*}
 */
export const fetchEventsByPlace = (placeId) => {
    let url = getApiUrl();
    return (dispatch) => {
        axios.get(`${url}/event/get-events-by-place?placeId=${placeId}`)
            .then(response => response.data)
            .then(data => dispatch(getPlaceEventsAction(data)))
            .catch(console.error)
    }
}