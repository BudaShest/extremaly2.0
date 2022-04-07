import React,{useEffect, useRef} from 'react';
import {Container} from 'react-materialize';
import {Row, Col, TextInput} from 'react-materialize';
import style from './User.module.css';
import {useSelector, useDispatch} from 'react-redux';
import {fetchUser} from "../../asyncActions/user/fetchUser";

const User = () => {
    const dispatch = useDispatch();
    const fileInputRef = useRef();

    useEffect(()=>{
        let currentUser = JSON.parse(sessionStorage.getItem('userInfo'));
        if(currentUser?.isAuth){
            dispatch(fetchUser(currentUser.id));
            console.log(user);
        }
    }, [])

    const user = useSelector(state => state.userReducer.user);

    return (
        <main>
            <Container>
                <Row>
                    <Col s={4}>
                        <form onClick={} action="">
                            <img src="" alt=""/>
                            <label htmlFor="">Файлы:</label>
                            <input ref={fileInputRef} type="file"/>
                        </form>
                    </Col>
                    <Col s={8}>
                        <form className={style.userForm} action="">
                            <TextInput
                                s={12}
                                icon="login"
                                id="TextInputLogin"
                                label="Логин"
                                value={user.login}
                            />
                            <TextInput
                                s={12}
                                icon="email"
                                id="TextInputEmail"
                                label="Email"
                                value={user.email}
                            />
                            <TextInput
                                s={12}
                                icon="phone"
                                id="TextInputPhone"
                                label="Телефон"
                                value={user.phone}
                            />
                            <TextInput
                                s={12}
                                icon="password"
                                id="TextInputPassword"
                                label="Пароль"
                                password
                            />
                            <TextInput
                                s={12}
                                id="TextInputConfirmPassword"
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