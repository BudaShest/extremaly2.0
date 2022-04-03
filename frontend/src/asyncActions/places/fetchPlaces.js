import {getPlacesAction} from "../../store/placesReducer";
import axios from 'axios';

export const fetchPlaces = () =>{
    return (dispatch) => {
        axios.get('http://localhost:8000/place')
            .then(response => response.data)
            .then(data => dispatch(getPlacesAction(data)))
    }
}

export const fetchPlacesByCountry = (countryCode)=>{
    return (dispatch) => {
        axios.get(`http://localhost:8000/place/get-by-country-code?countryCode=${countryCode}`)
            .then(response => response.data)
            .then(data => dispatch(getPlacesAction(data)))
    }
}

export const fetchPlacesByClimat = (climatCode)=>{
    return (dispatch) => {
        axios.get(`http://localhost:8000/place/get-by-climat-code?climatCode=${climatCode}`)
            .then(response => response.data)
            .then(data => dispatch(getPlacesAction(data)))
    }
}