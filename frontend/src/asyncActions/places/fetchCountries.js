import {getCountriesAction} from "../../store/placesReducer";
import axios from 'axios';
import {getApiUrl} from "../helpers";

/**
 * Получить страны
 * @returns {(function(*): void)|*}
 */
export const fetchCountries = () => {
    let url = getApiUrl();
    return (dispatch) => {
        axios.get(`${url}/countries`)
            .then(response => response.data)
            .then(data => dispatch(getCountriesAction(data)))
    }
}