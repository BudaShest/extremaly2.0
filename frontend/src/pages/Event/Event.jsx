import React, {useState, useEffect} from 'react';
import {useSelector, useDispatch} from 'react-redux';
import {useParams, NavLink} from 'react-router-dom';
import {Carousel, Container, Row, Col, Textarea, Button, Icon} from "react-materialize";
import style from './Event.module.css';
import Persons from "../../components/Persons/Persons";
import Gallery from "../../components/Gallery/Gallery";
import Comments from "../../components/Comments/Comments";
import SocialLinks from "../../components/SocialLinks/SocialLinks";
import {comments as defValueComments} from "../Main/SectionAbout";
import {initialState as defValuePersons} from "../Main/SectionAbout";
import {fetchEvent} from '../../asyncActions/events/fetchEvent';


export const socialLinks = [
    {id: 0, img: "/img/links/fb.png", src: "https://google.com"},
    {id: 1, img: "/img/links/ytb.png", src: "https://google.com"},
    {id: 2, img: "/img/links/wtsuo.png", src: "https://google.com"},
    {id: 1, img: "/img/links/ytb.png", src: "https://google.com"},
]


const Event = () => {
    const dispatch = useDispatch();
    const requestParams = useParams();

    const [comments] = useState(defValueComments);

    const event = useSelector(state => state.eventsReducer.oneEvent);
    console.log(event);

    useEffect(() => {
        dispatch(fetchEvent(requestParams.id));
        console.log(event);
    }, [])

    function submitHandler(e){

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
                <Persons persons={defValuePersons}/>
                <Comments comments={comments}>
                    <form className={style.commentForm} onSubmit={submitHandler}>
                        <h5 className={style.commentForm_title}>Оставьте комментарий!</h5>
                        <Textarea
                            id="Textarea-41"
                            label="Изложите свои мысли..."
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