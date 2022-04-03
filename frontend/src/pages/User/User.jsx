import React from 'react';
import {Container} from 'react-materialize';
import {Row, Col, TextInput} from 'react-materialize';
import style from './User.module.css';

const User = () => {
    return (
        <main>
            <Container>
                <Row>
                    <Col s={4}>
                        <form action="">
                            <img src="" alt=""/>
                            <label htmlFor="">Файлы:</label>
                            <input type="file"/>
                        </form>
                    </Col>
                    <Col s={8}>
                        <form className={style.userForm} action="">
                            <TextInput
                                s={12}
                                icon="email"
                                id="TextInput-33"
                                label="Email"
                            />
                            <TextInput
                                s={12}
                                icon="password"
                                id="TextInput-38"
                                label="Пароль"
                                password
                            />
                            <TextInput
                                s={12}
                                id="TextInput-38"
                                icon="password"
                                label="Повторите пароль"
                                password
                            />
                        </form>
                    </Col>
                </Row>
            </Container>
        </main>
    );
};

export default User;