import axios from 'axios';
import {getPlaceAction} from '../../store/placesReducer';

export const fetchPlace = (id) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/place/view?id=${id}`)
            .then(response => response.data)
            .then(data => dispatch(getPlaceAction(data)))
            .catch(console.error)
    }
}