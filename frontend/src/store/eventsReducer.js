const defaultValueState = {
    oneEvent: {},
    events: [],
    eventReviews: [],
}

const GET_EVENTS = 'GET_EVENTS';
const GET_EVENT = 'GET_EVENT';
const GET_EVENT_REVIEWS = 'GET_EVENT_REVIEWS';
const ADD_EVENT_REVIEWS = 'ADD_EVENT_REVIEWS';

export const eventsReducer = (state = defaultValueState, action) => {
    switch (action.type){
        case GET_EVENTS:
            return {...state, events: [...action.payload]}
        case GET_EVENT:
            return {...state, oneEvent: action.payload}
        case GET_EVENT_REVIEWS:
            return {...state, eventReviews: [...action.payload]}
        case ADD_EVENT_REVIEWS:
            return {...state, eventReviews: [...state.eventReviews, action.payload]}
        default:
            return state;
    }
}
export const getEventsAction = (payload) => ({type: GET_EVENTS, payload})
export const getEventAction = (payload) => ({type: GET_EVENT, payload})
export const getEventReviews = (payload) => ({type: GET_EVENT_REVIEWS, payload})
export const addEventReview = (payload) => ({type:ADD_EVENT_REVIEWS, payload})