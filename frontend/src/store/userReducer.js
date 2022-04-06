const defaultValueState = {
    user:{
        "id": null,
        "login": "",
        "password": "",
        "email": null,
        "phone": null,
        "avatar": null,
        "role_id": null,
        "access_token": "",
        "ip": ""
    }
}

const REGISTER_USER = 'POST_USER';
const LOGIN_USER = "LOGIN_USER";
const FETCH_USER = "FETCH_USER";

export const userReducer = (state = defaultValueState, action) => {
    switch (action.type) {
        case REGISTER_USER:
            return action.payload
        case LOGIN_USER:
            return action.payload
        case FETCH_USER:
            return {...state, user: action.payload}
        default:
            return state;
    }
}

export const registerUserAction = (payload) => ({type: REGISTER_USER, payload})
export const loginUserAction = (payload) => ({type: LOGIN_USER, payload})
export const fetchUserAction = (payload) => ({type: FETCH_USER, payload})