import axios from 'axios';
import {getApplicationAction} from "../../store/applicationReducer";

/**
 * Получить заявку
 * @param id
 * @returns {(function(*): void)|*}
 */
export const fetchApplication = (id) => {
    return (dispatch) => {
        axios.get('http://localhost:8000/application/view?id=' + id)
            .then(res => res.data)
            .then(data => dispatch(getApplicationAction(data)))
            .catch(console.error)
    }
}