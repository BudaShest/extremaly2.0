const defaultValueState = {
    persons: [],
    person: {}
}

const GET_PERSONS = "GET_PERSONS";
const GET_PERSON = "GET_PERSON";

export const personsReducer = (state = defaultValueState, action) => {
    switch (action.type) {
        case GET_PERSON:
            return {...state, person: action.payload}
        case GET_PERSONS:
            return {...state, persons: action.payload};
        default:
            return state;
    }
}

export const getPersonsAction = (payload) => ({type: GET_PERSONS, payload})
export const getPersonAction = (payload) => ({type: GET_PERSON, payload})