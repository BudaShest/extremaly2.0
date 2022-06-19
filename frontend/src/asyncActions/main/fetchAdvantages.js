import axios from 'axios';
import {getAdvantagesAction} from "../../store/mainReducer";
import {getApiUrl} from "../helpers";

/**
 * Получить преимущества проекта
 * @returns {(function(*): void)|*}
 */
export const fetchAdvantages = () => {
    let url = getApiUrl();
    return (dispatch) => {
        axios.get(`${url}/advantage`)
            .then(response => response.data)
            .then(data => dispatch(getAdvantagesAction(data)))
            .catch(error => console.log(error))
    }
}