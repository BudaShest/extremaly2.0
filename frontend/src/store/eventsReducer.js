/**
 * Дефолтное состояние
 * @type {{eventReviews: *[], topEvents: *[], oneEvent: {}, eventTickets: *[], events: *[]}}
 */
const defaultValueState = {
    oneEvent: {},
    events: [],
    eventReviews: [],
    topEvents: [],
    eventTickets: [],
    numOfPages: 0,
    numOfReviewPages: 0,
}

/**
 * Константы типов событий
 * @type {string}
 */
const GET_EVENTS = 'GET_EVENTS';
const GET_EVENT = 'GET_EVENT';
const GET_EVENT_REVIEWS = 'GET_EVENT_REVIEWS';
const ADD_EVENT_REVIEWS = 'ADD_EVENT_REVIEWS';
const GET_TOP_EVENTS = 'GET_TOP_EVENTS';
const GET_EVENT_TICKETS = 'GET_EVENT_TICKETS';
const GET_NUM_OF_PAGES = 'GET_NUM_OF_PAGES';
const GET_NUM_OF_REVIEW_PAGES = 'GET_NUM_OF_REVIEW_PAGES';

/**
 * Редьсюер
 * @param state
 * @param action
 * @returns {{eventReviews: *[], topEvents, oneEvent: {}, eventTickets: *[], events: *[]}|{eventReviews: *[], topEvents: *[], oneEvent: {}, eventTickets, events: *[]}|{eventReviews: *[], topEvents: *[], oneEvent, eventTickets: *[], events: *[]}|{eventReviews: *[], topEvents: *[], oneEvent: {}, eventTickets: *[], events: *[]}}
 */
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
        case GET_NUM_OF_PAGES:
            return {...state, numOfPages: action.payload}
        case GET_NUM_OF_REVIEW_PAGES:
            return {...state, numOfReviewPages: action.payload}
        default:
            return state;
    }
}

/**
 * Функции-действия
 * @param payload
 * @returns {{payload, type: string}}
 */
export const getEventsAction = (payload) => ({type: GET_EVENTS, payload})
export const getTopEventsAction = (payload) => ({type: GET_TOP_EVENTS, payload})
export const getEventAction = (payload) => ({type: GET_EVENT, payload})
export const getEventReviewsAction = (payload) => ({type: GET_EVENT_REVIEWS, payload})
export const addEventReviewAction = (payload) => ({type: ADD_EVENT_REVIEWS, payload})
export const getEventTicketsAction = (payload) => ({type: GET_EVENT_TICKETS, payload})
export const getNumOfPagesAction = (payload) => ({type: GET_NUM_OF_PAGES, payload})
export const getNumOfReviewPagesAction = (payload) => ({type: GET_NUM_OF_REVIEW_PAGES, payload})