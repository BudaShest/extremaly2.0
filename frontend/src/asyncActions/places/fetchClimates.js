import {getClimatesAction} from "../../store/placesReducer";
import axios from 'axios';

export const fetchClimates = () =>{
    return (dispatch) => {
        axios.get('http://localhost:8000/climat')
            .then(response => response.data)
            .then(data => dispatch(getClimatesAction(data)))
    }
}