import React from 'react';
import Convex from "../../components/Convex/Convex";
import FormContainer from "../../components/FormContainer/FormContainer";
import {Row, TextInput, Icon, Container, Col, Button} from "react-materialize";
import {NavLink} from 'react-router-dom';

const Register = () => {
    return (
        <main>
            <Container style={{padding:"40px 0"}}>
                <Convex background={'linear-gradient(269.17deg, #DB4463 13.23%, #F2733C 88.24%)'}>
                    <FormContainer icon={<Icon style={{color:"#F2733C", fontSize:"28em", padding:"10px"}}>remember_me</Icon>} background={'#111111'}>
                        <form action="">
                            <Row>
                                <TextInput
                                    s={8}
                                    icon={<Icon>email</Icon>}
                                    id="TextInput-0"
                                    label="Email:"
                                />
                                <TextInput
                                    s={8}
                                    icon={<Icon>password</Icon>}
                                    id="TextInput-1"
                                    label="Пароль:"
                                    password
                                />
                                <TextInput
                                    s={8}
                                    icon={<Icon>password</Icon>}
                                    id="TextInput-2"
                                    label="Повторите пароль:"
                                    password
                                />
                                <TextInput
                                    s={8}
                                    id="TextInput-3"
                                    label="Аватар профиля:"
                                    type="file"
                                />
                                <Col style={{margin:40}} s={8}>
                                    <Col l={4} push={"s2"}>
                                        <Button large style={{backgroundColor:"#42A379"}} node="button" type="submit" waves="light">Войти
                                            <Icon right>login</Icon>
                                        </Button>
                                    </Col>
                                    <Col l={4} push={"s2"}>
                                        <Button large style={{backgroundColor:"#ee6e73"}} node="button" type="reset" waves="light">Стереть
                                            <Icon right>close</Icon>
                                        </Button>
                                    </Col>
                                </Col>
                                <Col push={"s1"} s={11}>
                                    <p style={{color:"lightgrey"}}>Вы уже зарегистрированы? Тогда <NavLink to="/login">авторизуйтесь</NavLink></p>
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