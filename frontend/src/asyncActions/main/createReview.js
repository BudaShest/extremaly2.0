import {addReviewAction} from "../../store/mainReducer";
import axios from 'axios';

export const createReview = (eventReview) => {
    if(eventReview){
        return (dispatch) => {
            axios.post(`http://localhost:8000/review/create`, eventReview)
                .then(response => response.data)
                .then(data => dispatch(addReviewAction(data)))
                .catch(error => console.log(error))
        }
    }
}