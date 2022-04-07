import axios from 'axios';

export const updateUser = (user)=>{
    return axios.post('http://localhost:8000/user/update-user?id='+user.id, user)
        .then(response => response.data)
        .then(data => {
            return data;
        })
        .catch(error => console.error(error));
}