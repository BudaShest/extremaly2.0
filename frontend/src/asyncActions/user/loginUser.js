import axios from 'axios';

export const loginUser = (user)=>{
    return axios.post('http://localhost:8000/user/login', user)
        .then(response => response.data)
        .then(data => {
            return data;
        })
        .catch(error => console.error(error));
}