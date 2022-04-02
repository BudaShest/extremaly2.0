//В этом файле опеределён роутер с машрутами
import React from 'react';
import {Routes, Route} from 'react-router-dom';

import Main from '../pages/Main/Main';
import Event from '../pages/Event/Event';
import Events from '../pages/Events/Events';
import Login from '../pages/Login/Login';
import Register from "../pages/Register/Register";
import Places from "../pages/Places/Places";
import Place from "../pages/Place/Place";
import Persons from "../pages/Persons/Persons";


const MainRouter = () => {
    return (
        <Routes>
            <Route exact path="/" element={<Main/>}/>
            <Route path="/event" element={<Event/>}/>
            <Route path="/events" element={<Events/>}/>
            <Route path="/places">
                <Route index element={<Places/>}/>
                <Route path=":id" element={<Place/>}/>
            </Route>
            <Route path="/persons">
                <Route index element={<Persons/>}/>
                <Route path=":id" element={<Place/>}/>
            </Route>
            <Route path="/login" element={<Login/>}/>
            <Route path="/register" element={<Register/>}/>
        </Routes>
    );
};

export default MainRouter;