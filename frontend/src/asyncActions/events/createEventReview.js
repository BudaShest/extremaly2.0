import {addEventReview} from "../../store/eventsReducer";
import axios from 'axios';

export const createEventReview = (eventReview) => {
    if(eventReview){
        return (dispatch) => {
            axios.post(`http://localhost:8000/event-review/create`, eventReview)
                .then(response => response.data)
                .then(data => dispatch(addEventReview(data)))
                .catch(error => console.log(error))
        }
    }
}