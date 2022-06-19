import {addReviewAction} from "../../store/mainReducer";
import axios from 'axios';
import {getApiUrl, getUserToken} from "../helpers";

/**
 * Создание отзыва к проекту
 * @param eventReview
 * @returns {(function(*): void)|*}
 */
export const createReview = (eventReview) => {
    let url = getApiUrl();
    let token = getUserToken();

    const config = {
        headers: {"Authorization": `Bearer ${token}`}
    };
    if (eventReview && token) {
        return (dispatch) => {
            axios.post(`${url}/review/create`, eventReview, config)
                .then(response => response.data)
                .then(data => dispatch(addReviewAction(data)))
                .catch(error => console.log(error))
        }
    }
}