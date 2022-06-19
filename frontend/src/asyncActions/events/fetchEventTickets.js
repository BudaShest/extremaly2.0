import {getEventTicketsAction} from "../../store/eventsReducer";
import axios from 'axios';
import {getApiUrl} from "../helpers";


export const fetchEventTickets = (eventId) => {
    let url = getApiUrl();
    return (dispatch) => {
        axios.get(`${url}/ticket/get-tickets-by-event?eventId=${eventId}`)
            .then(response => response.data)
            .then(data => dispatch(getEventTicketsAction(data)))
            .catch(console.error)
    }
}