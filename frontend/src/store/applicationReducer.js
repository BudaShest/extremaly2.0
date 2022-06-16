/**
 * Дефолтное состояние
 * @type {{tickets: *[], currentApplication: *[], applications: *[]}}
 */
const defaultValueState = {
    applications: [],
    tickets: [],
    currentApplication: []
}

/**
 * Константы типы действий
 * @type {string}
 */
const ADD_APPLICATION = 'ADD_APPLICATION';
const ADD_TICKET = 'ADD_TICKET';
const GET_APPLICATION = 'GET_APPLICATION';
const GET_APPLICATIONS = 'GET_APPLICATIONS';

/**
 * Редсьюер для заявок
 * @param state
 * @param action
 * @returns {{tickets: *[], currentApplication: *[], applications: *[]}|{currentApplication}}
 */
export const applicationsReducer = (state = defaultValueState, action) => {
    switch (action.type) {
        case ADD_APPLICATION:
            return {...state, applications: [...state.applications, action.payload]}
        case GET_APPLICATION:
            return {...state, currentApplication: action.payload}
        case GET_APPLICATIONS:
            return {...state, applications: action.payload}
        case ADD_TICKET:
            return {...state, tickets: [...state.tickets, action.payload]}
        default:
            return state;
    }
}

/**
 * Функции действия
 * @param payload
 * @returns {{payload, type: string}}
 */
export const getApplicationAction = (payload) => ({type: GET_APPLICATION, payload})
export const getApplicationsAction = (payload) => ({type: GET_APPLICATIONS, payload})
export const addApplicationAction = (payload) => ({type: ADD_APPLICATION, payload})
export const addTicketAction = (payload) => ({type: ADD_TICKET, payload})