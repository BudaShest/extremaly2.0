import axios from 'axios';
import {getApplicationAction} from "../../store/applicationReducer";
import {getUserToken, getApiUrl} from "../helpers";

/**
 * Получить заявку
 * @param id
 * @returns {(function(*): void)|*}
 */
export const fetchApplication = (id) => {
    let url = getApiUrl();
    let token = getUserToken();
    const config = {
        headers: { "Authorization": `Bearer ${token}`}
    };
    return (dispatch) => {
        axios.get(`${url}/application/view?id=` + id, config)
            .then(res => res.data)
            .then(data => dispatch(getApplicationAction(data)))
            .catch(console.error)
    }
}