import {getPersonsAction, getRandomPersonsAction} from "../../store/personsReducer.js";
import axios from 'axios';

export const fetchPersons = () => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/person`)
            .then(response => response.data)
            .then(data => dispatch(getPersonsAction(data)))
            .catch(error => console.log(error))
    }
}

export const fetchPersonsByFounded = (requestedString) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/person/find-persons?requestedString=${requestedString}`)
            .then(response => response.data)
            .then(data => dispatch(getPersonsAction(data)))
            .catch(error => console.log(error))
    }
}

export const fetchPersonsByAge = (age) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/person/get-persons-by-age?age=${age}`)
            .then(response => response.data)
            .then(data => dispatch(getPersonsAction(data)))
            .catch(error => console.log(error))
    }
}

export const fetchRandomPersons = () => {
    return (dispatch) => {
        axios.get('http://localhost:8000/person/get-random-persons')
            .then(response => response.data)
            .then(data => dispatch(getRandomPersonsAction(data)))
            .catch(error => console.log(error))
    }
}

export const fetchPersonsByProfession = (profession) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/person/get-persons-by-profession?profession=${profession}`)
            .then(response => response.data)
            .then(data => dispatch(getPersonsAction(data)))
            .catch(error => console.log(error))
    }
}
