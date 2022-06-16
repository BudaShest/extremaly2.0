import {addReviewAction} from "../../store/mainReducer";
import axios from 'axios';

export const createReview = (eventReview) => {
    let currentUser = JSON.parse(sessionStorage.getItem('userInfo'));
    let token = currentUser ? currentUser.token : "";

    const config = {
        headers: {"Authorization": `Bearer ${token}`}
    };
    if(eventReview && currentUser){
        return (dispatch) => {
            axios.post(`http://localhost:8000/review/create`, eventReview, config)
                .then(response => response.data)
                .then(data => dispatch(addReviewAction(data)))
                .catch(error => console.log(error))
        }
    }
}