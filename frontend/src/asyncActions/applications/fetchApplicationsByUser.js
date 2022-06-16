import axios from 'axios';
import {getApplicationsAction} from "../../store/applicationReducer";

/**
 * Получить пользовательские заявки
 * @param userId
 * @returns {*|Promise<any>}
 */
export const fetchApplicationsByUser = (userId) => {
    let currentUser = JSON.parse(sessionStorage.getItem('userInfo'));
    let token = currentUser ? currentUser.token : "";

    const config = {
        headers: {"Authorization": `Bearer ${token}`, 'Content-Type': 'application/json'}
    };
    return (dispatch) => {
        axios.get('http://localhost:8000/application/get-applications-by-user?userId=' + userId, config)
            .then(res => res.data)
            .then(data => dispatch(getApplicationsAction(data)))
            .catch(console.error)
    }

}