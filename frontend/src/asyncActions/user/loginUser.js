import axios from 'axios';

export const loginUser = (user)=>{
    axios.post('http://localhost:8000/user/login', user)
        .then(response => response.data)
        .then(data => console.log(data))
        .catch(error => console.error(error))
}