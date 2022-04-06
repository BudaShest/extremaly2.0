import {registerUserAction} from "../../store/userReducer";
import axios from 'axios';

export const registerUser = (user)=>{
    return axios.post('http://localhost:8000/user/register', user) //todo а мб будет ис нетворком работать
        .then(response => response.data)
        .then(data => {
            console.log(data);
            return data;
        })
        .catch(error => console.error(error))
}