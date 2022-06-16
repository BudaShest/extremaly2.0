import React from 'react';
import {Routes, Route} from 'react-router-dom';

/**
 * Страницы
 */
import CurrentApplication from "../pages/CurrentAppllcation/CurrentApplication";
import Main from '../pages/Main/Main';
import Event from '../pages/Event/Event';
import Events from '../pages/Events/Events';
import Login from '../pages/Login/Login';
import Register from "../pages/Register/Register";
import Places from "../pages/Places/Places";
import Place from "../pages/Place/Place";
import Persons from "../pages/Persons/Persons";
import Application from "../pages/Application/Application";
import User from "../pages/User/User";

/**
 * Главный роутер
 * @returns {JSX.Element}
 * @constructor
 */
const MainRouter = () => {
    return (
        <Routes>
            <Route path="/events">
                <Route index element={<Events/>}/>
                <Route path=":id" element={<Event/>}/>
            </Route>
            <Route path="/places">
                <Route index element={<Places/>}/>
                <Route path=":id" element={<Place/>}/>
            </Route>
            <Route path="/persons">
                <Route index element={<Persons/>}/>
                <Route path=":id" element={<Place/>}/>
            </Route>
            <Route path="/application/:id" element={<CurrentApplication/>}/>
            <Route path="/applications" element={<Application/>}/>
            <Route path="/user" element={<User/>}/>
            <Route path="/login" element={<Login/>}/>
            <Route path="/register" element={<Register/>}/>
            <Route exact path="/" element={<Main/>}/>
        </Routes>
    );
};

export default MainRouter;
