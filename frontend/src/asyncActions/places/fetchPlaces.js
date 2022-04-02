import {getPlacesAction} from "../../store/placesReducer";
import axios from 'axios';

export const fetchPlaces = () =>{
    return (dispatch) => {
        axios.get('http://localhost:8000/place')
            .then(response => response.data)
            .then(data => dispatch(getPlacesAction(data)))
    }
}