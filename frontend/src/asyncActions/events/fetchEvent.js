import {getEventAction} from "../../store/eventsReducer";
import axios from 'axios';

export const fetchEvent = (id) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/event/view?id=${id}`)
            .then(response => response.data)
            .then(data => dispatch(getEventAction(data)))
    }
}