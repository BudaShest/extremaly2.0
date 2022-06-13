import React, {useRef, useState} from 'react';
import {Container} from 'react-materialize';
import {useSelector} from 'react-redux';
import Basket from "../../components/Basket/Basket";

/**
 * Страница "Заявки"
 * @returns {JSX.Element}
 * @constructor
 */
const Application = () => {
    const tickets = useSelector(state => state.applicationsReducer.tickets);

    return (
        <main>
            <Container>
                <Basket applications={tickets}/>
            </Container>
        </main>
    );
};

export default Application;