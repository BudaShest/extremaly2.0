const defaultValueState = {
    login: '',
    password: '',
}

const REGISTER_USER = 'POST_USER';

export const userReducer = (state = defaultValueState, action) => {
    switch(action.type){
        case REGISTER_USER:
            return action.payload
        default:
            return state;
    }
}

export const registerUserAction = (payload) => ({type: REGISTER_USER, payload})