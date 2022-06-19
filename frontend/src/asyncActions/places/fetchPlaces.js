import {getNumOfPages, getNumOfPagesAction, getPlacesAction} from "../../store/placesReducer";
import axios from 'axios';
import {getApiUrl} from "../helpers";

let url = getApiUrl();

/**
 * Получить места
 * @returns {(function(*): void)|*}
 */
export const fetchPlaces = () => {
    return (dispatch) => {
        axios.get(`${url}/place`)
            .then(response => response.data)
            .then(data => dispatch(getPlacesAction(data)))
            .catch(console.error)
    }
}

/**
 * Получить места по стране
 * @param countryCode
 * @returns {(function(*): void)|*}
 */
export const fetchPlacesByCountry = (countryCode) => {
    return (dispatch) => {
        axios.get(`${url}/place/get-by-country-code?countryCode=${countryCode}`)
            .then(response => response.data)
            .then(data => dispatch(getPlacesAction(data)))
            .catch(console.error)
    }
}

/**
 * Получить места по климату
 * @param climatCode
 * @returns {(function(*): void)|*}
 */
export const fetchPlacesByClimat = (climatCode) => {
    return (dispatch) => {
        axios.get(`${url}/place/get-by-climat-code?climatCode=${climatCode}`)
            .then(response => response.data)
            .then(data => dispatch(getPlacesAction(data)))
            .catch(console.error)
    }
}

/**
 * Получить места (с пагинацией)
 * @param page
 * @returns {(function(*): void)|*}
 */
export const fetchPlacesWithPagination = (page) => {
    return (dispatch) => {
        axios.get(`${url}/place/get-places-with-pagination?page=${page}&per-page=3`)
            .then(response => response.data)
            .then(data => dispatch(getPlacesAction(data)))
            .catch(console.error)
    }
}

/**
 * Получить кол-во страниц (для пагинации)
 * @returns {(function(*): void)|*}
 */
export const fetchNumOfPages = () => {
    return (dispatch) => {
        axios.get(`${url}/place/get-num-of-paginated-pages`)
            .then(response => response.data)
            .then(data => dispatch(getNumOfPagesAction(data)))
            .catch(console.error)
    }
}