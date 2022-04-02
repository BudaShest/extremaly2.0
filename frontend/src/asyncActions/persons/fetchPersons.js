import {getPersonsAction} from "../../store/personsReducer.js";
import axios from 'axios';

export const fetchPersons = () => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/person`)
            .then(response => response.data)
            .then(data => dispatch(getPersonsAction(data)))
    }
}