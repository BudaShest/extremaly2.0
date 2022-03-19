import {createStore, combineReducers, applyMiddleware} from 'redux';
import {placesReducer} from "./placesReducer";
import thunk from 'redux-thunk';

const rootReducer = combineReducers({
    placesReducer
})

const store = createStore(rootReducer, applyMiddleware(thunk));

export default store;