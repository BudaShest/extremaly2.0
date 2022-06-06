import React, {useState} from 'react';
import {useDispatch} from 'react-redux';
import {NavLink} from 'react-router-dom';
import {Container, Row, Col, Button, Icon, Card, Select, Textarea, Chip} from 'react-materialize'
import Persons from "../../components/Persons/Persons";
import Comments from "../../components/Comments/Comments";
import Convex from "../../components/Convex/Convex";
import FormContainer from "../../components/FormContainer/FormContainer";
import {sendMail} from "../../asyncActions/main/sendMail";
import style from "../Event/Event.module.css";
import mainStyle from './Main.module.css';
import SocialLinks from "../../components/SocialLinks/SocialLinks";
import {createReview} from "../../asyncActions/main/createReview";


const SectionAbout = ({numOfPages, socialLinks, aboutUs, advantages, persons, reviews}) => {
    const [mailSubject, setMailSubject] = useState('');
    const [mailText, setMailText] = useState('');
    const [errorInfo, setErrorInfo] = useState(null);

    const dispatch = useDispatch();

    const handleSendMail = (e) => {
        e.preventDefault();
        sendMail({
            "text": mailText,
            "subject": mailSubject
        }).then(response => setErrorInfo(response.message)).catch(console.error)
        setTimeout(() => setErrorInfo(null), 10000);
    }

    const [commentText, setCommentText] = useState('');

    function submitHandler(e) {
        e.preventDefault();
        let currentUser = JSON.parse(sessionStorage.getItem('userInfo'));
        if (currentUser?.isAuth && commentText) {
            let review = {"user_id": currentUser.id, "rating": 5, "text": commentText};
            dispatch(createReview(review))
            setCommentText('');
        }
    }

    function changeHandler(e) {
        setCommentText(e.currentTarget.value);
    }

    return (
        <section className={mainStyle.sectionAbout}>

            <Container>
                <Row style={{padding: "34px 25px", backgroundColor: '#101010', marginBottom: '60px'}}>
                    <Col s={12} m={4} className="push white-text">
                        <h2>О нас</h2>
                        <p dangerouslySetInnerHTML={{__html: aboutUs.text}}></p>
                        <p dangerouslySetInnerHTML={{__html: aboutUs.small_text}}
                           style={{fontSize: '0.8em', color: "lightgray"}}></p>
                        <NavLink
                            to="/login"
                            className={`btn btn-large`}
                            style={{marginRight: '5px', backgroundColor: "#DE4564", color: "white"}}
                            waves="light">
                            Авторизуйтесь
                            <Icon left>
                                cloud
                            </Icon>
                        </NavLink>
                    </Col>
                    <Col s={12} m={4} className="push-m1">
                        <div className={mainStyle.aboutUsImageConvex}><img
                            className="hoverable"
                            style={{width: "100%", height: "100%", position: 'relative', top: "20px", left: "20px"}}
                            src={aboutUs.image} alt="О нас"/></div>
                    </Col>
                </Row>
                <h3 className="white-text">Наши преимущества</h3>
                <Row>
                    <Col s={12} m={5} className={`large ${mainStyle.firstAdvantage}`}>
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
                    <Col s={12} m={6} className={`push-m1 small ${mainStyle.secondAdvantage}`}>
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
                    <Col s={12} m={6} className={`push-m1 small ${mainStyle.thirdAdvantage}`}>
                        <Card style={{
                            backgroundColor: "#111111",
                            width: "100%",
                            height: '100%',
                            margin: 0,
                            position: 'relative',
                            top: 20,
                            left: 20
                        }}
                              title={advantages[2]?.title}
                              className="white-text">
                            <p style={{color: "#43A17C", marginLeft: '30px'}}
                               dangerouslySetInnerHTML={{__html: advantages[2]?.text}}></p>
                        </Card>
                    </Col>
                </Row>
                <h3 className="white-text">Наша команда:</h3>
                <Persons persons={persons}/>
                <Comments numOfPages={numOfPages} comments={reviews}>
                    <form className={style.commentForm} onSubmit={submitHandler}>
                        <h5 className={style.commentForm_title}>Оставьте отзыв о проекте!</h5>
                        <Textarea
                            id="TextareaReviewText"
                            label="Изложите свои мысли..."
                            onChange={changeHandler}
                            value={commentText}
                        />
                        <Button node="button" type="submit" waves="light">Оставить комментарий<Icon
                            right>send</Icon></Button>
                    </form>
                    <SocialLinks links={socialLinks ?? []}/>
                </Comments>
                <h3 className="white-text">Форма обратной связи:</h3>
                <Chip>{errorInfo}</Chip>
                <Convex size={"large"} s={12} background={'linear-gradient(269.17deg, #DB4463 13.23%, #F2733C 88.24%)'}>
                    <FormContainer icon={<img style={{width: '100%'}} src="img/ui/letter.png" alt="Иконка формы"/>}
                                   background={'#111111'}>
                        <form onSubmit={handleSendMail} action="">
                            <Row>
                                <Select
                                    s={10}
                                    icon={<Icon className="little-icon">category</Icon>}
                                    id="SelectMailTheme"
                                    onChange={e => setMailSubject(e.currentTarget.value)}
                                    multiple={false}
                                    label="Выберите тему обращения"
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
                                    }}>
                                    <option disabled value="">Выберите тему обращения</option>
                                    <option value="Жалоба">Жалоба</option>
                                    <option value="Пожелание">Пожелание</option>
                                    <option value="Предложение">Предложение</option>
                                </Select>
                                <Textarea label="Изложите свои мысли" onChange={e => setMailText(e.currentTarget.value)}
                                          value={mailText}
                                          icon={<Icon className="little-icon" placeholder="Текст письма">article</Icon>}
                                          s={10}/>
                                <Row>
                                    <Col push={'l7'} s={3}>
                                        <Button style={{backgroundColor: "#DB4463"}} large>Отправить</Button>
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