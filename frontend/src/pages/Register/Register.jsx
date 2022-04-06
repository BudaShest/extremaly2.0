import React, {useState, useRef} from 'react';
import Convex from "../../components/Convex/Convex";
import FormContainer from "../../components/FormContainer/FormContainer";
import {Row, TextInput, Icon, Container, Col, Button} from "react-materialize";
import {NavLink} from 'react-router-dom';
import {registerUser} from "../../asyncActions/user/registerUser";
import style from './Register.module.css';

const Register = () => {
    const loginRef = useRef();
    const passwordRef = useRef();
    const confirmPasswordRef = useRef();
    const phoneRef = useRef();
    const emailRef = useRef();
    const avatarRef = useRef();

    const register = (e) => {
        e.preventDefault();
        let user = {login: loginRef.current.value, password: passwordRef.current.value, confirmPassword: confirmPasswordRef.current.value, email:emailRef.current.value, phone: phoneRef.current.value};
        registerUser(user).then();
    }

    return (
        <main>
            <Container style={{padding: "40px 0"}}>
                <Convex background={'linear-gradient(269.17deg, #DB4463 13.23%, #F2733C 88.24%)'}>
                    <FormContainer
                        icon={<Icon style={{color: "#F2733C", fontSize: "28em", padding: "10px"}}>remember_me</Icon>}
                        background={'#111111'}>
                        <form action="" onSubmit={e => register(e)}>
                            <Row>
                                <TextInput
                                    className={style.regFormInput}
                                    s={8}
                                    icon={<Icon>login</Icon>}
                                    id="loginInput"
                                    label="Login:"
                                    ref={loginRef}
                                />
                                <TextInput
                                    className={style.regFormInput}
                                    s={8}
                                    icon={<Icon>password</Icon>}
                                    id="passwordInput"
                                    label="Пароль:"
                                    password
                                    ref={passwordRef}
                                />
                                <TextInput
                                    className={style.regFormInput}
                                    s={8}
                                    icon={<Icon>password</Icon>}
                                    id="confirmInput"
                                    label="Повторите пароль:"
                                    password
                                    ref={confirmPasswordRef}
                                />
                                <TextInput
                                    className={style.regFormInput}
                                    s={8}
                                    icon={<Icon>phone</Icon>}
                                    id=''
                                    label="Телефон"
                                    ref={phoneRef}
                                />
                                <TextInput
                                    className={style.regFormInput}
                                    s={8}
                                    icon={<Icon>email</Icon>}
                                    id="emailInput"
                                    label="Email:"
                                    ref={emailRef}
                                />
                                <TextInput
                                    s={8}
                                    id="fileInpue"
                                    label="Аватар профиля:"
                                    type="file"
                                    ref={avatarRef}
                                />
                                <Col style={{margin: 40}} s={8}>
                                    <Col l={4} push={"s2"}>
                                        <Button large style={{backgroundColor: "#42A379"}} node="button" type="submit"
                                                waves="light">Регистрация
                                            <Icon right>login</Icon>
                                        </Button>
                                    </Col>
                                    <Col l={4} push={"s2"}>
                                        <Button large style={{backgroundColor: "#ee6e73"}} node="button" type="reset"
                                                waves="light">Стереть
                                            <Icon right>close</Icon>
                                        </Button>
                                    </Col>
                                </Col>
                                <Col push={"s1"} s={11}>
                                    <p style={{color: "lightgrey"}}>Вы уже зарегистрированы? Тогда <NavLink
                                        to="/login">авторизуйтесь</NavLink></p>
                                </Col>
                            </Row>
                        </form>
                    </FormContainer>
                </Convex>
            </Container>
        </main>
    );
};

export default Register;