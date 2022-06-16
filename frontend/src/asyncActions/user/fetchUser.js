import axios from 'axios';
import {fetchUserAction} from "../../store/userReducer";

export const fetchUser = (id) => {
    let currentUser = JSON.parse(sessionStorage.getItem('userInfo'));
    let token = currentUser ? currentUser.token : "";
    const config = {
        headers: { "Authorization": `Bearer ${token}`}
    };
    return (dispatch) => {
        axios.get(`http://localhost:8000/user/view?id=${id}`, config)
            .then(response => response.data)
            .then(data => dispatch(fetchUserAction(data)))
            .catch(error => console.log(error))
    }
}
