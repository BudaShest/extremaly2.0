import axios from 'axios';
import {getAdvantagesAction} from "../../store/mainReducer";

export const fetchAdvantages = () => {
    return (dispatch) => {
        axios.get('http://localhost:8000/advantage')
            .then(response => response.data)
            .then(data => dispatch(getAdvantagesAction(data)))
            .catch(error => console.log(error))
    }
}