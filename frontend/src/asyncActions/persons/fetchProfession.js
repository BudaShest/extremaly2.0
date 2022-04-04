import {getProfessionsAction} from "../../store/personsReducer";
import axios from 'axios';

export const fetchProfessions = () => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/person/get-professions`)
            .then(response => response.data)
            .then(data => dispatch(getProfessionsAction(data)))
    }
}