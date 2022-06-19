import axios from 'axios';
import {fetchUserAction} from "../../store/userReducer";
import {getApiUrl, getUserToken} from "../helpers";

/**
 * Получить пользователя
 * @param id
 * @returns {(function(*): void)|*}
 */
export const fetchUser = (id) => {
    let url = getApiUrl();
    let token = getUserToken();
    const config = {
        headers: { "Authorization": `Bearer ${token}`}
    };
    return (dispatch) => {
        axios.get(`${url}/user/view?id=${id}`, config)
            .then(response => response.data)
            .then(data => dispatch(fetchUserAction(data)))
            .catch(error => console.log(error))
    }
}
