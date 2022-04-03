import {createStore, combineReducers, applyMiddleware} from 'redux';
import {placesReducer} from "./placesReducer";
import {userReducer} from "./userReducer";
import {personsReducer} from "./personsReducer";
import {eventsReducer} from "./eventsReducer";
import thunk from 'redux-thunk';

const rootReducer = combineReducers({
    placesReducer,
    userReducer,
    personsReducer,
    eventsReducer
})

const store = createStore(rootReducer, applyMiddleware(thunk));

export default store;