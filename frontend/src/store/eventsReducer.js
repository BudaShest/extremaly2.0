const defaultValueState = {
    oneEvent: {},
    events: [],
}

const GET_EVENTS = 'GET_EVENTS';
const GET_EVENT = 'GET_EVENT';

export const eventsReducer = (state = defaultValueState, action) => {
    switch (action.type){
        case GET_EVENTS:
            return {...state, events: [...action.payload]}
        case GET_EVENT:
            return {...state, oneEvent: action.payload}
        default:
            return state;
    }
}
export const getEventsAction = (payload) => ({type: GET_EVENTS, payload})
export const getEventAction = (payload) => ({type: GET_EVENT, payload})