import axios from 'axios';
import {getAboutUsAction} from "../../store/mainReducer";

export const fetchAboutUs = () => {
    return (dispatch) => {
        axios.get('http://localhost:8000/about/view?id=1')
            .then(response => response.data)
            .then(data => dispatch(getAboutUsAction(data)))
            .catch(error => console.log(error))
    }
}