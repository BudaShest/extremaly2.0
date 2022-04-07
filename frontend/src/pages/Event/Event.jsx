import React, {useState, useEffect, useRef} from 'react';
import {useSelector, useDispatch} from 'react-redux';
import {useParams, NavLink} from 'react-router-dom';
import {Carousel, Container, Row, Col, Textarea, Button, Icon} from "react-materialize";
import style from './Event.module.css';
import Persons from "../../components/Persons/Persons";
import Gallery from "../../components/Gallery/Gallery";
import Comments from "../../components/Comments/Comments";
import SocialLinks from "../../components/SocialLinks/SocialLinks";
import {initialState as defValuePersons} from "../Main/SectionAbout";
import {fetchEvent} from '../../asyncActions/events/fetchEvent';
import {fetchEventReviews} from "../../asyncActions/events/fetchEventReviews";
import {createEventReview} from "../../asyncActions/events/createEventReview";

export const socialLinks = [
    {id: 0, img: "/img/links/fb.png", src: "https://google.com"},
    {id: 1, img: "/img/links/ytb.png", src: "https://google.com"},
    {id: 2, img: "/img/links/wtsuo.png", src: "https://google.com"},
    {id: 1, img: "/img/links/ytb.png", src: "https://google.com"},
]


const Event = () => {
    const dispatch = useDispatch();
    const requestParams = useParams();

    const [commentText, setCommentText] = useState('');

    const event = useSelector(state => state.eventsReducer.oneEvent);
    const eventReviews = useSelector(state => state.eventsReducer.eventReviews);
    console.log(event);

    useEffect(() => {
        dispatch(fetchEvent(requestParams.id));
        dispatch(fetchEventReviews(requestParams.id));
        console.log(eventReviews);
    }, [])

    function submitHandler(e){
        e.preventDefault();
        let currentUser = JSON.parse(sessionStorage.getItem('userInfo'));
        if(currentUser?.isAuth && commentText){
            let eventReview = {"user_id": currentUser.id, "event_id": event.id, "rating": 5, "text": commentText};
            dispatch(createEventReview(eventReview))
            setCommentText('');
        }
    }

    function changeHandler(e){
        setCommentText(e.currentTarget.value);
    }

    return (
        <main style={{backgroundColor: "#222222"}}>
            <Carousel
                className={style.eventSlider}
                carouselId="Carousel-37"
                images={event.images ?? ['https://www.culturepartnership.eu/upload/news/5d5bd65b804b5.jpg']}
                options={{
                    fullWidth: true,
                    indicators: true,

                }}
            />
            <Container>
                <h2 className="center-align white-text">{event.name}</h2>
                <h5 className="center-align white-text">{event.type}</h5>
                <Row>
                    <Col l={5}>
                        <Col style={{backgroundColor: "#111"}} className={style.eventDescription}>
                            <h4 className={style.eventDescription_headlines}>О событии</h4>
                            <h5 className={style.eventDescription_headlines}>Место:</h5>
                            <ul>
                                <li><strong>Место проведения: <NavLink to={`/places/${event.place_id}`}>{event.place_name}</NavLink></strong></li>
                                <li><strong>Страна проведения: </strong>{event.country_name}</li>
                                <li><strong>Климат</strong>: {event.climat_name}</li>
                            </ul>
                            <h5 className={style.eventDescription_headlines}>Дата:</h5>
                            <ul>
                                <li><strong>Начинается: </strong> {event.from}</li>
                                <li><strong>Заканчивается: </strong> {event.until}</li>
                            </ul>
                            <h5 className={style.eventDescription_headlines}>Прочее:</h5>
                            <ul>
                                <li><strong>Возрастные ограничения: </strong> {event.age_restrictions}</li>
                            </ul>
                        </Col>
                    </Col>
                    <Col l={7}>
                        <Col className="white-text">
                            <h4 dangerouslySetInnerHTML={{__html: event.offer}}></h4>
                            <p dangerouslySetInnerHTML={{__html: event.description}}></p>
                        </Col>
                    </Col>
                </Row>
                <h3 className="white-text center-align">Галерея</h3>
                <Gallery photos={event.images}/>
                <h3 className="white-text center-align">Ответсвенные лица:</h3>
                {/*<Persons persons={defValuePersons}/>*/}
                <Comments comments={eventReviews}>
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

            </Container>
        </main>
    );
};

export default Event;