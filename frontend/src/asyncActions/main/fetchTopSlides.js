import {getTopSlidesAction} from "../../store/mainReducer";
import axios from 'axios';

export const fetchTopSlides = () => {
    return (dispatch) => {
        axios.get('http://localhost:8000/static-content')
            .then(response => response.data)
            .then(data => dispatch(getTopSlidesAction(data)))
            .catch(error => console.log(error))
    }
}