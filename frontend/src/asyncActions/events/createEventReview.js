import {addEventReviewAction} from "../../store/eventsReducer";
import axios from 'axios';
import {getApiUrl} from "../helpers";

/**
 * Создание отзыва к событию
 * @param eventReview
 * @returns {(function(*): void)|*}
 */
export const createEventReview = (eventReview) => {
    let url = getApiUrl();
    if (eventReview) {
        return (dispatch) => {
            axios.post(`${url}/event-review/create`, eventReview)
                .then(response => response.data)
                .then(data => dispatch(addEventReviewAction(data)))
                .catch(error => console.log(error))
        }
    }
}