import axios from 'axios';
import {addTicketAction} from "../../store/applicationReducer";

export const addTicket = (ticketId) => {
    return (dispatch) => {
        axios.get('http://localhost:8000/ticket/view?id=' + ticketId)
            .then(res => res.data)
            .then(data => dispatch(addTicketAction(data)))
            .catch(console.error)
    }
}