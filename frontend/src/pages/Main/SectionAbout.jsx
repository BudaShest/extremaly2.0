import React, {useState, useEffect} from 'react';
import {useDispatch} from 'react-redux';
import {Container, Row, Col, Button, Icon, Card, Select, Textarea, TextInput, Chip} from 'react-materialize'
import Persons from "../../components/Persons/Persons";
import Comments from "../../components/Comments/Comments";
import Convex from "../../components/Convex/Convex";
import FormContainer from "../../components/FormContainer/FormContainer";
import {sendMail} from "../../asyncActions/main/sendMail";
import style from "../Event/Event.module.css";
import SocialLinks from "../../components/SocialLinks/SocialLinks";
import {socialLinks} from "../Event/Event";
import {createEventReview} from "../../asyncActions/events/createEventReview";
import {createReview} from "../../asyncActions/main/createReview";

export const comments = [
    {
        id: 0,
        login: 'Vasya',
        avatar: 'https://twizz.ru/wp-content/uploads/-000//1/12-32.jpg',
        date: '10.10.2021',
        text: "Равным образом сложившаяся структура организации играет важную роль в формировании направлений прогрессивного развития. Разнообразный и богатый опыт новая модель организационной деятельности требуют от нас анализа системы обучения кадров, соответствует насущным потребностям."
    },
    {
        id: 1,
        login: 'Vasy2',
        avatar: 'https://static.kulturologia.ru/files/u18214/portrait61.jpg',
        date: '10.10.2021',
        text: 'Равным образом сложившаяся структура организации играет важную роль в формировании направлений прогрессивного развития.'
    },
    {
        id: 2,
        login: 'Vasy3',
        avatar: 'https://i.pinimg.com/originals/37/96/88/379688670502e9edf28d261dd3c143d2.jpg',
        date: '10.10.2021',
        text: 'На чили ан кайфи'
    },
    {
        id: 3,
        login: 'Vasy4 Fractal',
        avatar: 'https://i.pinimg.com/originals/37/96/88/379688670502e9edf28d261dd3c143d2.jpg',
        date: '10.10.2021',
        text: 'На чили ан кайфи'
    },
]


export const initialState = [
    {
        id: 0,
        firstname: "Аркадий",
        surname: "Укурник",
        profession: "гениральный директор",
        avatar: 'team/arcadiy.jpg',
        links: [ //TODO соц сети
            {
                text: "",
                url: "",
                icon: "",
            }
        ],
        description: "Создатель компании 'Extremly', эксперт в области отдыха и чила, кандидат наук по кайфологии и" +
            " релаксоведению. Автор книги 'Чилил, Чилю, Буду Чилить' и 'Тупа адыхаю'."

    },
    {
        id: 1,
        firstname: "Виктор",
        surname: "Альбиносов",
        profession: "исполнительный директор",
        avatar: 'team/victor.jpeg',
        links: [ //TODO соц сети
            {
                text: "",
                url: "",
                icon: "",
            }
        ],
        description: "Тот самый парень, что делает 90 процентов и работы и за это мы благодарны ему. Именно он делает" +
            " возможной деятельность компании."

    },
    {
        id: 2,
        firstname: "Виктория",
        surname: "Импалова",
        profession: "Маркетолог",
        avatar: 'team/victoria.jpg',
        links: [ //TODO соц сети
            {
                text: "",
                url: "",
                icon: "",
            }
        ],
        description: "Вика наш козырь в рукаве. Ведь с её складом ума, а также социальными и бизнес-наывками " +
            "показатели компании растут как грибы."

    },
]

