import {
    getPersonsAction,
    getTopPersonsAction,
    getEventPersonsAction,
    getNumOfPagesAction
} from "../../store/personsReducer.js";
import axios from 'axios';

/**
 * Получить все личности
 * @returns {(function(*): void)|*}
 */
export const fetchPersons = () => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/person`)
            .then(response => response.data)
            .then(data => dispatch(getPersonsAction(data)))
            .catch(console.error)
    }
}

/**
 * Получить личности по поиску
 * @param requestedString - строка поиска
 * @returns {(function(*): void)|*}
 */
export const fetchPersonsByFounded = (requestedString) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/person/find-persons?requestedString=${requestedString}`)
            .then(response => response.data)
            .then(data => dispatch(getPersonsAction(data)))
            .catch(console.error)
    }
}

/**
 * Получить личности по возрасту
 * @param age
 * @returns {(function(*): void)|*}
 */
export const fetchPersonsByAge = (age) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/person/get-persons-by-age?age=${age}`)
            .then(response => response.data)
            .then(data => dispatch(getPersonsAction(data)))
            .catch(console.error)
    }
}

/**
 * Получить первые 3 личности
 * @returns {(function(*): void)|*}
 */
export const fetchTopPersons = () => {
    return (dispatch) => {
        axios.get('http://localhost:8000/person/get-top-persons')
            .then(response => response.data)
            .then(data => dispatch(getTopPersonsAction(data)))
            .catch(console.error)
    }
}

/**
 * Получить личности по профессии
 * @param profession
 * @returns {(function(*): void)|*}
 */
export const fetchPersonsByProfession = (profession) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/person/get-persons-by-profession?profession=${profession}`)
            .then(response => response.data)
            .then(data => dispatch(getPersonsAction(data)))
            .catch(console.error)
    }
}

/**
 * Получить личности по участию в событии
 * @param eventId
 * @returns {(function(*): void)|*}
 */
export const fetchPersonsByEvent = (eventId) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/person/get-persons-by-event?eventId=${eventId}`)
            .then(response => response.data)
            .then(data => dispatch(getEventPersonsAction(data)))
            .catch(console.error)
    }
}

/**
 * Получить личности (с пагинацией)
 * @param page
 * @returns {(function(*): void)|*}
 */
export const fetchPersonsWithPagination = (page) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/person/get-persons-with-pagination?page=${page}&per-page=5`)
            .then(response => response.data)
            .then(data => dispatch(getPersonsAction(data)))
            .catch(console.error)
    }
}

/**
 * Получить количество страниц (для пагинации)
 * @returns {(function(*): void)|*}
 */
export const fetchNumOfPaginatedPages = () => {
    return (dispatch) => {
        axios.get('http://localhost:8000/person/get-num-of-paginated-pages')
            .then(response => response.data)
            .then(data => dispatch(getNumOfPagesAction(data)))
            .catch(console.error)
    }
}