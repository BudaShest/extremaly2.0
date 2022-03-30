import {createStore, combineReducers, applyMiddleware} from 'redux';
import {placesReducer} from "./placesReducer";
import {userReducer} from "./userReducer";
import thunk from 'redux-thunk';

const rootReducer = combineReducers({
    placesReducer,
    userReducer,
})

const store = createStore(rootReducer, applyMiddleware(thunk));

export default store;