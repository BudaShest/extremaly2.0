import axios from 'axios';

export const sendMail = (mail) =>{
    return axios.post('http://localhost:8000/mail/send-mail', mail)
        .then(response => response.data)
        .then(data => {return data})
        .catch(console.error)
}