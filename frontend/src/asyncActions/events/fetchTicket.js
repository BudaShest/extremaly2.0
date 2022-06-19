import axios from 'axios';
import {addTicketAction} from "../../store/applicationReducer";
import {getApiUrl} from "../helpers";

/**
 * Получить билет
 * @param ticketId
 * @returns {(function(*): void)|*}
 */
export const addTicket = (ticketId) => {
    let url = getApiUrl();
    return (dispatch) => {
        axios.get(`${url}/ticket/view?id=${ticketId}`)
            .then(res => res.data)
            .then(data => dispatch(addTicketAction(data)))
            .catch(console.error)
    }
}