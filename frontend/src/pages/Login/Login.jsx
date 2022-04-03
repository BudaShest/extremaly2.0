import React, {useState, useRef} from 'react';
import {loginUser} from "../../asyncActions/user/loginUser";
import {NavLink} from 'react-router-dom';
import {Container, Icon, TextInput, Row, Button, Col} from "react-materialize";
import Convex from "../../components/Convex/Convex";
import FormContainer from "../../components/FormContainer/FormContainer";
import style from './Login.module.css';

const Login = () => {
    const [userInfo, setUserInfo] = useState({login: '', password: ''})

    const loginRef = useRef();
    const passwordRef = useRef();

    const validateLogin = () => {

    }

    const validatePassword = () => {

    }



    const handleForm = (e) => {
        e.preventDefault();
        setUserInfo(prevState => {setUserInfo({login: loginRef.current.value, password: passwordRef.current.value })});
        console.log(userInfo);
        loginUser(userInfo);
    }

    return (
        <main>
            <Container style={{padding: "40px 0"}}>
                <Convex background={'linear-gradient(269.17deg, #DB4463 13.23%, #F2733C 88.24%)'}>
                    <FormContainer
                        icon={<Icon style={{color: "#F2733C", fontSize: "28em", padding: "10px"}}>login</Icon>}
                        background={'#111111'}>
                        <form action="" onSubmit={(e)=>handleForm(e)} className={style.logForm}>
                            <Row>
                                <TextInput s={9} l={9}
                                           className={style.logForm_icon} icon={<Icon>email</Icon>} id="TextInput-0"
                                           label="Email" ref={loginRef}
                                />
                                <TextInput s={9} l={9}
                                           icon={<Icon>password</Icon>} id="TextInput-1" label="Password" password
                                           ref={passwordRef}
                                />
                                <Col style={{margin: 40}} s={8}>
                                    <Col l={4} push={"s2"}>
                                        <Button large style={{backgroundColor: "#42A379"}} node="button"
                                                type="submit" waves="light">Войти
                                            <Icon right>login</Icon>
                                        </Button>
                                    </Col>
                                    <Col l={4} push={"s2"}>
                                        <Button large style={{backgroundColor: "#ee6e73"}} node="button"
                                                type="reset" waves="light">Стереть
                                            <Icon right>close</Icon>
                                        </Button>
                                    </Col>
                                </Col>
                                <Col push={"s1"} s={11}>
                                    <p style={{color: "lightgrey"}}>Вы здесь впервые? Тогда <NavLink
                                        to="/register">зарегистрируйтесь</NavLink></p>
                                </Col>
                            </Row>
                        </form>
                    </FormContainer>
                </Convex>
            </Container>
        </main>
    );
};

export default Login;