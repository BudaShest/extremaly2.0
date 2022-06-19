import {getEventAction} from "../../store/eventsReducer";
import axios from 'axios';
import {getApiUrl} from "../helpers";

export const fetchEvent = (id) => {
    let url = getApiUrl();
    return (dispatch) => {
        axios.get(`${url}/event/view?id=${id}`)
            .then(response => response.data)
            .then(data => dispatch(getEventAction(data)))
    }
}