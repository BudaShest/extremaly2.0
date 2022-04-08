import axios from 'axios';
import {getSocialLinksAction} from "../../store/mainReducer";

export const fetchSocialLinks = () => {
    return (dispatch) => {
        axios.get('http://localhost:8000/social-link')
            .then(response => response.data)
            .then(data => dispatch(getSocialLinksAction(data)))
            .catch(error => console.log(error))
    }
}