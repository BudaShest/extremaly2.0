import axios from 'axios';
import {getApplicationsAction} from "../../store/applicationReducer";
import {getUserToken, getApiUrl} from "../helpers";

/**
 * Получить пользовательские заявки
 * @param userId
 * @returns {*|Promise<any>}
 */
export const fetchApplicationsByUser = (userId) => {
    let url = getApiUrl();
    let token = getUserToken();

    const config = {
        headers: {"Authorization": `Bearer ${token}`, 'Content-Type': 'application/json'}
    };
    return (dispatch) => {
        axios.get(`${url}/get-applications-by-user?userId=` + userId, config)
            .then(res => res.data)
            .then(data => dispatch(getApplicationsAction(data)))
            .catch(console.error)
    }

}