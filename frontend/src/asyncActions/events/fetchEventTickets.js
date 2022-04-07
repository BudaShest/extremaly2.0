import {getEventTicketsAction} from "../../store/eventsReducer";
import axios from 'axios';

export const fetchEventTickets = (eventId) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/ticket/get-tickets-by-event?eventId=${eventId}`)
            .then(response => response.data)
            .then(data => dispatch(getEventTicketsAction(data)))
            .catch(console.error)
    }
}