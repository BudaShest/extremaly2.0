const defaultValueState = {
    topSlides: [],
    advantages: [],
    aboutUs: {},
    reviews: []
}

const GET_TOP_SLIDES = 'GET_TOP_SLIDES';
const GET_ABOUT_US = 'GET_ABOUT_US';
const GET_ADVANTAGES = 'GET_ADVANTAGES';
const GET_REVIEWS = 'GET_REVIEWS';
const ADD_REVIEW = 'ADD_REVIEW';

export const mainReducer = (state = defaultValueState, action) => {
    switch (action.type){
        case GET_TOP_SLIDES:
            return {...state, topSlides: action.payload}
        case GET_ABOUT_US:
            return {...state, aboutUs: action.payload}
        case GET_ADVANTAGES:
            return {...state, advantages: action.payload}
        case GET_REVIEWS:
            return {...state, reviews: action.payload}
        case ADD_REVIEW:
            return {...state, reviews: [...state.reviews, action.payload]}
        default:
            return state;
    }
}


export const getAboutUsAction = (payload) => ({type: GET_ABOUT_US, payload})
export const getTopSlidesAction = (payload) => ({type: GET_TOP_SLIDES, payload})
export const getAdvantagesAction = (payload) => ({type: GET_ADVANTAGES, payload})
export const getReviewsAction = (payload) => ({type:GET_REVIEWS, payload})
export const addReviewAction = (payload) => ({type:ADD_REVIEW, payload})