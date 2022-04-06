import {getEventsAction} from "../../store/eventsReducer";
import axios from 'axios';

export const fetchEvents = () => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/event`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
            .catch(error => console.log(error))
    }
}

export const fetchEventsForKids = () => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/event/get-events-for-kids`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
            .catch(error => console.log(error))
    }
}

export const fetchEventsForOlds = () => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/event/get-events-for-olds`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
            .catch(error => console.log(error))
    }
}

export const fetchEventsByAge = (age) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/event/get-events-by-age?age=${age}`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
            .catch(error => console.log(error))
    }
}

export const fetchEventsByClimat = (code) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/event/get-events-by-climat?code=${code}`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
            .catch(error => console.log(error))
    }
}

export const fetchEventsByCountry = (code) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/event/get-events-by-country?code=${code}`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
            .catch(error => console.log(error))
    }
}


export const fetchEventsByFounded = (requestedString) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/event/get-events-by-founded?requestedString=${requestedString}`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
            .catch(error => console.log(error))
    }
}

export const fetchEventsByPriority = (age) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/event/get-events-by-age?age=${age}`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
            .catch(error => console.log(error))
    }
}