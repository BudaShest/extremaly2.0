import axios from 'axios';

export const updateAvatar = (formData)=>{
    return axios.post('http://localhost:8000/user/update-avatar', formData)
        .then(response => response.data)
        .then(data => {
            return data;
        })
        .catch(error => console.error(error));
}