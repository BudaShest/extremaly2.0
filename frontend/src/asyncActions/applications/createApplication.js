import axios from 'axios';


export const createApplication = (application) => {
    let currentUser = JSON.parse(sessionStorage.getItem('userInfo'));
    let token = currentUser ? currentUser.token : "";
    const config = {
        headers: {"Authorization": `Bearer ${token}`}
    };
    return axios.post(`http://localhost:8000/application/create-application`, application)
        .then(response => response.data)
        .then(data => {
            return data;
        })
        .catch(error => console.log(error))

}