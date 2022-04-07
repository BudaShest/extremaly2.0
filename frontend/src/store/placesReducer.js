const defaultValueState = {
    places: [],
    countries: [],
    climates: [],
    place: {},
    placeEvents: []
}


const GET_COUNTRIES = 'GET_COUNTRIES';
const GET_PLACES = 'GET_PLACES';
const GET_CLIMATES = 'GET_CLIMATES';
const GET_PLACE = 'GET_PLACE';
const GET_PLACE_EVENTS = 'GET_PLACE_EVENTS';

export const placesReducer = (state = defaultValueState, action) => {
    switch (action.type) {
        case GET_COUNTRIES:
            return {...state, countries: [...action.payload]};
        case GET_PLACES:
            return {...state, places: [...action.payload]};
        case GET_CLIMATES:
            return {...state, climates: [...action.payload]};
        case GET_PLACE:
            return {...state, place: action.payload};
        case GET_PLACE_EVENTS:
            return {...state, placeEvents: action.payload}
        default:
            return state;
    }
}

export const getPlaceEventsAction = (payload) => ({type:GET_PLACE_EVENTS, payload})
export const getCountriesAction = (payload) => ({type: GET_COUNTRIES, payload})
export const getPlacesAction = (payload) => ({type: GET_PLACES, payload})
export const getClimatesAction = (payload) => ({type: GET_CLIMATES, payload})
export const getPlaceAction = (payload) => ({type: GET_PLACE, payload})