import axios from 'axios';
import {getNumOfPagesAction, getReviewsAction} from "../../store/mainReducer";

/**
 * Получить отзывы к проекту
 * @returns {(function(*): void)|*}
 */
export const fetchReviews = () => {
    return (dispatch) => {
        axios.get('http://localhost:8000/review')
            .then(response => response.data)
            .then(data => dispatch(getReviewsAction(data)))
            .catch(console.error)
    }
}

/**
 * Получить отзывы к проекту с пагинацией
 * @returns {(function(*): void)|*}
 */
export const fetchReviewWithPagination = (page) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/review/get-reviews-with-pagination?page=${page}&per-page=3`)
            .then(response => response.data)
            .then(data => dispatch(getReviewsAction(data)))
            .catch(console.error)
    }
}

/**
 * Получить количество страниц
 * @param page
 * @returns {(function(*): void)|*}
 */
export const fetchNumOfPages = (page) => {
    return (dispatch) => {
        axios.get('http://localhost:8000/review/get-num-of-pages')
            .then(response => response.data)
            .then(data => dispatch(getNumOfPagesAction(data)))
            .catch(console.error)
    }
}