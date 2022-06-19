import {getEventReviewsAction} from "../../store/eventsReducer";
import axios from 'axios';
import {getNumOfPagesAction} from "../../store/personsReducer";
import {getNumOfReviewPagesAction} from "../../store/eventsReducer";
import {getApiUrl} from "../helpers";

let url = getApiUrl();

/**
 * Получить отзывы к событию
 * @param eventId
 * @param page
 * @returns {(function(*): void)|*}
 */
export const fetchEventReviews = (eventId, page) => {
    return (dispatch) => {
        axios.get(`${url}/event-review/get-event-reviews?eventId=${eventId}&page=${page}&per-page=3`)
            .then(response => response.data)
            .then(data => dispatch(getEventReviewsAction(data)))
            .catch(error => console.log(error))
    }
}

/**
 * Получить отзывы с пагинацией
 * @param eventId
 * @returns {(function(*): void)|*}
 */
export const fetchEventReviewsWithPagination = (eventId) => {
    return (dispatch) => {
        axios.get(`${url}/event-review/get-event-reviews?eventId=${eventId}`)
            .then(response => response.data)
            .then(data => dispatch(getEventReviewsAction(data)))
            .catch(error => console.log(error))
    }
}

/**
 * Получить количество страниц (для пагинации)
 * @returns {(function(*): void)|*}
 */
export const fetchNumOfPaginatedPages = (eventId) => {
    return (dispatch) => {
        axios.get(`${url}/event-review/get-num-of-pages?eventId=${eventId}`)
            .then(response => response.data)
            .then(data => dispatch(getNumOfReviewPagesAction(data)))
            .catch(console.error)
    }
}