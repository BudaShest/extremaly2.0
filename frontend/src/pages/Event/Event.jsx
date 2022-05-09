import React, {useState, useEffect, useRef} from 'react';
import {useSelector, useDispatch} from 'react-redux';
import {useParams, NavLink, useNavigate} from 'react-router-dom';
import {Carousel, Container, Row, Col, Textarea, Button, Icon, Card} from "react-materialize";
import style from './Event.module.css';
import Persons from "../../components/Persons/Persons";
import Gallery from "../../components/Gallery/Gallery";
import Comments from "../../components/Comments/Comments";
import SocialLinks from "../../components/SocialLinks/SocialLinks";
import {fetchEvent} from '../../asyncActions/events/fetchEvent';
import {fetchEventReviews} from "../../asyncActions/events/fetchEventReviews";
import {createEventReview} from "../../asyncActions/events/createEventReview";
import {fetchEventTickets} from "../../asyncActions/events/fetchEventTickets";
import {addTicket} from "../../asyncActions/events/fetchTicket";
import {fetchPersonsByEvent} from "../../asyncActions/persons/fetchPersons";
import {fetchSocialLinks} from "../../asyncActions/main/fetchSocialLinks";

/**
 * Страница "Событие"
 * @returns {JSX.Element}
 * @constructor
 */
const Event = () => {
    const navigate = useNavigate();
    const dispatch = useDispatch();
    const requestParams = useParams();

    const [commentText, setCommentText] = useState('');

    const event = useSelector(state => state.eventsReducer.oneEvent);
    const eventReviews = useSelector(state => state.eventsReducer.eventReviews);
    const eventTickets = useSelector(state => state.eventsReducer.eventTickets);
    const eventPersons = useSelector(state => state.personsReducer.eventPersons);
    const socialLinks = useSelector(state => state.mainReducer.socialLinks);

    useEffect(() => {
        dispatch(fetchEvent(requestParams.id));
        dispatch(fetchEventReviews(requestParams.id));
        dispatch(fetchEventTickets(requestParams.id));
        dispatch(fetchPersonsByEvent(requestParams.id));
        dispatch(fetchSocialLinks());
    }, [])

    let currentUser = JSON.parse(sessionStorage.getItem('userInfo'));

    function submitHandler(e) {
        e.preventDefault();

        if (currentUser?.isAuth && commentText) {
            let eventReview = {"user_id": currentUser.id, "event_id": event.id, "rating": 5, "text": commentText};
            dispatch(createEventReview(eventReview))
            setCommentText('');
        }
    }

    function changeHandler(e) {
        setCommentText(e.currentTarget.value);
    }

    const tickets = useSelector(state => state.applicationsReducer.tickets);

    function clickTicketHandler(e) {
        e.preventDefault();
        dispatch(addTicket(e.currentTarget.dataset.id));
        console.log(tickets);
        navigate('/applications');
    }


    return (
        <main style={{backgroundColor: "#222222"}}>
            <Carousel
                className={style.eventSlider}
                carouselId="Carousel-37"
                images={event.images ?? ['https://www.culturepartnership.eu/upload/news/5d5bd65b804b5.jpg', 'https://www.culturepartnership.eu/upload/news/5d5bd65b804b5.jpg']}
                options={{
                    fullWidth: true,
                    indicators: true,
                }}
            />
            <Container>
                <h2 className="center-align white-text">{event.name}</h2>
                <h5 className="center-align white-text">{event.type}</h5>
                <Row>
                    <Col l={4}>
                        <Col style={{backgroundColor: "#111"}} className={style.eventDescription}>
                            <h4 className={style.eventDescription_headlines}>О событии</h4>
                            <h5 className={style.eventDescription_headlines}>Место:</h5>
                            <ul>
                                <li><strong>Место проведения: <NavLink
                                    to={`/places/${event.place_id}`}>{event.place_name}</NavLink></strong></li>
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
                    <Col l={8}>
                        <Col className="white-text">
                            <h4 dangerouslySetInnerHTML={{__html: event.offer}}></h4>
                            <p dangerouslySetInnerHTML={{__html: event.description}}></p>
                        </Col>
                    </Col>
                </Row>
                <h3 className="white-text center-align">Галерея</h3>
                <Gallery photos={event.images}/>
                <h3 className="white-text center-align">Ответсвенные лица:</h3>
                <Persons persons={eventPersons ?? []}/>
                <h4 className="white-text center-align">Билеты</h4>
                <h5 className="white-text center-align">Всего: {event.ticket_num}</h5>
                <Row>
                    {
                        currentUser?.isAuth ? eventTickets.map(eventTicket => {
                            return (
                                <Col s={12} m={4}>
                                    <Card
                                        actions={[
                                            <Button onClick={clickTicketHandler} data-id={eventTicket.id}
                                                    key={eventTicket.id}>Забронировать</Button>,
                                        ]}
                                        className="blue-grey darken-1"
                                        closeIcon={<Icon>close</Icon>}
                                        textClassName="white-text"
                                        title={eventTicket.privilege}
                                    >
                                        {eventTicket.description}
                                        <hr/>
                                        <span style={{fontSize: '1.4em'}}><b>Цена: </b> {eventTicket.price} руб.</span>
                                    </Card>
                                </Col>
                            )
                        }) : <div className="white-text" style={{fontSize: '1.2em'}}><NavLink
                            to="/login">Войдите</NavLink>, чтобы забронировать билеты</div>
                    }
                </Row>
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