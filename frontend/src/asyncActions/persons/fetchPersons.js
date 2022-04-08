import {getPersonsAction, getTopPersonsAction, getEventPersonsAction} from "../../store/personsReducer.js";
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

export const fetchTopPersons = () => {
    return (dispatch) => {
        axios.get('http://localhost:8000/person/get-top-persons')
            .then(response => response.data)
            .then(data => dispatch(getTopPersonsAction(data)))
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

export const fetchPersonsByEvent = (eventId) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/person/get-persons-by-event?eventId=${eventId}`)
            .then(response => response.data)
            .then(data => dispatch(getEventPersonsAction(data)))
            .catch(error => console.log(error))
    }
}