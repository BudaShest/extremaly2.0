const defaultValueState = {
    persons: [],
    person: {},
    professions: []
}

const GET_PERSONS = "GET_PERSONS";
const GET_PERSON = "GET_PERSON";
const GET_PROFESSIONS = 'GET_PROFESSIONS';

export const personsReducer = (state = defaultValueState, action) => {
    switch (action.type) {
        case GET_PERSON:
            return {...state, person: action.payload}
        case GET_PERSONS:
            return {...state, persons: action.payload};
        case GET_PROFESSIONS:
            return {...state, professions: action.payload};
        default:
            return state;
    }
}

export const getPersonsAction = (payload) => ({type: GET_PERSONS, payload})
export const getProfessionsAction = (payload) => ({type: GET_PROFESSIONS, payload})
export const getPersonAction = (payload) => ({type: GET_PERSON, payload})