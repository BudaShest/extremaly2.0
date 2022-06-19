/**
 * Получить URL для запросов
 * @returns string
 */
export const getApiUrl = () => {
    return process.env.REACT_APP_DEV ? process.env.REACT_APP_TEST_API_URL : process.env.REACT_APP_REAL_API_URL;
}

/**
 * Получить токен для текущего авторизовавшегося пользователя
 * @returns {*|string}
 */
export const getUserToken = () => {
    let currentUser = JSON.parse(sessionStorage.getItem('userInfo'));
    return currentUser ? currentUser.token : "";
}

export const logout = () => {
    sessionStorage.removeItem('userInfo');
}