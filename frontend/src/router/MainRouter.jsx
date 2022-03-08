//В этом файле опеределён роутер с машрутами
import React from 'react';
import {Routes, Route} from 'react-router-dom';

import Main from '../pages/Main/Main';
import Event from '../pages/Event/Event';
import Events from '../pages/Events/Events';
import Login from '../pages/Login/Login';
import Register from "../pages/Register/Register";
import Places from "../pages/Places/Places";

const MainRouter = () => {
    return (
        <Routes>
            <Route exact path="/" element={<Main/>}/>
            <Route path="/event" element={<Event/>}/>
            <Route path="/events" element={<Events/>}/>
            <Route path="/places" element={<Places/>}/>
            <Route path="/login" element={<Login/>}/>
            <Route path="/register" element={<Register/>}/>
        </Routes>
    );
};

export default MainRouter;