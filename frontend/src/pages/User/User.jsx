import React, {useEffect, useRef, useState} from 'react';
import {NavLink} from 'react-router-dom';
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
    let userApplications = useSelector(state => state.applicationsReducer.applications);
    user = useSelector(state => state.userReducer.user);
    const [currentUser, setCurrentUser] = useState(user);
    const [userLogin, setUserLogin] = useState(currentUser.login);
    const [userPhone, setUserPhone] = useState(currentUser.phone);
    const [userEmail, setUserEmail] = useState(currentUser.email);
    const [userPassword, setUserPassword] = useState('');
    const [confirmUserPassword, setConfirmUserPassword] = useState('');

    useEffect(() => {
        let currentUser = JSON.parse(sessionStorage.getItem('userInfo'));
        if (currentUser?.isAuth) {
            dispatch(fetchUser(currentUser.id));
            dispatch(fetchApplicationsByUser(currentUser.id))
            // fetchApplicationsByUser(currentUser.id).then(res => setUserApplications(res))
            // console.log(user);

        }
    }, [])

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
                    <Col s={12} m={4}>
                        <form method="post" style={{display:'flex', flexDirection: 'column'}} encType="multipart/form-data" onSubmit={submitFileHandler}
                              action="http://localhost:8000/user/update-avatar">
                            <img src={user.avatar} alt="Аватар"/>
                            <input name="user_id" type="text" value={user.id} hidden={true}/>
                            <label htmlFor="">Файлы:</label>
                            <input name="avatar" type="file"/>
                            <Button>Загрузить</Button>
                        </form>
                    </Col>
                    <Col s={12} m={8}>
                        <form className={style.userForm} onSubmit={submitUserInfoHandler}>
                            <TextInput
                                s={12}
                                onChange={e => setUserLogin(e.currentTarget.value)}
                                icon="login"
                                id="TextInputLogin"
                                label="Логин"
                                value={user.login}
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
                    {userApplications && userApplications.map(application => {
                        return (
                            <Col key={application.id}>
                                <Card
                                    actions={[
                                        <NavLink key={0} to={'/application/'+application.id}>Просмотр</NavLink>
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