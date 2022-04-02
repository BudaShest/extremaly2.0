import {createStore, combineReducers, applyMiddleware} from 'redux';
import {placesReducer} from "./placesReducer";
import {userReducer} from "./userReducer";
import {personsReducer} from "./personsReducer";
import thunk from 'redux-thunk';

const rootReducer = combineReducers({
    placesReducer,
    userReducer,
    personsReducer
})

const store = createStore(rootReducer, applyMiddleware(thunk));

export default store;