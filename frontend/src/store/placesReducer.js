/**
 * Дефолтное состояние
 * @type {{places: *[], countries: *[], place: {}, climates: *[], placeEvents: *[]}}
 */
const defaultValueState = {
    places: [],
    countries: [],
    climates: [],
    place: {},
    placeEvents: [],
    numOfPages: 0
}

/**
 * Константы типы действий
 * @type {string}
 */
const GET_COUNTRIES = 'GET_COUNTRIES';
const GET_PLACES = 'GET_PLACES';
const GET_CLIMATES = 'GET_CLIMATES';
const GET_PLACE = 'GET_PLACE';
const GET_PLACE_EVENTS = 'GET_PLACE_EVENTS';
const GET_NUM_OF_PAGES = 'GET_NUM_OF_PAGES';

/**
 * Редьюсер
 * @param state
 * @param action
 * @returns {{places: *[], countries: *[], place: {}, climates: *[], placeEvents}|{places: *[], countries: *[], place, climates: *[], placeEvents: *[]}|{places: *[], countries: *[], place: {}, climates: *[], placeEvents: *[]}}
 */
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
        case GET_NUM_OF_PAGES:
            return {...state, numOfPages: action.payload}
        default:
            return state;
    }
}

/**
 * Функции действия
 * @param payload
 * @returns {{payload, type: string}}
 */
export const getPlaceEventsAction = (payload) => ({type: GET_PLACE_EVENTS, payload})
export const getCountriesAction = (payload) => ({type: GET_COUNTRIES, payload})
export const getPlacesAction = (payload) => ({type: GET_PLACES, payload})
export const getClimatesAction = (payload) => ({type: GET_CLIMATES, payload})
export const getPlaceAction = (payload) => ({type: GET_PLACE, payload})
export const getNumOfPagesAction = (payload) => ({type: GET_NUM_OF_PAGES, payload})