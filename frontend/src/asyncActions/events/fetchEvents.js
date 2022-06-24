import {getEventsAction, getTopEventsAction} from "../../store/eventsReducer";
import axios from 'axios';
import {getApiUrl} from "../helpers";
import {getNumOfPagesAction} from "../../store/mainReducer";

let url = getApiUrl();

/**
 * Получить события
 * @returns {(function(*): void)|*}
 */
export const fetchEvents = () => {
    return (dispatch) => {
        axios.get(`${url}/event`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
            .catch(error => console.log(error))
    }
}

/**
 * Получить события для детей
 * @returns {(function(*): void)|*}
 */
export const fetchEventsForKids = () => {
    return (dispatch) => {
        axios.get(`${url}/event/get-events-for-kids`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
            .catch(error => console.log(error))
    }
}

/**
 * Получить события для взрослых //todo что-то с неймингом делать
 * @returns {(function(*): void)|*}
 */
export const fetchEventsForOlds = () => {
    return (dispatch) => {
        axios.get(`${url}/event/get-events-for-olds`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
            .catch(error => console.log(error))
    }
}

/**
 * Получить события по возрасту
 * @param age
 * @returns {(function(*): void)|*}
 */
export const fetchEventsByAge = (age) => {
    return (dispatch) => {
        axios.get(`${url}/event/get-events-by-age?age=${age}`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
            .catch(error => console.log(error))
    }
}

/**
 * Получить события по климату
 * @param code
 * @returns {(function(*): void)|*}
 */
export const fetchEventsByClimat = (code) => {
    return (dispatch) => {
        axios.get(`${url}/event/get-events-by-climat?code=${code}`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
            .catch(error => console.log(error))
    }
}

/**
 * Получить события по цене
 * @param code
 * @returns {(function(*): void)|*}
 */
export const fetchEventsByCountry = (code) => {
    return (dispatch) => {
        axios.get(`${url}/event/get-events-by-country?code=${code}`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
            .catch(error => console.log(error))
    }
}

/**
 * Найти соыбтия
 * @param requestedString
 * @returns {(function(*): void)|*}
 */
export const fetchEventsByFounded = (requestedString) => {
    return (dispatch) => {
        axios.get(`${url}/event/get-events-by-founded?requestedString=${requestedString}`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
            .catch(error => console.log(error))
    }
}

/**
 * Получить события по приоритету
 * @returns {(function(*): void)|*}
 */
export const fetchEventsByPriority = () => {
    return (dispatch) => {
        axios.get(`${url}/event/get-events-by-priority`)
            .then(response => response.data)
            .then(data => dispatch(getTopEventsAction(data)))
            .catch(error => console.log(error))
    }
}

/**
 * Получить события (с пагинацией)
 * @param page
 * @returns {(function(*): void)|*}
 */
export const fetchEventsWithPagination = (page) => {
    return (dispatch) => {
        axios.get(`${url}/event/get-events-with-pagination?page=${page}&per-page=3`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
            .catch(console.error)
    }
}

export const fetchNumOfPages = () => {
    return (dispatch) => {
        axios.get(`${url}/event/get-num-of-pages`)
            .then(response => response.data)
            .then(data => dispatch(getNumOfPagesAction(data)))
            .catch(console.error)
    }
}