const SectionAbout = ({aboutUs, advantages, persons, reviews}) => {
    const [mailSubject, setMailSubject] = useState('');
    const [mailText, setMailText] = useState('');
    const [errorInfo, setErrorInfo] = useState(null);

    const dispatch = useDispatch();

    const handleSendMail = (e) => {
        e.preventDefault();
        sendMail({"text":mailText, "subject": mailSubject}).then(response=>setErrorInfo(response.message)).catch(console.error)
        setTimeout(()=>setErrorInfo(null), 10000);
    }

    const [commentText, setCommentText] = useState('');

    function submitHandler(e){
        e.preventDefault();
        let currentUser = JSON.parse(sessionStorage.getItem('userInfo'));
        if(currentUser?.isAuth && commentText){
            let review = {"user_id": currentUser.id, "rating": 5, "text": commentText};
            dispatch(createReview(review))
            setCommentText('');
        }
    }

    function changeHandler(e){
        setCommentText(e.currentTarget.value);
    }

    return (
        <section style={{backgroundColor: "#222222", padding: "30px 0"}}>

            <Container>
                <Row style={{padding: "34px 25px", backgroundColor: '#101010', marginBottom: '60px'}}>
                    <Col className="m4 push white-text">
                        <h2>О нас</h2>
                        <p dangerouslySetInnerHTML={{__html: aboutUs.text}}></p>
                        <p dangerouslySetInnerHTML={{__html: aboutUs.small_text}}
                           style={{fontSize: '0.8em', color: "lightgray"}}></p>
                        <Button
                            large
                            node="a"
                            style={{marginRight: '5px', backgroundColor: "#DE4564", color: "white"}}
                            waves="light">
                            Авторизуйтесь
                            <Icon left>
                                cloud
                            </Icon>
                        </Button>
                    </Col>
                    <Col className="m4 push-m1">
                        <div style={{width: "600px", height: "400px", backgroundColor: "#DE4564"}}><img
                            className="hoverable"
                            style={{width: "100%", height: "100%", position: 'relative', top: "20px", left: "20px"}}
                            src={aboutUs.image} alt=""/></div>
                    </Col>
                </Row>
                <h3 className="white-text">Наши преимущества</h3>
                <Row>
                    <Col className="s5 large" style={{backgroundColor: '#f2733c', padding: 0, margin: "50px 0"}}>
                        <Card style={{
                            backgroundColor: "#111111",
                            width: "100%",
                            height: '100%',
                            margin: 0,
                            position: 'relative',
                            top: 20,
                            left: 20
                        }}
                              title={advantages[0]?.title}
                              className="white-text">
                            <p style={{color: "#F2733C", marginLeft: '30px'}}
                               dangerouslySetInnerHTML={{__html: advantages[0]?.text}}></p>
                        </Card>
                    </Col>
                    <Col className="s6 push-s1 small"
                         style={{backgroundColor: '#DE4564', padding: 0, margin: "30px 0"}}>
                        <Card style={{
                            backgroundColor: "#111111",
                            width: "100%",
                            height: '100%',
                            margin: 0,
                            position: 'relative',
                            top: 20,
                            left: 20
                        }}
                              title={advantages[1]?.title}
                              className="white-text">
                            <p style={{color: "#DE4564", marginLeft: '30px'}}
                               dangerouslySetInnerHTML={{__html: advantages[1]?.text}}></p>
                        </Card>
                    </Col>
                    <Col className="s6 push-s1 small"
                         style={{backgroundColor: '#43A17C', padding: 0, margin: "30px 0"}}>
                        <Card style={{
                            backgroundColor: "#111111",
                            width: "100%",
                            height: '100%',
                            margin: 0,
                            position: 'relative',
                            top: 20,
                            left: 20
                        }}
                              title={advantages[0]?.title}
                              className="white-text">
                            <p style={{color: "#43A17C", marginLeft: '30px'}}
                               dangerouslySetInnerHTML={{__html: advantages[2]?.text}}></p>
                        </Card>
                    </Col>
                </Row>
                <h3 className="white-text">Наша команда:</h3>
                <Persons persons={persons}/>
                <Comments comments={reviews}>
                    <form className={style.commentForm} onSubmit={submitHandler}>
                        <h5 className={style.commentForm_title}>Оставьте комментарий!</h5>
                        <Textarea
                            id="TextareaReviewText"
                            label="Изложите свои мысли..."
                            onChange={changeHandler}
                            value={commentText}
                        />
                        <Button node="button" type="submit" waves="light">Оставить комментарий<Icon
                            right>send</Icon></Button>
                    </form>
                    <SocialLinks links={socialLinks}/>
                </Comments>
                <h3 className="white-text">Форма обратной связи:</h3>
                <Chip>{errorInfo}</Chip>
                <Convex size={"large"} s={12} background={'linear-gradient(269.17deg, #DB4463 13.23%, #F2733C 88.24%)'}>
                    <FormContainer icon={<img style={{width: '100%'}} src="img/ui/letter.png" alt=""/>}
                                   background={'#111111'}>
                        <form onSubmit={handleSendMail} action="">
                            <Row>
                                <Select
                                    s={10}
                                    icon={<Icon className="little-icon">category</Icon>}
                                    id="SelectMailTheme"
                                    onChange={e=>setMailSubject(e.currentTarget.value)}
                                    multiple={false}
                                    value={mailSubject}
                                    options={{
                                        classes: '',
                                        dropdownOptions: {
                                            alignment: 'left',
                                            autoTrigger: true,
                                            closeOnClick: true,
                                            constrainWidth: true,
                                            coverTrigger: true,
                                            hover: false,
                                            inDuration: 150,
                                            outDuration: 250
                                        }
                                }} value="">
                                    <option disabled value="">Выберите тему обращения</option>
                                    <option value="Жалоба">Жалоба</option>
                                    <option value="Пожелание">Пожелание</option>
                                    <option value="Предложение">Предложение</option>
                                </Select>
                                <Textarea onChange={e=>setMailText(e.currentTarget.value)} value={mailText} icon={<Icon className="little-icon" placeholder="Текст письма">article</Icon>} s={10}/>
                                <Row>
                                    <Col push={'s7'} s={3}>
                                        <Button style={{backgroundColor: "#DB4463"}} large>Подписаться</Button>
                                    </Col>
                                </Row>
                            </Row>
                        </form>
                    </FormContainer>
                </Convex>
            </Container>
        </section>
    );
};

export default SectionAbout;