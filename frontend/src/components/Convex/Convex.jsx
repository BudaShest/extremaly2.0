//Компонент - выпуклость (выпирающий блок)
import React from 'react';
import {Card, Col, Row} from 'react-materialize';

const Convex = ({size, s, background, push, offset,children}) => {
    return (
        <Col className={`${size}`} s={s} push={push} offset={offset} style={{background: background, padding: 0, margin: "50px 0"}}>
            {children}
        </Col>

    );
};

export default Convex;