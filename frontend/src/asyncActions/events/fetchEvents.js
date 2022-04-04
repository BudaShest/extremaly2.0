import {getEventsAction} from "../../store/eventsReducer";
import axios from 'axios';

export const fetchEvents = () => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/event`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
    }
}

export const fetchEventsForKids = () => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/event/get-events-for-kids`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
    }
}

export const fetchEventsForOlds = () => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/event/get-events-for-olds`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
    }
}

export const fetchEventsByAge = (age) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/event/get-events-by-age?age=${age}`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
    }
}

export const fetchEventsByPriority = (age) => {
    return (dispatch) => {
        axios.get(`http://localhost:8000/event/get-events-by-age?age=${age}`)
            .then(response => response.data)
            .then(data => dispatch(getEventsAction(data)))
    }
}