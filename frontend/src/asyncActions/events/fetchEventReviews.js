import {getEventReviews} from "../../store/eventsReducer";
import axios from 'axios';

export const fetchEventReviews = (eventId) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/event-review/get-event-reviews?eventId=${eventId}`)
            .then(response => response.data)
            .then(data => dispatch(getEventReviews(data)))
            .catch(error => console.log(error))
    }
}