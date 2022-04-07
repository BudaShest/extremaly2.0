import axios from 'axios';

export const fetchApplicationsByUser = (userId)=>{
    return axios.get('http://localhost:8000/application/get-applications-by-user?userId='+userId)
        .then(res => res.data)
        .then(data => data)
        .catch(console.error)
}