/**
 * Дефолтное сосояние
 * @type {{aboutUs: {}, socialLinks: *[], numOfPages: number, topSlides: *[], advantages: *[], reviews: *[]}}
 */
const defaultValueState = {
    topSlides: [],
    advantages: [],
    aboutUs: {},
    reviews: [],
    socialLinks: [],
    numOfPages: 0,
}

/**
 * Константы типов действий
 * @type {string}
 */
const GET_TOP_SLIDES = 'GET_TOP_SLIDES';
const GET_ABOUT_US = 'GET_ABOUT_US';
const GET_ADVANTAGES = 'GET_ADVANTAGES';
const GET_REVIEWS = 'GET_REVIEWS';
const ADD_REVIEW = 'ADD_REVIEW';
const GET_SOCIAL_LINKS = 'GET_SOCIAL_LINKS';
const GET_NUM_OF_PAGES = 'GET_NUM_OF_PAGES';

/**
 * Редьсюер
 * @param state
 * @param action
 * @returns {{aboutUs: {}, socialLinks: *[], numOfPages: number, topSlides: *[], advantages: *[], reviews: *[]}|{aboutUs: {}, socialLinks: *[], numOfPages, topSlides: *[], advantages: *[], reviews: *[]}|{aboutUs: {}, socialLinks: *[], numOfPages: number, topSlides: *[], advantages, reviews: *[]}|{aboutUs: {}, socialLinks: *[], numOfPages: number, topSlides: *[], advantages: *[], reviews}|{aboutUs: {}, socialLinks: *[], numOfPages: number, topSlides, advantages: *[], reviews: *[]}|{aboutUs: {}, socialLinks, numOfPages: number, topSlides: *[], advantages: *[], reviews: *[]}|{aboutUs, socialLinks: *[], numOfPages: number, topSlides: *[], advantages: *[], reviews: *[]}}
 */
export const mainReducer = (state = defaultValueState, action) => {
    switch (action.type) {
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
        case GET_SOCIAL_LINKS:
            return {...state, socialLinks: action.payload}
        case GET_NUM_OF_PAGES:
            return {...state, numOfPages: action.payload}
        default:
            return state;
    }
}

/**
 * Функции-действия
 * @param payload
 * @returns {{payload, type: string}}
 */
export const getAboutUsAction = (payload) => ({type: GET_ABOUT_US, payload})
export const getTopSlidesAction = (payload) => ({type: GET_TOP_SLIDES, payload})
export const getAdvantagesAction = (payload) => ({type: GET_ADVANTAGES, payload})
export const getReviewsAction = (payload) => ({type: GET_REVIEWS, payload})
export const addReviewAction = (payload) => ({type: ADD_REVIEW, payload})
export const getSocialLinksAction = (payload) => ({type: GET_SOCIAL_LINKS, payload})
export const getNumOfPagesAction = (payload) => ({type: GET_NUM_OF_PAGES, payload})