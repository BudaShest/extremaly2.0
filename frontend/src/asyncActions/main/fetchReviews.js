import axios from 'axios';
import {getReviewsAction} from "../../store/mainReducer";

export const fetchReviews = () => {
    return (dispatch) => {
        axios.get('http://localhost:8000/review')
            .then(response => response.data)
            .then(data => dispatch(getReviewsAction(data)))
            .catch(error => console.log(error))
    }
}