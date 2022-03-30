const defaultValueState = {
    places: [],
    countries: [],
    climates: []
}


const GET_COUNTRIES = 'GET_COUNTRIES';
const GET_PLACES = 'GET_PLACES';
const GET_CLIMATES = 'GET_CLIMATES';

export const placesReducer = (state = defaultValueState, action) => {
    switch (action.type) {
        case GET_COUNTRIES:
            return {...state, countries: [...action.payload]};
        case GET_PLACES:
            return {...state, places: [...action.payload]};
        case GET_CLIMATES:
            return {...state, climates: [...action.payload]};
        default:
            return state;
    }
}

export const getCountriesAction = (payload) => ({type: GET_COUNTRIES, payload})
export const getPlacesAction = (payload) => ({type: GET_PLACES, payload})
export const getClimatesAction = (payload) => ({type: GET_CLIMATES, payload})