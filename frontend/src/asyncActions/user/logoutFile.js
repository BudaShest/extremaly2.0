import axios from 'axios';

export const logoutUser = ()=>{
    sessionStorage.removeItem('userInfo');
    return axios.post('http://localhost:8000/user/logout')
        .then(response => response.data)
        .then(data => {
            return data;
        })
        .catch(error => console.error(error));
}