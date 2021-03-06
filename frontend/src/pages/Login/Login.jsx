import React, {useRef} from 'react';
import {loginUser} from "../../asyncActions/user/loginUser";
import {NavLink,useNavigate} from 'react-router-dom';
import {Container, Icon, TextInput, Row, Button, Col} from "react-materialize";
import Convex from "../../components/Convex/Convex";
import FormContainer from "../../components/FormContainer/FormContainer";
import style from './Login.module.css';

const Login = () => {
    const loginRef = useRef();
    const passwordRef = useRef();
    const navigate = useNavigate();


    const handleForm = async (e) => {
        e.preventDefault();
        let response = await loginUser({login: loginRef.current.value, password: passwordRef.current.value});
        if(response.status == 200){
            sessionStorage.setItem('userInfo', JSON.stringify({"login": response.login, "token": response.token, "id": response.id, "isAuth": true}));
            window.location.href = 'http://extremly.ru';
        }
    }

    return (
        <main>
            <Container style={{padding: "40px 0"}}>
                <Convex background={'linear-gradient(269.17deg, #DB4463 13.23%, #F2733C 88.24%)'}>
                    <FormContainer
                        icon={<Icon className={style.logFormIcon}>login</Icon>}
                        background={'#111111'}>
                        <form action="" onSubmit={(e)=>handleForm(e)} className={style.logForm}>
                            <Row>
                                <TextInput s={12} m={9} l={9}
                                           className={style.logForm_icon} icon={<Icon>email</Icon>} id="TextInputLogin"
                                           label="Логин" ref={loginRef}
                                />
                                <TextInput s={12} m={9} l={9}
                                           icon={<Icon>password</Icon>} id="TextInputPassword" label="Пароль" password
                                           ref={passwordRef}
                                />
                                <Col style={{margin: 40}} s={8}>
                                    <Col l={4} push={"m2"}>
                                        <Button large style={{backgroundColor: "#42A379"}} node="button"
                                                type="submit" waves="light">Войти
                                            <Icon right>login</Icon>
                                        </Button>
                                    </Col>
                                    <Col l={4} push={"m2"}>
                                        <Button large style={{backgroundColor: "#ee6e73"}} node="button"
                                                type="reset" waves="light">Стереть
                                            <Icon right>close</Icon>
                                        </Button>
                                    </Col>
                                </Col>
                                <Col push={"m1"} s={11}>
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