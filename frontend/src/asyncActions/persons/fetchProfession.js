import {getProfessionsAction} from "../../store/personsReducer";
import axios from 'axios';
import {getApiUrl} from "../helpers";

/**
 * Получить роль в событии
 * @returns {(function(*): void)|*}
 */
export const fetchProfessions = () => {
    let url = getApiUrl();
    return (dispatch) => {
        axios.get(`${url}/person/get-professions`)
            .then(response => response.data)
            .then(data => dispatch(getProfessionsAction(data)))
            .catch(console.error)
    }
}