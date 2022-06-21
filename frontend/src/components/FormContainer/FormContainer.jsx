import React from 'react';
import {Row,Col} from "react-materialize";
import style from './FormContanier.module.css'

const FormContainer = ({icon,children, background}) => {
    return (
        <Row className={style.formContainer} style={{background:background}}>
            <Col s={0} l={4}>
                {icon}
            </Col>
            <Col s={12} l={8}>
                {children}
            </Col>
        </Row>
    );
};

export default FormContainer;