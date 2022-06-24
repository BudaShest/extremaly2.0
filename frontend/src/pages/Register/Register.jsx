import React, {useState, useRef} from 'react';
import Convex from "../../components/Convex/Convex";
import FormContainer from "../../components/FormContainer/FormContainer";
import {Row, TextInput, Icon, Container, Col, Button, Chip} from "react-materialize";
import {NavLink} from 'react-router-dom';
import {registerUser} from "../../asyncActions/user/registerUser";
import style from './Register.module.css';

/**
 * Страница "Регистрация"
 * @returns {JSX.Element}
 * @constructor
 */
const Register = () => {
    const [loginError, setLoginError] = useState('');
    const loginRef = useRef();
    const [passwordError, setPasswordError] = useState('');
    const passwordRef = useRef();
    const [confirmPasswordError, setConfirmPasswordError] = useState('');
    const confirmPasswordRef = useRef();
    const [phoneError, setPhoneError] = useState('');
    const phoneRef = useRef();
    const [emailError, setEmailError] = useState('');
    const emailRef = useRef();

    const [operResult, setOperResult] = useState('Результат регистрации: ');

    const validateLogin = (login) => {
        if (login.length < 4 || login.length > 16) {
            setLoginError('Логин должен быть длинной от 4 до 16 символов')
            return false;
        }
        setLoginError('')
        return true;
    }

    const validatePassword = (password) => {
        const passwordRegExp = /(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{6,}/g;
        if (password.length < 6 || password.length > 20) {
            setPasswordError('Пароль должен быть длинной от 6 до 20 символов');
            return false;
        }
        if (!passwordRegExp.test(password)) {
            setPasswordError('Пароль должен быть длинной от 6 до 20 символов с использованием цифр, спец. символов, латиницы, наличием строчных и прописных символов');
            return false;
        }
        setPasswordError('')
        return true;
    }

    const validateConfirmPassword = (password, confirmedPassword) => {
        if (confirmedPassword.length < 7 || confirmedPassword.length > 20) {
            setConfirmPasswordError('Пароль должен быть длинной от 7 до 20 символов');
            return false;
        }
        if (password !== confirmedPassword) {
            setConfirmPasswordError('Пароли должны совпадать!')
            return false;
        }
        setConfirmPasswordError('')
        return true;
    }

    const validatePhone = (phone) => {
        const phoneRegExp = /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/;
        if (!phoneRegExp.test(phone)) {
            setPhoneError("Телефонный номер должен быть корректным!");
            return false;
        }
        setPhoneError('');
        return true;
    }

    const validateEmail = (email) => {
        const mailDommens = ['gmail.com', 'mail.ru', 'yandex.ru', 'rambler.ru'];
        const [address, domen] = email.split('@');
        if (!mailDommens.includes(domen)) {
            setEmailError('Адрес электронной почти должен быть корректным');
            return false;
        }
        if (address.length < 3 || address.length > 20) {
            setEmailError('Адрес электронной почты должен быть длинной от 3 до 20 символов (не включая @domen)');
            return false;
        }
        setEmailError('');
        return true;
    }

    const validateAllFields = (user) => {
        return !!(validateLogin(user.login) &&
            validatePassword(user.password) &&
            validateConfirmPassword(user.password, user.confirmPassword) &&
            validatePhone(user.phone) &&
            validateEmail(user.email));
    }


    const register = (e) => {
        e.preventDefault();
        let user = {
            login: loginRef.current.value,
            password: passwordRef.current.value,
            confirmPassword: confirmPasswordRef.current.value,
            email: emailRef.current.value,
            phone: phoneRef.current.value,
        };
        if (validateAllFields(user)) {
            registerUser(user).then(res => {
                setOperResult(res.message);

                if (res.login) {
                    setLoginError(res.login[0]);
                }

                if (res.email) {
                    setEmailError(res.email[0]);
                }

                if (res.password) {
                    setPasswordError(res.password[0]);
                }

                if (res.phone) {
                    setPhoneError(res.phone[0]);
                }

                if (res.confirmPassword) {
                    setConfirmPasswordError(res.phone[0])
                }

                if (res.result) {
                    setTimeout(() => {
                        setOperResult('');
                        window.location.href = 'http://extremly.ru/';
                    }, 10000)
                }
            });
        }
    }

    return (
        <main>
            <Container style={{padding: "40px 0"}}>
                <Chip style={{fontSize: '1.2em'}}>{operResult}</Chip>
                <Convex background={'linear-gradient(269.17deg, #DB4463 13.23%, #F2733C 88.24%)'}>
                    <FormContainer
                        icon={<Icon className={style.regFormIcon}>remember_me</Icon>}
                        background={'#111111'}>
                        <form action="" onSubmit={e => register(e)}>
                            <Row>
                                <span className={`${style.errorSpan} col s12 m8`}>{loginError}</span>
                                <TextInput
                                    className={style.regFormInput}
                                    m={8}
                                    s={12}
                                    icon={<Icon>login</Icon>}
                                    id="loginInput"
                                    label="Login:"
                                    ref={loginRef}
                                />
                                <span className={`${style.errorSpan} col s12 m8`}>{passwordError}</span>
                                <TextInput
                                    className={style.regFormInput}
                                    m={8}
                                    s={12}
                                    icon={<Icon>password</Icon>}
                                    id="passwordInput"
                                    label="Пароль:"
                                    password
                                    ref={passwordRef}
                                />
                                <span className={`${style.errorSpan} col s12 m8`}>{confirmPasswordError}</span>
                                <TextInput
                                    className={style.regFormInput}
                                    s={12}
                                    m={8}
                                    icon={<Icon>password</Icon>}
                                    id="confirmInput"
                                    label="Повторите пароль:"
                                    password
                                    ref={confirmPasswordRef}
                                />
                                <span className={`${style.errorSpan} col s12 m8`}>{phoneError}</span>
                                <TextInput
                                    className={style.regFormInput}
                                    s={12}
                                    m={8}
                                    icon={<Icon>phone</Icon>}
                                    id='phoneInput'
                                    label="Телефон"
                                    ref={phoneRef}
                                />
                                <span className={`${style.errorSpan} col s12 m8`}>{emailError}</span>
                                <TextInput
                                    className={style.regFormInput}
                                    s={12}
                                    m={8}
                                    icon={<Icon>email</Icon>}
                                    id="emailInput"
                                    label="Email:"
                                    ref={emailRef}
                                />
                                <Col style={{margin: 40}} s={8}>
                                    <Col l={4} push={"m2"}>
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