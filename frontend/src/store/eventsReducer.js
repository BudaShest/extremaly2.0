const defaultValueState = {
    oneEvent: {},
    events: [],
    eventReviews: [],
    topEvents: [],
    eventTickets: [],
}

const GET_EVENTS = 'GET_EVENTS';
const GET_EVENT = 'GET_EVENT';
const GET_EVENT_REVIEWS = 'GET_EVENT_REVIEWS';
const ADD_EVENT_REVIEWS = 'ADD_EVENT_REVIEWS';
const GET_TOP_EVENTS = 'GET_TOP_EVENTS';
const GET_EVENT_TICKETS = 'GET_EVENT_TICKETS';

export const eventsReducer = (state = defaultValueState, action) => {
    switch (action.type) {
        case GET_EVENTS:
            return {...state, events: [...action.payload]}
        case GET_EVENT:
            return {...state, oneEvent: action.payload}
        case GET_EVENT_REVIEWS:
            return {...state, eventReviews: [...action.payload]}
        case ADD_EVENT_REVIEWS:
            return {...state, eventReviews: [...state.eventReviews, action.payload]}
        case GET_TOP_EVENTS:
            return {...state, topEvents: action.payload}
        case GET_EVENT_TICKETS:
            return {...state, eventTickets: action.payload}
        default:
            return state;
    }
}
export const getEventsAction = (payload) => ({type: GET_EVENTS, payload})
export const getTopEventsAction = (payload) => ({type: GET_TOP_EVENTS, payload})
export const getEventAction = (payload) => ({type: GET_EVENT, payload})
export const getEventReviewsAction = (payload) => ({type: GET_EVENT_REVIEWS, payload})
export const addEventReviewAction = (payload) => ({type: ADD_EVENT_REVIEWS, payload})
export const getEventTicketsAction = (payload) => ({type: GET_EVENT_TICKETS, payload})