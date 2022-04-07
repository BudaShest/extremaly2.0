import axios from 'axios';
import {getPlaceEventsAction} from '../../store/placesReducer';

export const fetchEventsByPlace = (placeId) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/event/get-events-by-place?placeId=${placeId}`)
            .then(response => response.data)
            .then(data => dispatch(getPlaceEventsAction(data)))
            .catch(console.error)
    }
}