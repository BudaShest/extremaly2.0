import React, {useEffect, useRef, useState} from 'react';
import {Container} from 'react-materialize';
import {Row, Col,Icon, TextInput, Button, Card} from 'react-materialize';
import style from './User.module.css';
import {useSelector, useDispatch} from 'react-redux';
import {fetchUser} from "../../asyncActions/user/fetchUser";
import {updateUser} from "../../asyncActions/user/updateUser";
import {updateAvatar} from "../../asyncActions/user/updateAvatar";
import {fetchApplicationsByUser} from "../../asyncActions/applications/fetchApplicationsByUser";

const User = () => {
    const dispatch = useDispatch();
    const fileInputRef = useRef();
    let user = useSelector(state => state.userReducer.user);
    const [userApplication, setUserApplications] = useState([]);
    useEffect(() => {
        let currentUser = JSON.parse(sessionStorage.getItem('userInfo'));
        if (currentUser?.isAuth) {
            dispatch(fetchUser(currentUser.id));
            fetchApplicationsByUser(currentUser.id).then(res => setUserApplications(res))
            // console.log(user);

        }
    }, [])
    user = useSelector(state => state.userReducer.user);
    const [userLogin, setUserLogin] = useState(user.login);
    const [userPhone, setUserPhone] = useState(user.phone);
    const [userEmail, setUserEmail] = useState(user.email);
    const [userPassword, setUserPassword] = useState('');
    const [confirmUserPassword, setConfirmUserPassword] = useState('');

    function submitFileHandler(e) {
        // e.preventDefault();
        // console.log(e.currentTarget.avatar.value);
        // const formData = new FormData(e.currentTarget.avatar);
        // updateAvatar(formData)
        // console.log(formData);

    }

    function submitUserInfoHandler(e) {
        e.preventDefault();
        if (userPassword === confirmUserPassword) {
            let userInfo = {
                "id": user.id,
                "login": userLogin,
                "phone": userPhone,
                "email": userEmail,
                "password": userPassword
            };
            updateUser(userInfo).then(response => console.log(response)).catch(console.error)
        } else {
            alert('Пароли должны совпадать!');
        }

    }

    return (
        <main>
            <Container>
                <h2 className="white-text center-align">Настройки пользователя</h2>
                <Row>
                    <Col s={4}>
                        <form method="post" encType="multipart/form-data" onSubmit={submitFileHandler}
                              action="http://localhost:8000/user/update-avatar">
                            <img src={user.avatar} alt=""/>
                            <input name="user_id" type="text" value={user.id} hidden={true}/>
                            <label htmlFor="">Файлы:</label>
                            <input name="avatar" type="file"/>
                            <Button>Загрузить</Button>
                        </form>
                    </Col>
                    <Col s={8}>
                        <form className={style.userForm} onSubmit={submitUserInfoHandler}>
                            <TextInput
                                s={12}
                                onChange={e => setUserLogin(e.currentTarget.value)}
                                icon="login"
                                id="TextInputLogin"
                                label="Логин"
                                value={userLogin ?? user.login}
                            />
                            <TextInput
                                s={12}
                                onChange={e => setUserEmail(e.currentTarget.value)}
                                icon="email"
                                id="TextInputEmail"
                                label="Email"
                                value={userEmail ?? user.email}
                            />
                            <TextInput
                                s={12}
                                onChange={e => setUserPhone(e.currentTarget.value)}
                                icon="phone"
                                id="TextInputPhone"
                                label="Телефон"
                                value={userPhone ?? user.phone}
                            />
                            <TextInput
                                s={12}
                                onChange={e => setUserPassword(e.currentTarget.value)}
                                icon="password"
                                id="TextInputPassword"
                                label="Пароль"
                                password
                                value={userPassword}
                            />
                            <TextInput
                                onChange={e => setConfirmUserPassword(e.currentTarget.value)}
                                s={12}
                                id="TextInputConfirmPassword"
                                icon="password"
                                label="Повторите пароль"
                                password
                                value={confirmUserPassword}
                            />
                            <Button>Обновить</Button>
                        </form>
                    </Col>
                </Row>
                <h3 className="white-text center-align">Пользовательские заявки</h3>
                <Row>
                    {userApplication.map(application => {
                        return (
                            <Col>
                                <Card
                                    actions={[
                                        <a key="1" href="#">This is a link</a>,
                                        <a key="2" href="#">This is a link</a>
                                    ]}
                                    className="blue-grey darken-1"
                                    closeIcon={<Icon>close</Icon>}
                                    revealIcon={<Icon>more_vert</Icon>}
                                    textClassName="white-text"
                                    title={'Заявка №'+application.id}
                                >
                                    <span><b>Кол-во билетов: </b>{application.num}</span>
                                    <hr/>
                                    <span><b>Дата: </b>{application.created_at}</span>
                                    <hr/>
                                    <span><b>Статус: </b>{application.status_name}</span>
                                </Card>
                            </Col>
                        )
                    })}
                </Row>
            </Container>
        </main>
    );
};

export default User;