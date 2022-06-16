import axios from 'axios';
import {getApplicationAction} from "../../store/applicationReducer";

/**
 * Получить заявку
 * @param id
 * @returns {(function(*): void)|*}
 */
export const fetchApplication = (id) => {
    let currentUser = JSON.parse(sessionStorage.getItem('userInfo'));
    let token = currentUser ? currentUser.token : "";
    const config = {
        headers: { "Authorization": `Bearer ${token}`}
    };
    return (dispatch) => {
        axios.get('http://localhost:8000/application/view?id=' + id, config)
            .then(res => res.data)
            .then(data => dispatch(getApplicationAction(data)))
            .catch(console.error)
    }
}