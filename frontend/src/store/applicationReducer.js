const defaultValueState = {
    applications:[],
    tickets:[]
}

const ADD_APPLICATION = 'ADD_APPLICATION';
const ADD_TICKET = 'ADD_TICKET';

export const applicationsReducer = (state = defaultValueState, action) =>{
    switch (action.type){
        case ADD_APPLICATION:
            return {...state, applications: [...state.applications, action.payload]}
        case ADD_TICKET:
            return {...state, tickets: [...state.tickets, action.payload]}
        default:
            return state;
    }
}

export const addApplicationAction = (payload) => ({type:ADD_APPLICATION, payload})
export const addTicketAction = (payload) => ({type:ADD_TICKET, payload})