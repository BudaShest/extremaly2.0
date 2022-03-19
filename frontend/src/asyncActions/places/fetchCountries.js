import {getCountriesAction} from "../../store/placesReducer";
import axios from 'axios';

export const fetchCountries = () => {
    return (dispatch) => {
        axios.get('http://localhost:8000/countries')
            .then(response => response.data)
            .then(data => dispatch(getCountriesAction(data)))
    }
}