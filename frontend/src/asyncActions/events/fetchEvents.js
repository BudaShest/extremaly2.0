import {getEventsAction} from "../../store/eventsReducer";
import axios from 'axios';

export const fetchEvents = () => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/event`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
    }
}